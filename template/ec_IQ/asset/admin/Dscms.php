<?php
namespace app\admin\controller;
use think\Db;
use think\Config;
use think\Cache;
use think\Exception;
use think\Request;

class Dscms extends Base
{
    public function configweixin()
    {
        if (Request()->isPost()) {
            $config = input();
            $config_new['dscms'] = $config['dscms'];

            $config_old = config('dspc');
            $config_new = array_merge($config_old, $config_new);

            $res = mac_arr2file(APP_PATH . 'extra/dspc.php', $config_new);
            if ($res === false) {
                return $this->error('保存失败，请重试!');
            }
            return $this->success('保存成功!');
        };
        function domain()
        {
            $request = Request::instance();
            $domain=$request->domain();
            return $domain;
        };
        $key = 'oTeVgoTnZkc$Fv5FCBEh*97FtVcCfjop';
        $url = domain();

        function makeSign($data, $appSecret)
        {
            ksort($data);
            $str = '';
            foreach ($data as $k => $v) {

                $str .= '&' . $k . '=' . $v;
            }
            $str = trim($str, '&');
            $sign = strtoupper(md5($str . '&key=' . $appSecret));
            return $sign;
        }
        //接口地址
        $host = 'http://api.cgzyb.com/operate.php';
        //默认必传参数
        $data = [
            'key' => $key,
            'url' => $url,
        ];
        //加密的参数
        $data['sign'] = makeSign($data,$appSecret);
        //拼接请求地址
        $url = $host .'?'. http_build_query($data);
        //执行请求获取数据
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        $dpdata = [
            'title' => $key,
            'fechg' => $output,
        ];
        $this->assign('config', config('dspc'));
        $this->assign($dpdata);
        return $this->fetch('admin@system/dspccms');
    }

}
