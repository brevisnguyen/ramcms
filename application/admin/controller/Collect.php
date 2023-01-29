<?php
namespace app\admin\controller;
use think\Db;
use think\Cache;
use app\common\validate\Vod as VodValidate;
use DOMDocument;
use DOMXPath;
use think\Exception;

use function PHPSTORM_META\map;

class Collect extends Base
{
    public function __construct()
    {
        parent::__construct();
        //header('X-Accel-Buffering: no');
    }

    public function index()
    {
        $param = input();
        $param['page'] = intval($param['page']) < 1 ? 1 : $param['page'];
        $param['limit'] = intval($param['limit']) < 1 ? 100 : $param['limit'];
        $where = [];

        $order = 'collect_id desc';
        $res = model('Collect')->listData($where, $order, $param['page'], $param['limit']);

        $this->assign('list', $res['list']);
        $this->assign('total', $res['total']);
        $this->assign('page', $res['page']);
        $this->assign('limit', $res['limit']);

        $param['page'] = '{page}';
        $param['limit'] = '{limit}';
        $this->assign('param', $param);

        $key = $GLOBALS['config']['app']['cache_flag']. '_'. 'collect_break_vod';
        $collect_break_vod = Cache::get($key);
        $key = $GLOBALS['config']['app']['cache_flag']. '_'. 'collect_break_art';
        $collect_break_art = Cache::get($key);
        $key = $GLOBALS['config']['app']['cache_flag']. '_'. 'collect_break_actor';
        $collect_break_actor = Cache::get($key);
        $key = $GLOBALS['config']['app']['cache_flag']. '_'. 'collect_break_role';
        $collect_break_role = Cache::get($key);
        $key = $GLOBALS['config']['app']['cache_flag']. '_'. 'collect_break_website';
        $collect_break_website = Cache::get($key);


        $this->assign('collect_break_vod', $collect_break_vod);
        $this->assign('collect_break_art', $collect_break_art);
        $this->assign('collect_break_actor', $collect_break_actor);
        $this->assign('collect_break_role', $collect_break_role);
        $this->assign('collect_break_website', $collect_break_website);

        $this->assign('title',lang('admin/collect/title'));
        return $this->fetch('admin@collect/index');
    }

    public function test()
    {
        $param = input();
        $res = model('Collect')->vod($param);
        return json($res);
    }

    public function info()
    {
        if (Request()->isPost()) {
            $param = input('post.');
            $validate = \think\Loader::validate('Token');
            if(!$validate->check($param)){
                return $this->error($validate->getError());
            }
            $res = model('Collect')->saveData($param);
            if ($res['code'] > 1) {
                return $this->error($res['msg']);
            }
            return $this->success($res['msg']);
        }

        $id = input('id');
        $where = [];
        $where['collect_id'] = ['eq', $id];
        $res = model('Collect')->infoData($where);
        $this->assign('info', $res['info']);
        $this->assign('title', lang('admin/collect/title'));
        return $this->fetch('admin@collect/info');
    }

    public function del()
    {
        $param = input();
        $ids = $param['ids'];

        if (!empty($ids)) {
            $where = [];
            $where['collect_id'] = ['in', $ids];

            $res = model('Collect')->delData($where);
            if ($res['code'] > 1) {
                return $this->error($res['msg']);
            }
            return $this->success($res['msg']);
        }
        return $this->error(lang('param_err'));
    }

    public function union()
    {
        $key = $GLOBALS['config']['app']['cache_flag']. '_'. 'collect_break_vod';
        $collect_break_vod = Cache::get($key);
        $key = $GLOBALS['config']['app']['cache_flag']. '_'. 'collect_break_art';
        $collect_break_art = Cache::get($key);
        $key = $GLOBALS['config']['app']['cache_flag']. '_'. 'collect_break_actor';
        $collect_break_actor = Cache::get($key);
        $key = $GLOBALS['config']['app']['cache_flag']. '_'. 'collect_break_role';
        $collect_break_role = Cache::get($key);
        $key = $GLOBALS['config']['app']['cache_flag']. '_'. 'collect_break_website';
        $collect_break_website = Cache::get($key);

        $this->assign('collect_break_vod', $collect_break_vod);
        $this->assign('collect_break_art', $collect_break_art);
        $this->assign('collect_break_actor', $collect_break_actor);
        $this->assign('collect_break_role', $collect_break_role);
        $this->assign('collect_break_website', $collect_break_website);

        $this->assign('title', lang('admin/collect/title'));
        return $this->fetch('admin@collect/union');
    }

