<?php
require './config/init.php';
require './includes/header.php';
require './config/connect.php';

if(!empty($_POST['new_url'])){
	validate_input();
	$url=$_POST['new_url'];

	if(!isset($_POST['custom']) || empty($_POST['custom_code'])){
		$code_=register_url($url);
		echo '<h2>Here\'s your shortened URL:<input type="text" onclick="this.select()" value="http://zipc.at/',$code_,'" size="32"></h2>';
	}else{
		$code_=$_POST['custom_code'];
		if(valid_code($code_)){
			if(code_exists($code_)){
				header('Location: .?exists');exit;}
		}else{
			header('Location: .?invalid_code');exit;}
		register_url($url,$code_);
		echo '<h2>Here\'s your shortened URL:<input type="text" onclick="this.select()" value="http://zipc.at/',$code_,'" size="32"></h2>';
	}

	if(isset($_POST['expiration']))
		update_expiration($code_);
	if(isset($_POST['riddle']))
		update_riddle($code_);
	$_SESSION['wearedonehere']=true;
}
else{
	header('Location: .?');exit;}
require './includes/showQR.php';
require './includes/footer.php';
?>
