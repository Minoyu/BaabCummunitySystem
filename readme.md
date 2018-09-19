## 非洲留学生交流网站项目

先登录mysql 创建数据库<br>

mysql -u[用户名] -p<br>
//用户名一般为root 回车后输入密码，输入完成后回车



//展示当前数据库<br>
show databases；<br>
//新建数据库<br>
create database [数据库名];<br>
//展示当前数据库<br>
show databases；<br>
//新建数据库<br>
create database [数据库名];<br>


之后对应修改.env中的三个值

DB_DATABASE= 数据库名<br>
DB_USERNAME= 数据库用户(一般为root)<br>
DB_PASSWORD= 数据库密码<br>

运行命令 php artisan migrate