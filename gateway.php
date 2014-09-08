<?php
require './config/init.php';
require './includes/header.php';
require './config/connect.php';

if(!isset($_SESSION['code']) && !isset($_POST['password'])){
	header('Location: .?');exit;}
if(isset($_SESSION['code'])){
	$code_=$_SESSION['code'];
	$_SESSION['code']=NULL;
	$result=mysql_query("SELECT url,clicks,riddle FROM urls WHERE code='$code_'");
	$url=mysql_result($result,0,0);$clicks=mysql_result($result,0,1);$riddle=mysql_result($result,0,2);
	require './includes/password.php';
}
else{
	$code_=$_POST['code'];if(!valid_code($code_)){header('Location: .');exit;}
	$password=md5(sha1($code_).$_POST['password']);
	$result=mysql_query("SELECT url FROM urls WHERE code='$code_' AND password='$password' AND(expiration IS NULL OR expiration >=CURRENT_DATE)");
	if(mysql_num_rows($result)===1){
		$url=mysql_result($result,0,0);
		mysql_query('UPDATE clicks SET count=(count+1)');
		mysql_query("UPDATE urls SET clicks=(clicks+1) WHERE code='$code_'");
		header('HTTP:/1.1 301 Moved Permanently');
		header("Location: $url");exit;
	}else{
		$_SESSION['code']=$code_;
		header('Location: ./gateway.php');exit;
	}
}
require './includes/footer.php';
?>
