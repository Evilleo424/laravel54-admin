# laravel5.4 后台管理

---
使用步骤：
> 1 搭建homestead环境（参考laravel官网），安装好composer,bower

> 2 添加一个虚拟主机：serve laravel-admin.app ~/www/laravel-admin/public，添加域名到hosts文件

> 3 安装PHP依赖库：composer install

> 5 修改.env数据库配置信息

> 6 执行： php artisan migrate

> 7 执行： php artisan db:seed --class=PermissionSeeder

----

# 注意
添加操作管理的数据的时候，命名空间、类名、方法名请根据实际情况添加，不要添加不存在的命名空间、类，否则程序会报错.
当添加不存在的命名空间、类名、方法名的时候，程序在生成URL的时候会提示找不到相应的类

----

# 开始
浏览器打开http://laravel-admin.app/  进入登录界面：

用户角色：用户名/密码

管理员账号：admin/123456


----

github

laravel    https://github.com/laravel/laravel

adminlte   https://github.com/almasaeed2010/AdminLTE

-----
相关资源


http://laravel.com/

http://laravel-china.org/

http://d.laravel-china.org/docs/5.4/
