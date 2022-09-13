<?php
namespace app\common\util;

class Pinyin
{
    private static $pinyins = null;

    public function __construct() {

    }

    public static function get($str, $ret_format = 'all', $placeholder = '', $allow_chars = '/[a-zA-Z\d ]/') {

        if (null === self::$pinyins) {
            $data = file_get_contents('./static/data/pinyin.dat');

            $rows = explode('|', $data);

            self::$pinyins = array();
            foreach($rows as $v) {
                list($py, $vals) = explode(':', $v);
                $chars = explode(',', $vals);

                foreach ($chars as $char) {
                    self::$pinyins[$char] = $py;
                }
            }
        }

        $str = trim($str);
        $len = mb_strlen($str, 'UTF-8');
        $rs = '';
        for ($i = 0; $i < $len; $i++) {
            $chr = mb_substr($str, $i, 1, 'UTF-8');
            $asc = ord($chr);
            if ($asc < 0x80) { // 0-127
                if (preg_match($allow_chars, $chr)) { // 用参数控制正则
                    $rs .= $chr; // 0-9 a-z A-Z 空格
                } else { // 其他字符用填充符代替
                    $rs .= $placeholder;
                }
            } else { // 128-255
                if (isset(self::$pinyins[$chr])) {
                    $rs .= 'first' === $ret_format ? self::$pinyins[$chr][0] : (self::$pinyins[$chr] . '');
                } else {
                    $rs .= $placeholder;
                }
            }

            if ('one' === $ret_format && '' !== $rs) {
                return $rs[0];
            }
        }
        $rs = str_replace([' ','+','/','\\','|','\'','?','%','#','&','=','!','(',')',';',':','<','>'],'',$rs);
        return $rs;
    }

    public static function slugify($str, $divider = '-')
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