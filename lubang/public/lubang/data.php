<?php
//设置页面内容是html编码格式是utf-8
//header("Content-Type: text/plain;charset=utf-8"); 
header("Content-Type: application/json;charset=utf-8"); 
//header("Content-Type: text/xml;charset=utf-8"); 
//header("Content-Type: text/html;charset=utf-8"); 
//header("Content-Type: application/javascript;charset=utf-8"); 

//定义一个多维数组，包含员工的信息，每条员工信息为一个数组
$staff = array
	(
		
		array("tel"=>"18716071280","pwd" =>"123456"),
		array("tel"=>"18716071281","pwd" =>"123456")
	);

//判断如果是get请求，则进行搜索；如果是POST请求，则进行新建
//$_SERVER是一个超全局变量，在一个脚本的全部作用域中都可用，不用使用global关键字
//$_SERVER["REQUEST_METHOD"]返回访问页面使用的请求方法
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	search();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST"){
	create();
}

//通过员工编号搜索员工
function search(){
	$jsonp = $_GET["callback"];
	//检查是否有员工编号的参数
	//isset检测变量是否设置；empty判断值为否为空
	//超全局变量 $_GET 和 $_POST 用于收集表单数据
	if (!isset($_GET["tel"]) || empty($_GET["tel"]) || !isset($_GET["pwd"]) || empty($_GET["pwd"])) {
		echo $jsonp . '({"success":false,"msg":"账号或密码不能为空"})';
		return;
	}
	//函数之外声明的变量拥有 Global 作用域，只能在函数以外进行访问。
	//global 关键词用于访问函数内的全局变量
	global $staff;
	//获取number参数
	$tel = $_GET["tel"];
	$pwd = $_GET['pwd'];
	$result = $jsonp .'({"success":false,"msg":"账号或密码错误"})';
	
	//遍历$staff多维数组，查找key值为number的员工是否存在，如果存在，则修改返回结果
	foreach ($staff as $value) {
		if ($value["tel"] == $tel && $value["pwd"] == $pwd) {
			$result =$jsonp . '({"success":true,"msg":"找到员工：员工电话：' . $value["tel"] . 
							'，员工密码：' . $value["pwd"] . '"})';
			break;
		}
	}
    echo $result;

}


?>