    public function load()
    {
        $param = input();
        $key = $GLOBALS['config']['app']['cache_flag']. '_'. 'collect_break_' . $param['flag'];
        $collect_break = Cache::get($key);
        $url = $this->_ref;
        if (!empty($collect_break)) {
            echo lang('admin/collect/load_break');
            $url = $collect_break;
        }
        mac_jump($url);
    }

    public function api($pp = [])
    {
        $param = input();
        if (!empty($pp)) {
            $param = $pp;
        }

        //分类
        $type_list = model('Type')->getCache('type_list');
        $this->assign('type_list', $type_list);

        if (!empty($param['pg'])) {
            $param['page'] = $param['pg'];
            unset($param['pg']);
        }
        @session_write_close();
        
        if ($param['mid'] == '' || $param['mid'] == '1') {
            return $this->vod($param);
        } elseif ($param['mid'] == '2') {
            return $this->art($param);
        } elseif ($param['mid'] == '8') {
            return $this->actor($param);
        }
        elseif ($param['mid'] == '9') {
            return $this->role($param);
        }
        elseif ($param['mid'] == '11') {
            return $this->website($param);
        }
    }

    public function timing()
    {
        //当日视频分类ids
        $res = model('Vod')->updateToday('type');
        $this->assign('vod_type_ids_today', $res['data']);

        return $this->fetch('admin@collect/timing');
    }

    public function clearbind()
    {
        $param = input();
        $config = [];
        if(!empty($param['cjflag'])){
            $bind_list = config('bind');
            foreach($bind_list as $k=>$v){
                if(strpos($k,$param['cjflag'])===false){
                    $config[$k] = $v;
                }
            }
        }

        $res = mac_arr2file( APP_PATH .'extra/bind.php', $config);
        if($res===false){
            return json(['code'=>0,'msg'=>lang('clear_err')]);
        }
        return json(['code'=>1,'msg'=>lang('clear_ok')]);
    }

    public function bind()
    {
        $param = input();
        $ids = $param['ids'];
        $col = $param['col'];
        $val = $param['val'];

        if(!empty($col)){
            $config = config('bind');
            $config[$col] = intval($val);
            $data = [];
            $data['id'] = $col;
            $data['st'] = 0;
            $data['local_type_id'] = $val;
            $data['local_type_name'] = '';
            if(intval($val)>0){
                $data['st'] = 1;
                $type_list = model('Type')->getCache('type_list');
                $data['local_type_name'] = $type_list[$val]['type_name'];
            }

            $res = mac_arr2file( APP_PATH .'extra/bind.php', $config);
            if($res===false){
                return $this->error(lang('save_err'));
            }
            return $this->success(lang('save_ok'),null, $data);
        }
        return $this->error(lang('param_err'));
    }

    public function vod($param)
    {
        if($param['ac'] != 'list'){
            $key = $GLOBALS['config']['app']['cache_flag']. '_'.'collect_break_vod';
            Cache::set($key, url('collect/api').'?'. http_build_query($param) );
        }
        $res = model('Collect')->vod($param);
        if($res['code']>1){
            return $this->error($res['msg']);
        }

        if($param['ac'] == 'list'){

            $bind_list = config('bind');
            $type_list = model('Type')->getCache('type_list');

            foreach($res['type'] as $k=>$v){
                $key = $param['cjflag'] . '_' . $v['type_id'];
                $res['type'][$k]['isbind'] = 0;
                $local_id = intval($bind_list[$key]);
                if( $local_id>0 ){
                    $res['type'][$k]['isbind'] = 1;
                    $res['type'][$k]['local_type_id'] = $local_id;
                    $type_name = $type_list[$local_id]['type_name'];
                    if(empty($type_name)){
                        $type_name = lang('unknown_type');
                    }
                    $res['type'][$k]['local_type_name'] = $type_name;
                }
            }

            $this->assign('page',$res['page']);
            $this->assign('type',$res['type']);
            $this->assign('list',$res['data']);

            $this->assign('total',$res['page']['recordcount']);
            $this->assign('page',$res['page']['page']);
            $this->assign('limit',$res['page']['pagesize']);

            $param['page'] = '{page}';
            $param['limit'] = '{limit}';
            $this->assign('param',$param);

            $this->assign('param_str',http_build_query($param)) ;

            return $this->fetch('admin@collect/vod');
        }
        $page_now = isset($param['page']) && strlen($param['page']) > 0 ? (int)$param['page'] : 1;
        mac_echo('<title>' . $page_now . '/' . (int)$res['page']['pagecount'] . ' collecting..</title>');
        mac_echo('<style type="text/css">body{font-size:12px;color: #333333;line-height:21px;}span{font-weight:bold;color:#FF0000}</style>');
        model('Collect')->vod_data($param,$res );

    }

