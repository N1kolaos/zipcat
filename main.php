<?php
require './config/init.php';
require './includes/header.php';
require './config/connect.php';

if(isset($_GET['code'])){
	$code=mysql_real_escape_string($_GET['code']);
	if($code!==$_GET['code'] || strlen($code)>32)
		require './includes/notfound.php';
	else{
		$result=mysql_query("SELECT url FROM urls WHERE code='$code'");
		if(mysql_num_rows($result)===0)
			require './includes/notfound.php';
		else if(check_barriers($code)){
			$_SESSION['code']=$code;
			header('Location: ./gateway.php');
			exit;
		}
	}
}else{
	$_SESSION['wearedonehere']=false;
	require './includes/default.php';
}
require './includes/footer.php';
require './includes/scripts/main_script.php';
?>
