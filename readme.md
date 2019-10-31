# Baab非洲留学生交流网站项目
大一暑假接的一个完整的外包项目，由甲方运营了一年左右时间后由于某些原因项目组解散，于是开源于此供学习使用。

### 这是一个完整的中英双语社区系统，支持跨端自适应，提供后台管理系统。
社区涉及到留学生生活的方方面面，包括新闻门户、论坛话题、个人中心、关注及动态、合一聚合搜索、私信/群和通知系统等。

+ [Demo地址 http://bbsdemo.sharelove.site](http://bbsdemo.sharelove.site)
+ [Demo后台管理地址(请先用管理员账号登陆)](http://bbsdemo.sharelove.site/admin)
+ 管理员账号 admin@baab.com 密码 baabadmin
## 基本食用指南
* 运行环境推荐 PHP 7.2 + Composer
```
# PHP 需配置以下扩展
    BCMath PHP Extension
    Ctype PHP Extension
    JSON PHP Extension
    Mbstring PHP Extension
    OpenSSL PHP Extension
    PDO PHP Extension
    Tokenizer PHP Extension
    XML PHP Extension
```
* 安装依赖 composer install
* 修改根目录下 `.env` 配置文件
``` bash
#网站英文名
APP_EN_NAME=BaabClub
#网站中文名
APP_ZH_NAME=Baab社区

#local 本地调试环境 production 生产环境
APP_ENV=local
#使用 php artisan key:generate 生成key
APP_KEY=
#debug模式
APP_DEBUG=true

#数据库地址、端口、数据库名、账号、密码等
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=Baab
DB_USERNAME=root
DB_PASSWORD=password

#邮件服务地址、端口、用户名、账号、密码等
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=BaabClub
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=example@baab.com
MAIL_FROM_NAME=BaabClub #同 MAIL_USERNAME
```
* 使用 `php artisan key:generate` 命令生成 key
* 运行命令 `php artisan migrate` 写入数据库初始化
* 运行队列进程（[如有需要可配置Supervisor确保队列运行](https://laravel.com/docs/6.x/queues#supervisor-configuration)）`php artisan queue:work --sleep=3 --tries=3`
* 本地调试启动serve服务 `php artisan serve`
* 如需配置Nginx，请将网站根目录指向到`/public`目录下，配合`php-fpm`食用。 

## 数据库简单架构
### 用户
* `users` 用户表
* `users_info` 用户信息表
* `activity_log` 用户动态表
* `followables` 用户关注表
### 社区
* `community_sections` 社区大板块表
* `community_zones` 社区小分区表
* `community_topics` 社区话题表
* `community_topics_replies` 社区话题回复表
* `votes` 话题及回复投票表
### 新闻
* `news` 新闻表
* `news_categories` 新闻分类表
* `news_replies` 新闻回复表
### 首页
* `index_carousels` 首页轮播Banner表
* `index_headlines` 首页头条表
### 即时通讯及通知
* `messages` 消息表
* `threads` 讨论组群聊表
* `participants` 讨论组参与人员表
* `notifications` 综合通知表
### 权限与访问控制
* `roles` 角色表
* `permissions` 权限表
* `model_has_roles` Model与角色对应表
* `model_has_permissions` Model与单个权限对应表
* `role_has_permissions` 角色与权限对应表
### 其他
* `jobs` 待处理队列任务表
* `failed_jobs` 失败的队列任务表
* `migrations` 数据库迁移表
