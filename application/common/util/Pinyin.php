<?php

namespace app\common\util;

class Pinyin
{
    private static $pinyins = null;

    public function __construct()
    {
    }

    public static function get($str, $ret_format = 'all', $placeholder = '', $allow_chars = '/[a-zA-Z\d ]/')
    {

        if (null === self::$pinyins) {
            $data = file_get_contents('./static/data/pinyin.dat');

            $rows = explode('|', $data);

            self::$pinyins = array();
            foreach ($rows as $v) {
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
        $rs = str_replace([' ', '+', '/', '\\', '|', '\'', '?', '%', '#', '&', '=', '!', '(', ')', ';', ':', '<', '>'], '', $rs);
        return $rs;
    }

    function make_beautiful_slug($text)
    {
        $text = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $text);
        $text = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $text);
        $text = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $text);
        $text = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $text);
        $text = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $text);
        $text = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $text);
        $text = preg_replace("/(đ)/", "d", $text);
        $text = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $text);
        $text = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $text);
        $text = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $text);
        $text = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $text);
        $text = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $text);
        $text = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $text);
        $text = preg_replace("/(Đ)/", "D", $text);

        $divider = '-';
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