    public function art($param)
    {
        if($param['ac'] != 'list'){
            $key = $GLOBALS['config']['app']['cache_flag']. '_'.'collect_break_art';
            Cache::set($key, url('collect/api').'?'. http_build_query($param) );
        }
        $res = model('Collect')->art($param);
        if($res['code']>1){
            return $this->error($res['msg']);
        }

        if($param['ac'] == 'list'){

            $bind_list = config('bind');
            $type_list = model('Type')->getCache('type_list');

            foreach($res['type'] as $k=>$v){
                $key = $param['cjflag'] . '_' . $v['type_id'];
                $res['type'][$k]['isbind'] = 0;
                $local_id = intval($bind_list[$key]);
                if( $local_id>0 ){
                    $res['type'][$k]['isbind'] = 1;
                    $res['type'][$k]['local_type_id'] = $local_id;
                    $type_name = $type_list[$local_id]['type_name'];
                    if(empty($type_name)){
                        $type_name = lang('unknown_type');
                    }
                    $res['type'][$k]['local_type_name'] = $type_name;
                }
            }

            $this->assign('page',$res['page']);
            $this->assign('type',$res['type']);
            $this->assign('list',$res['data']);

            $this->assign('total',$res['page']['recordcount']);
            $this->assign('page',$res['page']['page']);
            $this->assign('limit',$res['page']['pagesize']);

            $param['page'] = '{page}';
            $param['limit'] = '{limit}';
            $this->assign('param',$param);

            $this->assign('param_str',http_build_query($param)) ;

            return $this->fetch('admin@collect/art');
        }

        mac_echo('<style type="text/css">body{font-size:12px;color: #333333;line-height:21px;}span{font-weight:bold;color:#FF0000}</style>');
        model('Collect')->art_data($param,$res );
    }

    public function actor($param)
    {
        if($param['ac'] != 'list'){
            $key = $GLOBALS['config']['app']['cache_flag']. '_'.'collect_break_actor';
            Cache::set($key, url('collect/api').'?'. http_build_query($param) );
        }
        $res = model('Collect')->actor($param);
        if($res['code']>1){
            return $this->error($res['msg']);
        }

        if($param['ac'] == 'list'){

            $bind_list = config('bind');
            $type_list = model('Type')->getCache('type_list');

            foreach($res['type'] as $k=>$v){
                $key = $param['cjflag'] . '_' . $v['type_id'];
                $res['type'][$k]['isbind'] = 0;
                $local_id = intval($bind_list[$key]);
                if( $local_id>0 ){
                    $res['type'][$k]['isbind'] = 1;
                    $res['type'][$k]['local_type_id'] = $local_id;
                    $type_name = $type_list[$local_id]['type_name'];
                    if(empty($type_name)){
                        $type_name = lang('unknown_type');
                    }
                    $res['type'][$k]['local_type_name'] = $type_name;
                }
            }

            $this->assign('page',$res['page']);
            $this->assign('type',$res['type']);
            $this->assign('list',$res['data']);

            $this->assign('total',$res['page']['recordcount']);
            $this->assign('page',$res['page']['page']);
            $this->assign('limit',$res['page']['pagesize']);

            $param['page'] = '{page}';
            $param['limit'] = '{limit}';
            $this->assign('param',$param);

            $this->assign('param_str',http_build_query($param)) ;

            return $this->fetch('admin@collect/actor');
        }

        mac_echo('<style type="text/css">body{font-size:12px;color: #333333;line-height:21px;}span{font-weight:bold;color:#FF0000}</style>');
        model('Collect')->actor_data($param,$res );
    }

    public function role($param)
    {
        if ($param['ac'] != 'list') {
            $key = $GLOBALS['config']['app']['cache_flag']. '_'.'collect_break_role';
            Cache::set($key, url('collect/api') . '?' . http_build_query($param));
        }
        $res = model('Collect')->role($param);
        if ($res['code'] > 1) {
            return $this->error($res['msg']);
        }

        if ($param['ac'] == 'list') {

            $bind_list = config('bind');
            $type_list = model('Type')->getCache('type_list');

            foreach ($res['type'] as $k => $v) {
                $key = $param['cjflag'] . '_' . $v['type_id'];
                $res['type'][$k]['isbind'] = 0;
                $local_id = intval($bind_list[$key]);
                if ($local_id > 0) {
                    $res['type'][$k]['isbind'] = 1;
                    $res['type'][$k]['local_type_id'] = $local_id;
                    $type_name = $type_list[$local_id]['type_name'];
                    if (empty($type_name)) {
                        $type_name = lang('unknown_type');
                    }
                    $res['type'][$k]['local_type_name'] = $type_name;
                }
            }

            $this->assign('page', $res['page']);
            $this->assign('type', $res['type']);
            $this->assign('list', $res['data']);

            $this->assign('total', $res['page']['recordcount']);
            $this->assign('page', $res['page']['page']);
            $this->assign('limit', $res['page']['pagesize']);

            $param['page'] = '{page}';
            $param['limit'] = '{limit}';
            $this->assign('param', $param);

            $this->assign('param_str', http_build_query($param));

            return $this->fetch('admin@collect/role');
        }

        mac_echo('<style type="text/css">body{font-size:12px;color: #333333;line-height:21px;}span{font-weight:bold;color:#FF0000}</style>');
        model('Collect')->role_data($param,$res );
    }

