<?php
return array (
  'db' => 
  array (
    'type' => 'mysql',
    'path' => '',
    'server' => '127.0.0.1',
    'port' => '3306',
    'name' => 'maccms10',
    'user' => 'root',
    'pass' => 'root',
    'tablepre' => 'mac_',
    'backup_path' => './application/data/backup/database/',
    'part_size' => 20971520,
    'compress' => 1,
    'compress_level' => 4,
  ),
  'site' => 
  array (
    'site_name' => 'vncms',
    'site_url' => 'https://vncms.test',
    'site_keywords' => 'Từ kho&aacute; cho website của bạn',
    'site_description' => 'Thẻ m&ocirc; tả website của bạn',
    'site_email' => 'test@ramcms.com',
    'install_dir' => '/',
    'site_logo' => 'upload/site/20221218-1/fcfc15a53bbe64bc245460d2ab0eec28.png',
    'site_waplogo' => 'upload/site/20221218-1/fcfc15a53bbe64bc245460d2ab0eec28.png',
    'template_dir' => 'mooncake',
    'html_dir' => 'html',
    'site_tj' => 'Mã thống kê website(Google analytics, ...)',
    'site_status' => '1',
    'site_close_tip' => 'Trang web đang được bảo tr&igrave;, vui l&ograve;ng quay lại sau',
    'ads_dir' => 'ads',
    'mob_ads_dir' => 'ads',
  ),
  'app' => 
  array (
    'pathinfo_depr' => '/',
    'suffix' => 'html',
    'popedom_filter' => '0',
    'cache_type' => 'file',
    'cache_host' => '127.0.0.1',
    'cache_port' => '6379',
    'cache_username' => '',
    'cache_password' => '',
    'cache_flag' => 'a6bcf9aa58',
    'cache_core' => '0',
    'cache_time' => '3600',
    'cache_page' => '0',
    'cache_time_page' => '3600',
    'compress' => '0',
    'input_type' => '1',
    'ajax_page' => '0',
    'show' => '1',
    'show_verify' => '0',
    'search' => '1',
    'search_verify' => '0',
    'search_len' => '30',
    'search_timespan' => '0',
    'search_vod_rule' => 'vod_en|vod_actor|vod_director',
    'search_art_rule' => 'art_en|art_sub',
    'vod_search_optimise' => 'frontend',
    'vod_search_optimise_cache_minutes' => 20160,
    'copyright_status' => '1',
    'copyright_notice' => 'Video tạm thời kh&ocirc;ng c&oacute; sẵn do bị d&iacute;nh bản quyền',
    'page_404' => '404',
    'player_sort' => '0',
    'encrypt' => '0',
    'search_hot' => 'Phim đang hot,B&agrave;i viết đang hot,Chủ đề đang hot',
    'art_extend_class' => 'Talk Show, Buổi phỏng vấn, T&igrave;nh y&ecirc;u cuộc sống, C&ocirc;ng nghệ, Hội bỉm sữa, Nghiện Phim',
    'vod_extend_class' => 'T&igrave;nh Cảm, H&agrave;nh Động, H&agrave;i Hước, Chiến Tranh, Khoa Học Viễn Tưởng, Dramma, V&otilde; Thuật, Phi&ecirc;u Lưu, Kinh Dị, Kh&aacute;c',
    'vod_extend_state' => 'HD, Trailer, Full',
    'vod_extend_version' => 'Full HD, HD, 1080, Bản CAM, TV',
    'vod_extend_area' => '&Acirc;u Mỹ, Nhật Bản, H&agrave;n Quốc, Trung Quốc, Đ&agrave;i Loan, Anh, Ph&aacute;p, T&acirc;y Ban Nha, Thổ Nhĩ Kỳ, Việt Nam',
    'vod_extend_lang' => 'Vietsub, Thuyết Minh',
    'vod_extend_year' => '2021,2020,2019,2018,2017,2016,2015,2014,2013,2012,2011,2010,2009,2008,2007,2006,2005,2004,2003,2002,2001,2000',
    'vod_extend_weekday' => 'Thứ 2, Thứ 3, Thứ 4, Thứ 5, Thứ 6, Thứ 7, Chủ Nhật',
    'actor_extend_area' => '&Acirc;u Mỹ, Nhật Bản, H&agrave;n Quốc, Trung Quốc, Đ&agrave;i Loan, Anh, Ph&aacute;p, T&acirc;y Ban Nha, Thổ Nhĩ Kỳ, Việt Nam, Quốc Gia Kh&aacute;c',
    'filter_words' => 'www,http,com,net',
    'extra_var' => '',
    'collect_timespan' => '3',
    'pagesize' => '20',
    'makesize' => '30',
    'admin_login_verify' => '1',
    'editor' => 'Ueditor',
    'lang' => 'vi-vn',
  ),
  'user' => 
  array (
    'status' => '1',
    'reg_open' => '1',
    'reg_status' => '1',
    'reg_phone_sms' => '0',
    'reg_email_sms' => '0',
    'email_white_hosts' => '',
    'email_black_hosts' => '',
    'reg_verify' => '0',
    'login_verify' => '0',
    'reg_points' => '10',
    'reg_num' => '1',
    'invite_reg_points' => '10',
    'invite_visit_points' => '1',
    'invite_visit_num' => '1',
    'reward_status' => '1',
    'reward_ratio' => '10',
    'reward_ratio_2' => '30',
    'reward_ratio_3' => '50',
    'cash_status' => '1',
    'cash_ratio' => '100',
    'cash_min' => '1',
    'trysee' => '0',
    'vod_points_type' => '1',
    'art_points_type' => '1',
    'portrait_status' => '1',
    'portrait_size' => '100x100',
    'filter_words' => 'admin,cao,sex,xxx',
  ),
  'gbook' => 
  array (
    'status' => '1',
    'audit' => '0',
    'login' => '0',
    'verify' => '1',
    'pagesize' => '20',
    'timespan' => '3',
  ),
  'comment' => 
  array (
    'status' => '1',
    'audit' => '0',
    'login' => '0',
    'verify' => '1',
    'pagesize' => '20',
    'timespan' => '3',
  ),
  'upload' => 
  array (
    'img_key' => 'baidu|douban|tvmao',
    'img_api' => '/img.php?url=',
    'thumb' => '0',
    'thumb_size' => '300x300',
    'thumb_type' => '1',
    'watermark' => '0',
    'watermark_location' => '5',
    'watermark_content' => 'Brevis',
    'watermark_size' => '40',
    'watermark_color' => '#D2001A',
    'protocol' => 'https',
    'mode' => 'local',
    'keep_local' => '0',
    'remoteurl' => 'http://img.test.com/',
    'api' => 
    array (
      'ftp' => 
      array (
        'host' => '',
        'port' => '21',
        'user' => 'test',
        'pwd' => 'test',
        'path' => '/',
        'url' => '',
      ),
      'qiniu' => 
      array (
        'bucket' => '',
        'accesskey' => '',
        'secretkey' => '',
        'url' => '',
      ),
      'uomg' => 
      array (
        'openid' => '',
        'key' => '',
        'type' => 'sogou',
      ),
      'upyun' => 
      array (
        'bucket' => '',
        'username' => '',
        'pwd' => '',
        'url' => '',
      ),
      'weibo' => 
      array (
        'user' => '',
        'pwd' => '',
        'size' => 'large',
        'cookie' => '',
        'time' => '1546239694',
      ),
    ),
  ),
  'interface' => 
  array (
    'status' => 0,
    'pass' => 'L29LMYKFVHH43XMF',
    'vodtype' => '动作片=动作',
    'arttype' => '头条=头条',
    'actortype' => '',
    'websitetype' => '',
  ),
  'pay' => 
  array (
    'min' => '10',
    'scale' => '1',
    'card' => 
    array (
      'url' => '',
    ),
    'alipay' => 
    array (
      'account' => '111',
      'appid' => '',
      'appkey' => '',
    ),
    'codepay' => 
    array (
      'appid' => '40625',
      'appkey' => '',
      'type' => '1,2',
      'act' => '0',
    ),
    'weixin' => 
    array (
      'appid' => '222',
      'mchid' => '',
      'appkey' => '',
    ),
    'zhapay' => 
    array (
      'appid' => '18039',
      'appkey' => '',
      'type' => '1,2',
      'act' => '2',
    ),
  ),
  'collect' => 
  array (
    'vod' => 
    array (
      'status' => '1',
      'hits_start' => '1',
      'hits_end' => '1000',
      'updown_start' => '1',
      'updown_end' => '1000',
      'score' => '1',
      'pic' => '1',
      'tag' => '1',
      'psename' => '1',
      'psernd' => '0',
      'psesyn' => '0',
      'pseplayer' => '0',
      'psearea' => '0',
      'pselang' => '0',
      'urlrole' => '0',
      'inrule' => ',g',
      'uprule' => ',a',
      'filter' => '',
      'namewords' => '',
      'thesaurus' => '',
      'playerwords' => '',
      'areawords' => '',
      'langwords' => '',
      'words' => '',
    ),
    'art' => 
    array (
      'status' => '1',
      'hits_start' => '1',
      'hits_end' => '1000',
      'updown_start' => '1',
      'updown_end' => '1000',
      'score' => '1',
      'pic' => '0',
      'tag' => '0',
      'psernd' => '0',
      'psesyn' => '0',
      'inrule' => ',b',
      'uprule' => ',a,d',
      'filter' => '',
      'thesaurus' => '',
      'words' => '',
    ),
    'actor' => 
    array (
      'status' => '0',
      'hits_start' => '1',
      'hits_end' => '999',
      'updown_start' => '1',
      'updown_end' => '999',
      'score' => '0',
      'pic' => '0',
      'psernd' => '0',
      'psesyn' => '0',
      'uprule' => ',a,b,c',
      'filter' => '',
      'thesaurus' => '',
      'words' => '',
      'inrule' => ',a',
    ),
    'role' => 
    array (
      'status' => '0',
      'hits_start' => '1',
      'hits_end' => '999',
      'updown_start' => '1',
      'updown_end' => '999',
      'score' => '0',
      'pic' => '0',
      'psernd' => '0',
      'psesyn' => '0',
      'uprule' => ',a,b,c',
      'filter' => '',
      'thesaurus' => '',
      'words' => '',
      'inrule' => ',a',
    ),
    'website' => 
    array (
      'status' => '0',
      'hits_start' => '',
      'hits_end' => '',
      'updown_start' => '',
      'updown_end' => '',
      'score' => '0',
      'pic' => '0',
      'psernd' => '0',
      'psesyn' => '0',
      'filter' => '',
      'thesaurus' => '',
      'words' => '',
      'inrule' => ',a',
      'uprule' => ',',
    ),
    'comment' => 
    array (
      'status' => '0',
      'updown_start' => '1',
      'updown_end' => '100',
      'psernd' => '0',
      'psesyn' => '0',
      'inrule' => ',b',
      'filter' => '',
      'thesaurus' => '',
      'words' => '',
      'uprule' => ',',
    ),
  ),
  'api' => 
  array (
    'vod' => 
    array (
      'status' => 0,
      'charge' => '0',
      'pagesize' => '20',
      'imgurl' => 'http://img.test.com/',
      'typefilter' => '',
      'datafilter' => ' vod_status=1',
      'cachetime' => '',
      'from' => '',
      'auth' => 'test.com#163.com',
    ),
    'art' => 
    array (
      'status' => 0,
      'charge' => '0',
      'pagesize' => '20',
      'imgurl' => '',
      'typefilter' => '',
      'datafilter' => 'art_status=1',
      'cachetime' => '',
      'auth' => '',
    ),
    'actor' => 
    array (
      'status' => '0',
      'charge' => '0',
      'pagesize' => '20',
      'imgurl' => '',
      'typefilter' => '',
      'datafilter' => 'actor_status=1',
      'cachetime' => '',
      'auth' => '',
    ),
    'role' => 
    array (
      'status' => '0',
      'charge' => '0',
      'pagesize' => '20',
      'imgurl' => '',
      'typefilter' => '',
      'datafilter' => 'role_status=1',
      'cachetime' => '',
      'auth' => '',
    ),
    'website' => 
    array (
      'status' => '0',
      'charge' => '0',
      'pagesize' => '20',
      'imgurl' => '',
      'typefilter' => '',
      'datafilter' => 'website_status=1',
      'cachetime' => '',
      'auth' => '',
    ),
  ),
  'connect' => 
  array (
    'qq' => 
    array (
      'status' => '0',
      'key' => 'aa',
      'secret' => 'bb',
    ),
    'weixin' => 
    array (
      'status' => '0',
      'key' => 'cc',
      'secret' => 'dd',
    ),
  ),
  'weixin' => 
  array (
    'status' => '1',
    'duijie' => 'wx.test.com',
    'sousuo' => 'wx.test.com',
    'token' => 'qweqwe',
    'guanzhu' => '欢迎关注',
    'wuziyuan' => '没找到资源，请更换关键词或等待更新',
    'wuziyuanlink' => 'demo.test.com',
    'bofang' => '0',
    'msgtype' => '0',
    'gjc1' => '关键词1',
    'gjcm1' => '长城',
    'gjci1' => 'http://img.aolusb.com/im/201610/2016101222371965996.jpg',
    'gjcl1' => 'http://www.loldytt.com/Dongzuodianying/CC/',
    'gjc2' => '关键词2',
    'gjcm2' => '生化危机6',
    'gjci2' => 'http://img.aolusb.com/im/201702/20172711214866248.jpg',
    'gjcl2' => 'http://www.loldytt.com/Kehuandianying/SHWJ6ZZ/',
    'gjc3' => '关键词3',
    'gjcm3' => '湄公河行动',
    'gjci3' => 'http://img.aolusb.com/im/201608/201681719561972362.jpg',
    'gjcl3' => 'http://www.loldytt.com/Dongzuodianying/GHXD/',
    'gjc4' => '关键词4',
    'gjcm4' => '王牌逗王牌',
    'gjci4' => 'http://img.aolusb.com/im/201601/201612723554344882.jpg',
    'gjcl4' => 'http://www.loldytt.com/Xijudianying/WPDWP/',
  ),
  'view' => 
  array (
    'index' => '0',
    'map' => '0',
    'search' => '0',
    'rss' => '0',
    'label' => '0',
    'vod_type' => '0',
    'vod_show' => '0',
    'art_type' => '0',
    'art_show' => '0',
    'topic_index' => '0',
    'topic_detail' => '0',
    'vod_detail' => '0',
    'vod_play' => '0',
    'vod_down' => '0',
    'art_detail' => '0',
  ),
  'path' => 
  array (
    'topic_index' => 'topic/index',
    'topic_detail' => 'topic/{id}/index',
    'vod_type' => 'vodtypehtml/{id}/index',
    'vod_detail' => 'vodhtml/{id}/index',
    'vod_play' => 'vodplayhtml/{id}/index',
    'vod_down' => 'voddownhtml/{id}/index',
    'art_type' => 'arttypehtml/{id}/index',
    'art_detail' => 'arthtml/{id}/index',
    'page_sp' => '_',
    'suffix' => 'html',
  ),
  'rewrite' => 
  array (
    'suffix_hide' => '1',
    'route_status' => '1',
    'status' => '1',
    'encode_key' => 'abcdefg',
    'encode_len' => '6',
    'vod_id' => '1',
    'art_id' => '0',
    'type_id' => '0',
    'topic_id' => '0',
    'actor_id' => '0',
    'role_id' => '0',
    'website_id' => '0',
    'route' => 'map   => map/index
rss/index   => rss/index
rss/baidu => rss/baidu
rss/google => rss/google
rss/sogou => rss/sogou
rss/so => rss/so
rss/bing => rss/bing
rss/sm => rss/sm

index-<page?>   => index/index

gbook-<page?>   => gbook/index
gbook$   => gbook/index

chu-de-<page?>   => topic/index
chu-de$  => topic/index
chu-de/<id>   => topic/detail

actor-<page?>   => actor/index
actor$ => actor/index
actordetail-<id>   => actor/detail
actorshow/<area?>-<blood?>-<by?>-<letter?>-<level?>-<order?>-<page?>-<sex?>-<starsign?>   => actor/show

role-<page?>   => role/index
role$ => role/index
roledetail-<id>   => role/detail
roleshow/<by?>-<letter?>-<level?>-<order?>-<page?>-<rid?>   => role/show


danh-muc/<id>-<page?>   => vod/type
danh-muc/<id>   => vod/type
chi-tiet-phim/<id>   => vod/detail
vodrss-<id>   => vod/rss
xem-phim/<id>-sv<sid>-tap-<nid>   => vod/play
tai-phim/<id>-<sid>-<nid>   => vod/down
the-loai/<id>/   => vod/show
tim-kiem/  => vod/search
vodplot/<id>-<page?>   => vod/plot
vodplot/<id>   => vod/plot


bai-viet/<id>-<page?>   => art/type
bai-viet/<id>   => art/type
bai-viet/show/<id>   => art/show
chi-tiet-bai-viet/<id>-<page?>   => art/detail
chi-tiet-bai-viet/<id>   => art/detail
artrss-<id>-<page>   => art/rss
bai-viet/loc/<id>-<by?>-<class?>-<level?>-<letter?>-<order?>-<page?>-<tag?>   => art/show
bai-viet/tim-kiem/<wd?>-<by?>-<class?>-<level?>-<letter?>-<order?>-<page?>-<tag?>   => art/search

label-<file> => label/index

plotdetail/<id>-<page?>   => plot/plot
plotdetail/<id>   => plot/detail',
  ),
  'email' => 
  array (
    'type' => 'Phpmailer',
    'time' => '5',
    'nick' => 'test',
    'test' => 'test@qq.com',
    'tpl' => 
    array (
      'test_title' => '【{$maccms.site_name}】测试邮件标题',
      'test_body' => '【{$maccms.site_name}】当您看到这封邮件说明邮件配置正确了！感谢支持开源程序！',
      'user_reg_title' => '【{$maccms.site_name}】的会员您好，请认真阅读邮件正文并按要求操作完成注册',
      'user_reg_body' => '【{$maccms.site_name}】的会员您好，注册验证码为：{$code}，请在{$time}分钟内完成验证。',
      'user_bind_title' => '【{$maccms.site_name}】的会员您好，请认真阅读邮件正文并按要求操作完成绑定',
      'user_bind_body' => '【{$maccms.site_name}】的会员您好，绑定验证码为：{$code}，请在{$time}分钟内完成验证。',
      'user_findpass_title' => '【{$maccms.site_name}】的会员您好，请认真阅读邮件正文并按要求操作完成找回',
      'user_findpass_body' => '【{$maccms.site_name}】的会员您好，找回验证码为：{$code}，请在{$time}分钟内完成验证。',
    ),
    'phpmailer' => 
    array (
      'host' => 'smtp.qq.com',
      'port' => '587',
      'secure' => 'tsl',
      'username' => 'test@qq.com',
      'password' => 'test',
    ),
  ),
  'play' => 
  array (
    'width' => '100%',
    'height' => '100%',
    'widthmob' => '100%',
    'heightmob' => '100%',
    'widthpop' => '0',
    'heightpop' => '600',
    'second' => '0',
    'prestrain' => '/static/player/prestrain.html',
    'buffer' => '/static/player/loading.html',
    'parse' => '',
    'autofull' => '0',
    'showtop' => '1',
    'showlist' => '1',
    'flag' => '0',
    'colors' => '000000,F6F6F6,F6F6F6,333333,666666,FFFFF,FF0000,2c2c2c,ffffff,a3a3a3,2c2c2c,adadad,adadad,48486c,fcfcfc',
  ),
  'sms' => 
  array (
    'type' => '',
    'sign' => '我的网站',
    'tpl_code_reg' => 'SMS_144850895',
    'tpl_code_bind' => 'SMS_144940283',
    'tpl_code_findpass' => 'SMS_144851023',
    'aliyun' => 
    array (
      'appid' => '',
      'appkey' => '',
    ),
    'qcloud' => 
    array (
      'appid' => '',
      'appkey' => '',
    ),
  ),
  'extra' => 
  array (
  ),
  'seo' => 
  array (
    'vod' => 
    array (
      'name' => 'Nội dung thẻ title ở đây',
      'key' => 'Nội dung thẻ keywords ở đây',
      'des' => 'Nội dung thẻ descriptions ở đây',
    ),
    'art' => 
    array (
      'name' => 'Nội dung thẻ title ở đây',
      'key' => 'Nội dung thẻ keywords ở đây',
      'des' => 'Nội dung thẻ descriptions ở đây',
    ),
    'actor' => 
    array (
      'name' => 'Nội dung thẻ title ở đâ',
      'key' => 'Nội dung thẻ keywords ở đây',
      'des' => 'Nội dung thẻ descriptions ở đây',
    ),
    'role' => 
    array (
      'name' => 'Nội dung thẻ title ở đâ',
      'key' => 'Nội dung thẻ keywords ở đây',
      'des' => 'Nội dung thẻ descriptions ở đây',
    ),
    'plot' => 
    array (
      'name' => 'Nội dung thẻ title ở đâ',
      'key' => 'Nội dung thẻ keywords ở đây',
      'des' => 'Nội dung thẻ descriptions ở đây',
    ),
  ),
  'urlsend' => 
  array (
    'baidu' => 
    array (
      'token' => '111',
    ),
    'baidufast' => 
    array (
      'token' => '222',
    ),
  ),
);