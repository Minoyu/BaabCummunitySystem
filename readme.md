# 非洲留学生交流网站项目
### 部署备忘
* 登录mysql 创建数据库
* 修改.env中的三个值
```
DB_DATABASE= 数据库名
DB_USERNAME= 数据库用户(一般为root)
DB_PASSWORD= 数据库密码
```
* 运行命令 php artisan migrate 写入数据库初始化