    public function website($param)
    {
        if ($param['ac'] != 'list') {
            $key = $GLOBALS['config']['app']['cache_flag']. '_'.'collect_break_website';
            Cache::set($key, url('collect/api') . '?' . http_build_query($param));
        }
        $res = model('Collect')->website($param);
        if ($res['code'] > 1) {
            return $this->error($res['msg']);
        }

        if ($param['ac'] == 'list') {

            $bind_list = config('bind');
            $type_list = model('Type')->getCache('type_list');

            foreach ($res['type'] as $k => $v) {
                $key = $param['cjflag'] . '_' . $v['type_id'];
                $res['type'][$k]['isbind'] = 0;
                $local_id = intval($bind_list[$key]);
                if ($local_id > 0) {
                    $res['type'][$k]['isbind'] = 1;
                    $res['type'][$k]['local_type_id'] = $local_id;
                    $type_name = $type_list[$local_id]['type_name'];
                    if (empty($type_name)) {
                        $type_name = lang('unknown_type');
                    }
                    $res['type'][$k]['local_type_name'] = $type_name;
                }
            }

            $this->assign('page', $res['page']);
            $this->assign('type', $res['type']);
            $this->assign('list', $res['data']);

            $this->assign('total', $res['page']['recordcount']);
            $this->assign('page', $res['page']['page']);
            $this->assign('limit', $res['page']['pagesize']);

            $param['page'] = '{page}';
            $param['limit'] = '{limit}';
            $this->assign('param', $param);

            $this->assign('param_str', http_build_query($param));

            return $this->fetch('admin@collect/website');
        }

        mac_echo('<style type="text/css">body{font-size:12px;color: #333333;line-height:21px;}span{font-weight:bold;color:#FF0000}</style>');
        model('Collect')->website_data($param,$res );
    }

    /**
     * Crawls OPhim
     */
    public function ophim()
    {
        return $this->fetch('admin@collect/ophim');
    }

    public function crawl_ophim_link()
    {
        try {
            $url = input('url');
            $host = parse_url($url, PHP_URL_HOST);
            $api_url = str_replace($host, 'ophim1.com', $url);
            $html = mac_curl_get($api_url);
            $html = mac_filter_tags($html);
            $sourcePage = json_decode($html, true);
            $title = $sourcePage['movie']['name'];
            $year = $sourcePage['movie']['year'];
            $ophim_id = $sourcePage['movie']['_id'];
            $result = $this->add_movie($title, $year, $ophim_id, $sourcePage);
            return $result;
        } catch (\Throwable $th) {
            $result = array(
                'status' => true,
                'msg' => "Crawl error: " . $th,
            );
            return json_encode($result);
        }
    }

    public function crawl_ophim_page()
    {
        $url = input('url');
        $html = mac_curl_get($url);
        if(empty($html)){
            return ['code'=>1001, 'msg'=>lang('model/collect/get_html_err') . ', url: ' . $url];
        }
        $html = mac_filter_tags($html);
        $sourcePage = json_decode($html);
        $listMovies = [];

        if(count($sourcePage->items) > 0) {
            foreach ($sourcePage->items as $key => $item) {
                array_push($listMovies, "https://ophim.tv/phim/{$item->slug}|{$item->_id}|{$item->modified->time}|{$item->name}|{$item->origin_name}|{$item->year}");
            }
            echo join("\n", $listMovies);
        } else {
            echo [];
        }
        die();
    }

    public function crawl_ophim_movies()
    {
        try {
            $data_post = input('url');
            $filterType = input('filterType');
            $url = explode('|', $data_post)[0];
            $ophim_id = explode('|', $data_post)[1];
            $ophim_update_time 	= explode('|', $data_post)[2];
            $title = explode('|', $data_post)[3];
            $org_title = explode('|', $data_post)[4];
            $year = explode('|', $data_post)[5];

            $host = parse_url($url, PHP_URL_HOST);
            $api_url = str_replace($host, 'ophim1.com', $url);
            $html = mac_curl_get($api_url);
            $html = mac_filter_tags($html);
            $sourcePage = json_decode($html, true);

            if ($filterType) {
                $filterType = explode(",", $filterType);
            }

            $result = $this->add_movie($title, $year, $ophim_id, $sourcePage, $filterType);
            return $result;

        } catch (Exception $e) {
            $result = array(
                'status' => true,
                'msg' => "Crawl error"
            );
            return json_encode($result);
        }
    }

