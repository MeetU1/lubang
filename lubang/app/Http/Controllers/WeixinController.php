<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class WeixinController extends Controller {

	public function weixin()
	{

		$nonce     = $_GET['nonce'];
		$token     = 'hello';
		$timestamp = $_GET['timestamp'];
		// $echostr   = $_GET['echostr'];
		$signature = $_GET['signature'];
		//形成数组，然后按字典序排序
		$array = array();
		$array = array($nonce, $timestamp, $token);
		sort($array);
		//拼接成字符串,sha1加密 ，然后与signature进行校验
		$str = sha1( implode( $array ) );
		if($str  == $signature){
			if(isset($_GET['echostr'])){
			//第一次接入weixin api接口的时候
				echo  $_GET['echostr'];
				exit;
		    }else{
				$this->reponseMsg();
		     }

		}
		//
	}


	public function reponseMsg(){
		//1.获取到微信推送过来post数据（xml格式）
		$postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
		//2.处理消息类型，并设置回复类型和内容
		$postObj = simplexml_load_string( $postArr );
		//判断该数据包是否是订阅的事件推送
		if( strtolower( $postObj->MsgType) == 'event'){
			//如果是关注 subscribe 事件
			if( strtolower($postObj->Event == 'subscribe') ){
				//回复用户消息(纯文本格式)
				$toUser   = $postObj->FromUserName;
				$fromUser = $postObj->ToUserName;
				$time     = time();
				$msgType  =  'text';
				$content  = '欢迎关注我们的微信公众账号';
				$template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
				$info     = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
				echo $info;
			}
		}
		if(strtolower($postObj->MsgType) == 'text'){
			switch( trim($postObj->Content) ){
				case 1:
					$content = '您输入的数字是1';
				break;
				case 2:
					$content = '您输入的数字是2';
				break;
				case 3:
					$content = '您输入的数字是3';
				break;
				case 4:
					$content = "<a href='http://127.27.7.72'>路帮</a>";
				break;
				case '英文':
					$content = 'imooc is ok';
				break;

			}	
				$template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
							//注意模板中的中括号 不能少 也不能多
				$fromUser = $postObj->ToUserName;
				$toUser   = $postObj->FromUserName; 
				$time     = time();
				// $content  = '18723180099';
				$msgType  = 'text';
				echo sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
			
		}

    }
}
