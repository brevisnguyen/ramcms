
# RamCMS

RamCMS là một hệ thống quản trị nội dung(Content Management System) sử dụng PHP mà MySQL. Kích thước chương trình nhỏ -> mã tối ưu hóa, chạy nhanh -> xử lý bộ nhớ đệm hiệu quả là điểm cộng của RamCMS.
RamCMS đang sủ dụng ThinkPHP 5.x làm lõi phát triển, đơn giản hoá việc tạo template.
Các template miễn phí/trả phí đa dạng, không cần mất nhiều thời gian làm quen.

RamCMS là một phiên bản Việt hoá của [maccms10](https://github.com/magicblack/maccms10) có tối ưu để phù hợp với Phương thức SEO Việt Nam.

## Features

- Hỗ trợ đa ngôn ngữ
- Có sẵn template đẹp
- Hộ trợ API
- Tối ưu SEO


## Acknowledgements

 - [ThinhPHP](https://github.com/top-think/framework)
 - [苹果cmsv10](https://github.com/magicblack/maccms10)


## Installation

Cài đặt RamCMS thông qua Github

```bash
  git clone https://github.com/brevis-ng/vn-cms.git
```
Xoá file ```application\data\install\install.lock ```  và tiến hành cài đặt

PHP version
```Yêu cầu PHP >= 7.4```

Cấu hình Nginx/Apache
```nginx
  <IfModule mod_rewrite.c>
  Options +FollowSymlinks -Multiviews
  RewriteEngine on

  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteRule ^(.*)$ index.php?/$1 [QSA,PT,L]
  </IfModule>
```

```apache
location / {
 if (!-e $request_filename) {
        rewrite ^/index.php(.*)$ /index.php?s=$1 last;
        rewrite ^/admin.php(.*)$ /admin.php?s=$1 last;
        rewrite ^/api.php(.*)$ /api.php?s=$1 last;
        rewrite ^(.*)$ /index.php?s=$1 last;
        break;
   }
}
```

    
