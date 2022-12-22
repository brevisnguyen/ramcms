<?php
namespace app\admin\controller;

class Dianying extends Base
{
    public function configweixin()
    {
        if (Request()->isPost()) {
            $config = input();
            $config_new['dscms'] = $config['dscms'];

            $config_old = config('sb');
            $config_new = array_merge($config_old, $config_new);

            $res = mac_arr2file(APP_PATH . 'extra/sb.php', $config_new);
            if ($res === false) {
                return $this->error('保存失败，请重试!');
            }
            return $this->success('保存成功!');
        };
        $this->assign('config', config('sb'));
        return $this->fetch('admin@system/sbcms');
    }

}
