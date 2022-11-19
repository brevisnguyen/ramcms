<?php
namespace app\admin\controller;
use think\Db;
use think\Cache;
use app\common\validate\Vod as VodValidate;
use think\Exception;

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
            $url = explode('|', $data_post)[0];
            $ophim_id = explode('|', $data_post)[1];
            $ophim_update_time 	= explode('|', $data_post)[2];
            $title = explode('|', $data_post)[3];
            $org_title = explode('|', $data_post)[4];
            $year = explode('|', $data_post)[5];

            $api_url = str_replace('ophim.tv', 'ophim1.com', $url);
            $html = mac_curl_get($api_url);
            $html = mac_filter_tags($html);
            $sourcePage = json_decode($html, true);

            // $data = $this->create_data($sourcePage, $url, $ophim_id, $ophim_update_time);

            // if ( strpos($data['vod_class'], 'Phim 18+') !== false ) {
            //     $result = array(
            //         'status' => true,
            //         'post_id' => '',
            //     );
            //     return json_encode($result);
            // }

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
                foreach ($sourcePage["movie"]["category"] as $key => $value) {
                    if ( strpos($value["name"], 'Phim 18+') !== false ) {
                        $result = array(
                            'status' => true,
                            'post_id' => '',
                        );
                        return json_encode($result);
                    }
                }

                $data = $this->create_data($sourcePage, $url, $ophim_id, 'i');

                $vod_id = model('Vod')->insert($data, false, true);
                if ($vod_id > 0) {
                    $vod_search_enabled && $vod_search->checkAndUpdateTopResults(['vod_id' => $vod_id] + $data, true);
                    $des = lang('model/collect/add_ok');
                } else {
                    $des = 'Vod insert failed';
                }

            } else {                
                foreach ($sourcePage["movie"]["category"] as $key => $value) {
                    if ( strpos($value["name"], 'Phim 18+') !== false ) {
                        $result = array(
                            'status' => true,
                            'post_id' => '',
                        );
                        return json_encode($result);
                    }
                }

                $data = $this->create_data($sourcePage, $url, $ophim_id, 'u');
                
                $vod_id = $info['vod_id'];
                $where = [];
                $where['vod_id'] = $info['vod_id'];
                $update = VodValidate::formatDataBeforeDb($data);
                $res = model('Vod')->where($where)->update($update);

            }

            $result = array(
                'status' => true,
                'post_id' => $vod_id,
            );
            return json_encode($result);

        } catch (Exception $e) {
            $result = array(
                'status' => true,
                'post_id' => $vod_id,
                'msg' => "Crawl error"
            );
            return json_encode($result);
        }
    }

    protected function create_data($sourcePage, $url, $ophim_id, $flag)
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

        // if($flag == 'i') {
        //     $vod_pic = $this->upload_image($sourcePage["movie"]["thumb_url"], $sourcePage["movie"]["name"], $sourcePage["movie"]["year"], 'thumb');
        //     $vod_pic_slide = $this->upload_image($sourcePage["movie"]["poster_url"], $sourcePage["movie"]["name"], $sourcePage["movie"]["year"], 'slide');
        // }
    
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
            'vod_pic' => $sourcePage["movie"]["thumb_url"],
            'vod_pic_thumb' => $sourcePage["movie"]["thumb_url"],
            'vod_pic_slide' => $sourcePage["movie"]["poster_url"],
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
}