    protected function add_movie($title, $year, $ophim_id, $sourcePage, $filterType = [])
    {
        try {
            if (in_array($sourcePage["movie"]["type"], $filterType)) {
                return json_encode(array(
                    'status' => true,
                    'msg' => "Bỏ qua",
                ));
            }
            // Check cập nhật
            $where = [];
            $where['vod_name'] = mac_filter_xss($title);
            $where['vod_year'] = $year;
            $where['vod_writer'] = $ophim_id;
            $info = model('Vod')->where($where)->find();

            $vod_search = model('VodSearch');
            $vod_search_enabled = $vod_search->isCollectEnabled();
            $vod_id = "";

            if ( !$info ) {
                $data = $this->create_data($sourcePage, $ophim_id, 'i');

                $vod_id = model('Vod')->insert($data, false, true);
                if ($vod_id > 0) {
                    $vod_search_enabled && $vod_search->checkAndUpdateTopResults(['vod_id' => $vod_id] + $data, true);
                    $des = lang('model/collect/add_ok');
                } else {
                    $des = 'Vod insert failed';
                }

            } else {
                $data = $this->create_data($sourcePage, $ophim_id, 'u');
                
                $vod_id = $info['vod_id'];
                $where = [];
                $where['vod_id'] = $info['vod_id'];
                $update = VodValidate::formatDataBeforeDb($data);
                $res = model('Vod')->where($where)->update($update);

            }

            $result = array(
                'status' => true,
                'msg' => 'Done',
                'post_id' => $vod_id,
            );
            return json_encode($result);
        } catch (\Throwable $th) {
            $result = array(
                'status' => true,
                'post_id' => $vod_id,
                'msg' => "Crawl error: " . $th,
            );
            return json_encode($result);
        }
    }

    protected function create_data($sourcePage, $ophim_id, $flag)
    {
        if($sourcePage["movie"]["type"] == "single") {
            $type_name = "phim lẻ";
        } elseif ($sourcePage["movie"]["type"] == "hoathinh") {
            $type_name = "hoạt hình";
        } elseif ($sourcePage["movie"]["type"] == "tvshows") {
            $type_name = "tv shows";
        } elseif ($sourcePage["movie"]["type"] == "series") {
            $type_name = "phim bộ";
        }
        $type_id = 1;
        $type_id_1 = 0;
        $type_list = model('Type')->getCache('type_list');
        foreach ( $type_list as $key => $val ) {
            if ( hash_equals($type_name, strtolower($val['type_name'])) ) {
                $type_id = $val['type_id'];
                $type_id_1 = $val['type_pid'];
            }
        }
    
        $arrCat = [];
        foreach ($sourcePage["movie"]["category"] as $key => $value) {
            array_push($arrCat, $value["name"]);
        }
        if($sourcePage["movie"]["chieurap"] == true) {
            array_push($arrCat, "Chiếu Rạp");
        }
        if($sourcePage["movie"]["type"] == "hoathinh") {
            array_push($arrCat, "Hoạt Hình");
        }
        if($sourcePage["movie"]["type"] == "tvshows") {
            array_push($arrCat, "TV Shows");
        }
    
        $arrCountry 	= [];
        foreach ($sourcePage["movie"]["country"] as $key => $value) {
            array_push($arrCountry, $value["name"]);
        }
    
        $arrTags 			= [];
        array_push($arrTags, $sourcePage["movie"]["name"]);
        if($sourcePage["movie"]["name"] != $sourcePage["movie"]["origin_name"]) array_push($arrTags, $sourcePage["movie"]["origin_name"]);

        if($flag == 'i') {
            $vod_pic = $this->syncImages(1, $sourcePage["movie"]["thumb_url"])['pic'];
            $vod_pic_slide = $this->syncImages(1, $sourcePage["movie"]["poster_url"])['pic'];
        }
    
        $data = array(
            'type_id' => $type_id,
            'type_id_1' => $type_id_1,
            'vod_name' => $sourcePage["movie"]["name"],
            'vod_sub' => $this->slugify($sourcePage["movie"]["name"], '-'),
            'vod_en' => $sourcePage["movie"]["origin_name"],
            'vod_status' => 1,
            'vod_letter' => strtoupper(substr($this->slugify($sourcePage["movie"]["name"], ' '),0,1)),
            'vod_tag' => implode(",", $arrTags),
            'vod_class' => implode(",", $arrCat),
            'vod_actor' => implode(',', $sourcePage["movie"]["actor"]),
            'vod_director' => implode(',', $sourcePage["movie"]["director"]),
            'vod_writer' => $ophim_id,
            'vod_remarks' => $sourcePage["movie"]["episode_current"],
            'vod_weekday' => $sourcePage["movie"]["showtimes"],
            'vod_area' => implode(",", $arrCountry),
            'vod_lang' => $sourcePage["movie"]["lang"],
            'vod_year' => $sourcePage["movie"]["year"],
            'vod_version' => $sourcePage["movie"]["quality"],
            'vod_duration' => $sourcePage["movie"]["time"],
            'vod_time' => time(),
            'vod_time_add' => time(),
            'vod_content' => preg_replace('/\\r?\\n/s', '', $sourcePage["movie"]["content"]),
            'vod_play_url' => $this->play_list($sourcePage["episodes"]),
            'vod_down_url' => '',
            'vod_plot_name' => '',
            'vod_plot_detail' => '',
            'vod_pic' => $vod_pic,
            'vod_pic_thumb' => $vod_pic,
            'vod_pic_slide' => $vod_pic_slide,
        );

        if($sourcePage["movie"]["status"] == 'trailer') {
            $data += array(
                'vod_play_from' => '',
                'vod_play_server' => '',
                'vod_play_note' => '',
            );
        } else {
            $data += array(
                'vod_play_from' => 'nguon$$$ngm3u8',
                'vod_play_server' => 'no$$$no',
                'vod_play_note' => '$$$',
            );
        }

        if($flag == 'u') {
            unset($data['vod_pic']);
            unset($data['vod_pic_thumb']);
            unset($data['vod_pic_slide']);
        }
    
        return $data;
    }

