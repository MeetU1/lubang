<?php
 
$host="120.27.7.72";//mysql主机地址
$user="root"; //mysql 登录账户
$pwd="123456"; //mysql登录密码
//连接数据库
$conn = mysql_connect($host,$user,$pwd);
//判断
if (!$conn) {
  die('连接数据库失败: ' . mysql_error());
  }
echo "mysql 连接成功！";
 
//其他代码......
 
// 关闭mysql连接
mysql_close($conn);
?>