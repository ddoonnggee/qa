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
- [Node.js](https://nodejs.org/en/)
> 查看版本：`node -v`

- Bower
```
npm install -g bower
```
>  查看版本：`bower -v`

- Gulp
```
npm install -g gulp
```
- [Git](https://git-scm.com/download/win)
- [SourceTree](https://www.sourcetreeapp.com/download/)


##Homestead

###环境配置
- 下载Box： https://vagrantcloud.com/laravel/boxes/homestead/versions/0.3.0/providers/virtualbox.box
- 进入Homestead.box同级目录，运行：
`vagrant box add --name laravel/homestead Homestead.box`
`composer global require "laravel/homestead=~2.0"`

> 查看已安装Box
`vagrant box list`
修改完Homestead.yaml后，务必运行下面命令以使配置生效：
`homestead provision`

- 启动Homestead  `homestead up` 关机 `homestead halt` 终端进入`homestead ssh` 编辑配置 `homestead edit`


- 编辑Host文件
> 192.168.10.10     homestead.app
192.168.10.10   project.app
192.168.10.10   phpmyadmin.app


###Git项目初始化 (Windows)
```
git clone https://github.com/zxishere/laravel-5-admin.git projectname
cd projectname
rd /s /q  .git
copy .env.example .env
composer install
composer update

php artisan key:generate
php artisan migrate
php artisan db:seed
```

###Git项目初始化（Homestead）
删除git文件夹 `rm -rf .git`
复制配置文件 `cp .env.example .env`


###前端依赖
```
bower install
npm cache clean
rm -rf node_modules
sudo npm install --global gulp
npm install --no-bin-links
gulp
```
> npm install -g nrm
使用nrm test指令测试那个npm源对你的延迟最小
nrm use taobao便可切换到taobao源

##常用命令

###Composer
```
composer update
composer install
composer dump-autoload
composer self-update

composer diagnose
```
查看Laravel当前版本：`php artisan --version`
查看所有依赖包版本：`composer show -i`


###测试环境
```
php artisan bl5:all articles
php artisan tinker
factory(App\Article::class, 1000)->create();

php artisan make:controller Admin/DatatablesController --plain
```
测试服务器：`php artisan serve --port=8080`
http://localhost:8080/

###正式环境(自动压缩)：
`gulp --production`


###Bower
```
bower list
bower install jquery --save
bower install bootstrap --save
bower install font-awesome  --save
bower install ionicons  --save
bower install datatables  --save
bower uninstall bootbox.js --save
bower install admin-lte#latest --save
```

###Git
```
git config --global user.name "Hiro-PC"
git config --global user.email zxishere@gmail.com
git remote -v
git remote add xxx https:xxx.git
git pull
git push
```

###Linux常用命令

删除文件夹 `rm -rf fromjp`
修改权限 `sudo chmod -R 755 /home/vagrant/*`
清除npm缓存 `npm cache clean`