    protected function upload_image($url, $name, $year, $flag)
    {
        $ext = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
        $_save_path = 'upload/vod/' . date('Ymd') . '/';
        if(!file_exists($_save_path)){
            mac_mkdirss($_save_path);
        }

        $_save_name = $this->slugify($name) . "-" . $flag . $year . "." . $ext;
        file_put_contents($_save_path.$_save_name, file_get_contents($url));

        return $_save_path.$_save_name;
    }

    protected function syncImages($pic_status, $pic_url, $flag = 'vod')
    {
        $img_url_downloaded = $pic_url;
        if ($pic_status == 1) {
            $config = (array)config('maccms.upload');
            $img_url_downloaded = model('Image')->down_load($pic_url, $config, $flag);
        }
        return ['pic' => $img_url_downloaded];
    }

    protected function play_list($episodes)
    {
        $vod_play_note = '$$$';

        $vod_play_url = "";
        $vod_embed = [];
        $vod_m3u8 = [];
        if ($episodes[0]["server_data"][0]["link_m3u8"] !== "") {
            foreach ($episodes as $key => $servers) {
                foreach ($servers['server_data'] as $episode) {
                    $vod_embed[] = $episode["name"] . '$' . $episode["link_embed"];
                    $vod_m3u8[] = $episode["name"] . '$' . $episode["link_m3u8"];
                }
            }
            $embed_list = implode("#", $vod_embed);
            $m3u8_list = implode("#", $vod_m3u8);
            $vod_play_url = join($vod_play_note, [$embed_list, $m3u8_list]);
        }
        return $vod_play_url;
    }

