#Laravel 5 Admin Backend

**Laravel 5 Admin Backend** for Laravel 5.1 based in  [BackendL5](https://github.com/raulduran/backendl5)

[TOC]

##Windows

###环境配置
- Composer
```
php -r "readfile('https://getcomposer.org/installer');" | php
composer config -g repositories.packagist composer http://packagist.phpcomposer.com
```
###测试地址
http://qa.hdgua.com

###后台地址
http://qa.hdgua.com
用户名：admin@admin.com
密码：adminadmin

###初始化
创建数据库：php artisan migrate
填充测试数据：php artisan db:seed
