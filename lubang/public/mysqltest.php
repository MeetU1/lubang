<?php
 
$host="120.27.7.72";//mysql������ַ
$user="root"; //mysql ��¼�˻�
$pwd="123456"; //mysql��¼����
//�������ݿ�
$conn = mysql_connect($host,$user,$pwd);
//�ж�
if (!$conn) {
  die('�������ݿ�ʧ��: ' . mysql_error());
  }
echo "mysql ���ӳɹ���";
 
//��������......
 
// �ر�mysql����
mysql_close($conn);
?>