    protected function slugify($str, $divider = '-')
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', $divider, $str);
        return $str;
    }

    /**
     * Myanimelist
     */
    public function myanimelist()
    {
        if (Request()->isPost()) {
            $type_id = input('type_id');
            $link = input('anime_link');
            if ($type_id == '' || $link == '') {
                return $this->error('Vui lòng nhập TypeID và Link');
            }
            $source_page = file_get_contents($link);
            $doc = new DOMDocument('1.0', 'utf-8');
            libxml_use_internal_errors(true);
            $doc->preserveWhiteSpace = false;
            $doc->loadHTML(mb_convert_encoding($source_page, 'HTML-ENTITIES', 'UTF-8'));

            $data = [];
            $data['type_id'] = intval(input('type_id'));
            $data['vod_en'] = $this->getElementsByAttr($doc, 'meta', 'property', 'og:title')[0]->getAttribute('content');
            $data['vod_pic'] = $data['vod_pic_thumb'] = $this->getElementsByAttr($doc, 'meta', 'property', 'og:image')[0]->getAttribute('content');
            $data['vod_name'] = $this->getElementsByAttr($doc, 'meta', 'property', 'og:title')[0]->getAttribute('content');
            $data['vod_writer'] = $doc->getElementById('myinfo_anime_id')->getAttribute('value');
            
            $content = $doc->getElementById('content');
            $infoLeft = $this->getElementsByAttr($content, 'div', 'class', 'leftside')[0];
            $infoRight = $this->getElementsByAttr($content, 'div', 'class', 'rightside')[0];
            $baseInfo = $this->getElementsByAttr($infoLeft, 'div', 'class', 'spaceit_pad');

            $synopsis_tag = ['p', 'span'];
            foreach ( $synopsis_tag as $tag ) {
                $description = $this->getElementsByAttr($infoRight, $tag, 'itemprop', 'description');
                if ($description) {
                    $data['vod_content'] = $description[0]->ownerDocument->saveHTML( $description[0] );
                    break;
                }
            }

            $genres = [];
            $genre_nodes = $this->getElementsByAttr($infoLeft, 'span', 'itemprop', 'genre');
            foreach ( $genre_nodes as $node ) {
                if ( $node->nodeType == 1 ) { $genres[] = $node->textContent; }
            }
            $data['vod_class'] = join(',', $genres);
            $score = $this->getElementsByAttr($infoLeft, 'span', 'itemprop', 'ratingValue');
            if ($score) { $data['vod_score'] = $score[0]->textContent; } else { $data['vod_score'] = random_int(5,8) * 1.2; }

            $synonyms = [];

            foreach ($baseInfo as $div) {
                if ( ! $div->hasChildNodes() ) { return; }

                foreach ($div->childNodes as $node) {
                    if ( $node->nodeType == 1 && $node->getAttribute("class") == "dark_text") {
                        switch ($node->textContent) {
                            case 'Synonyms:':
                            case 'Japanese:':
                                $alias = explode(',', trim($node->nextSibling->textContent));
                                foreach ( $alias as &$n ) {
                                    $n = trim($n);
                                    // $n = mb_convert_encoding($n, 'UTF-8', 'auto');
                                    array_push($synonyms, $n);
                                }
                                break;
                            case 'Type:':
                                $data['vod_lang'] = trim($node->nextSibling->nextSibling->textContent);
                                break;
                            case 'Episodes:':
                                $data['vod_remarks'] = trim($node->nextSibling->textContent);
                                break;
                            case 'Status:':
                                $data['vod_remarks'] = array_key_exists('vod_remarks', $data) ? 'Ep.' . $data['vod_remarks'] . '-' . trim($node->nextSibling->textContent) : trim($node->nextSibling->textContent);
                                break;
                            case 'Premiered:':
                                $data['vod_year'] = trim($node->nextSibling->nextSibling->textContent);
                                break;
                            case 'Studios:':
                                $data['vod_director'] = trim($node->nextSibling->nextSibling->textContent);
                                break;
                            case 'Duration:':
                                $data['vod_duration'] = trim($node->nextSibling->textContent);
                                break;
                            default:
                                # code...
                                break;
                        }
                    }
                }
            }
            $data['vod_en'] = join(', ', $synonyms);

            // Characters & Voice Actors
            $detail_characters_list = $this->getElementsByAttr($infoRight, 'div', 'class', 'detail-characters-list');
            if ( count($detail_characters_list) ) { $detail_characters_list = $detail_characters_list[0]; }
            $characters_actors = [];

            if ( $detail_characters_list->hasChildNodes() ) {
                $key = 0;
                foreach ($detail_characters_list->childNodes as $column) {
                    if ( ! $column->hasChildNodes() ) { break; }
                    $tables = $column->childNodes;
                    foreach ( $tables as $table ) {
                        $picSurrounds = $this->getElementsByAttr($table, 'div', 'class', 'picSurround');
                        if ( count($picSurrounds) == 2 ) {
                            for ($i=0; $i < 2; $i++) { 
                                $nodes = $picSurrounds[$i]->childNodes;
                                foreach ($nodes as $node) {
                                    if ( $node->nodeType == 1 && $node->nodeName == 'a' ) {
                                        foreach ($node->childNodes as $item) {
                                            if ( $item->nodeType == 1 && $item->nodeName == 'img' ) {
                                                $img = $item->getAttribute('data-src');
                                                $img = preg_replace('/\\?.*/', '', $img);
                                                $img = parse_url($img);
                                                $path = preg_replace('/\/r\/\d+x\d+/', '', $img['path']);

                                                if ( $i == 0 ) {
                                                    $characters_actors[$key]['c_name'] = $item->getAttribute('alt');
                                                    $characters_actors[$key]['c_img'] = $img['scheme'] . '://' . $img['host'] . $path;
                                                } elseif ( $i == 1 ) {
                                                    $characters_actors[$key]['v_name'] = $item->getAttribute('alt');
                                                    $characters_actors[$key]['v_img'] = $img['scheme'] . '://' . $img['host'] . $path;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        } elseif (count($picSurrounds) == 1 ) {
                            foreach ($picSurrounds[0]->childNodes as $node) {
                                if ( $node->nodeType == 1 && $node->nodeName == 'a' ) {
                                    foreach ($node->childNodes as $item) {
                                        if ( $item->nodeType == 1 && $item->nodeName == 'img' ) {
                                            $img = $item->getAttribute('data-src');
                                            $img = preg_replace('/\\?.*/', '', $img);
                                            $img = parse_url($img);
                                            $path = preg_replace('/\/r\/\d+x\d+/', '', $img['path']);
                                            $characters_actors[$key]['c_name'] = $item->getAttribute('alt');
                                            $characters_actors[$key]['c_img'] = $img['scheme'] . '://' . $img['host'] . $path;
                                        }
                                    }
                                }
                            }
                        }
                        // Vai trò
                        $role = $this->getElementsByAttr($table, 'div', 'class', 'spaceit_pad');
                        if ( count($role) ) {
                            if ( ! $role[0]->hasChildNodes() ) { continue; }
                            foreach ( $role[0]->childNodes as $item ) {
                                if ( $item->nodeType == 1 && $item->nodeName == "small") {
                                    $characters_actors[$key]['c_role'] = $item->textContent;
                                }
                            }
                        }
                        $key += 1;
                    }
                }
            }

            $status = $this->anime_insert($data, $characters_actors);

            if ($status) {
                return $this->success('Thu thập thành công');
            } else {
                return $this->error('Thất bại, vui lòng kiểm tra lại');
            }
        }

        return $this->fetch('admin@collect/myanimelist');
    }

    protected function anime_insert($baseInfo, $characters_actors)
    {
        if ( ! array_key_exists('vod_en', $baseInfo) ) {
            $baseInfo['vod_en'] = $baseInfo['vod_name'];
        }
        $slug = $this->slugify($baseInfo['vod_name']);
        $missing_data = array(
            'vod_sub' => $slug,
            'vod_status' => 1,
            'vod_letter' => strtoupper(substr($slug,0,1)),
            'vod_area' => 'Japan',
            'vod_time' => time(),
            'vod_time_add' => time(),
            'vod_play_url' => '',
            'vod_down_url' => '',
            'vod_plot_name' => '',
            'vod_plot_detail' => '',
        );
        $data = array_merge($missing_data, $baseInfo);

        $vod_id = 0;
        $where = [];
        $where['vod_name'] = mac_filter_xss($baseInfo['vod_name']);
        $where['vod_writer'] = $baseInfo['vod_writer'];
        $info = model('Vod')->where($where)->find();

        if ( !$info ) {
            $vod_id = model('Vod')->insert($data, false, true);
        } else {                
            $vod_id = $info['vod_id'];
            $where = [];
            $where['vod_id'] = $info['vod_id'];
            $update = VodValidate::formatDataBeforeDb($data);
            model('Vod')->where($where)->update($update);
        }

        $is_success = false;

        if ($vod_id != 0) {
            $is_success = true;
            foreach ($characters_actors as $character) {
                if ( array_key_exists('c_name', $character) ) {
                    $actor_id = model('Actor')->where(['actor_name' => $character['c_name']])->find();
                    if ( $actor_id ) { continue; }
                    $actor = array(
                        'type_id' => $vod_id,
                        'actor_name' => $character['c_name'], // Character
                        'actor_en' => array_key_exists('v_name', $character) ? $character['v_name'] : '',  // Voice
                        'actor_pic' => array_key_exists('c_img', $character) ? $character['c_img'] : '', // Character image
                        'actor_blurb' => array_key_exists('v_img', $character) ? $character['v_img'] : '', // Voice image
                        'actor_alias' => array_key_exists('c_role', $character) ? $character['c_role'] : 'N/A',
                        'actor_status' => 1,
                        'actor_content' => $data['vod_name'],
                    );
                    $actor_id = model('Actor')->insert($actor, false, true);
                    if ($actor_id) {
                        $is_success = true;
                    }
                }
            }
        } else {
            $is_success = false;
        }

        return $is_success;
    }

    protected function getElementsByAttr($parentNode, $tagName, $attributeName, $className) {
        $nodes=array();

        $childNodeList = $parentNode->getElementsByTagName($tagName);
        for ($i = 0; $i < $childNodeList->length; $i++) {
            $temp = $childNodeList->item($i);
            if (stripos($temp->getAttribute($attributeName), $className) !== false) {
                $nodes[]=$temp;
            }
        }

        return $nodes;
    }
}
