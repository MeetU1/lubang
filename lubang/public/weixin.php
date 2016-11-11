<?php
    $obj=new Weixin();

    if(!isset($_GET['echostr'])){
        $obj->receive();
    }else{
        $obj->checkSignature();
    }





class Weixin{
    public function checkSignature(){
        $timestamp = $_GET['timestamp'];//时间戳
        $nonce =     $_GET['nonce'];//一组随机的数字
        $token = 'hello';
        
        $signature = $_GET['signature'];//加密的签名
        $array = array( $timestamp, $nonce, $token);
        sort($array,SORT_STRING);
        $tempstr = implode($array);
        $tempstr = sha1($tempstr);
        if ($tempstr==$signature) {
        	echo $_GET['echostr'];//一组随机的字符串
        }else{
            return false;
        }
    }
    public function receive(){
        $obj=$GLOBALS['HTTP_RAW_POST_DATA'];
        $postSql=simplexml_load_string($obj,'SimpleXMLElement',LIBXML_NOCDATA);
        $this->logger("接受:".$obj);

    }
    private function logger($content){
        $logSize=100000;
        $log ="log.txt";
        if(file_exists($log)&&filesize($log) > $logSize){
            unlink($log);
        }
        file_put_contents($log,date('H:i:s')." ".$content.'\n',FILE_APPEND);
    }
}