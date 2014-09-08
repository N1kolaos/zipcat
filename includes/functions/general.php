<?php
function validate_input(){
	if(isset($_SESSION['wearedonehere']) && $_SESSION['wearedonehere']===true){$_SESSION['wearedonehere']=false;header('Location: .');exit;}
	if(!valid_url($_POST['new_url'])){header('Location: .?invalid_url');exit;}
	if(empty($_POST['password']) || strlen($_POST['password'])>256){header('Location: .?passwd');exit;}
	if(isset($_POST['expiration'])){
		if(empty($_POST['expiration_value']) && $_POST['expiration_value']!=='0')
			$days=30;
		else
			$days=(int)$_POST['expiration_value'];
		if($days<0){header('Location: .?negative');exit;}
		if($days!==30)
			if((string)$days!==$_POST['expiration_value']){header('Location: .');exit;}
	}
	if(isset($_POST['riddle']))
		if(empty($_POST['riddle_text']) || strlen($_POST['riddle_text'])>200)
			{header('Location: .');exit;}
}

function valid_url($url){
	return strlen($url)<=2000 && $url===mysql_real_escape_string($url) && filter_var($url,FILTER_VALIDATE_URL);
}

function valid_code($code){
	return $code===mysql_real_escape_string($code) && strlen($code)<=32 && preg_match('/^[a-zA-Z0-9]+$/',$code);
}

function to_base_62($num){
	$pool='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$rest=$pool[$num%62];
	$q=floor($num/62);
	while($q){$r=$q%62;$q=floor($q/62);$rest=$pool[$r].$rest;}
	return $rest;
}

function get_code(){
	$next_code=mysql_result(mysql_query("SELECT code FROM small_code"),0,0);
	mysql_query("UPDATE small_code SET code=(code+1) WHERE code=$next_code");
	return to_base_62($next_code);
}

function register_url($url,$code=NULL){
	if($code===NULL){
		$code=get_code();
		while(code_exists($code))
			$code=get_code();
	}if(!valid_code($code)){header('Location: .?invalid_code');exit;}
	$password=md5(sha1($code).$_POST['password']);
	mysql_query("INSERT INTO urls(code,url,password,clicks) VALUES('$code','$url','$password',0)");
	return $code;
}

function code_exists($code){
	if(mysql_num_rows(mysql_query("SELECT code FROM urls WHERE code='$code'"))===0)
		return false;
	return true;
}

function update_expiration($code){
	if(empty($_POST['expiration_value']) && $_POST['expiration_value']!=='0')
		$days=30;
	else
		$days=(int)$_POST['expiration_value'];
	if($days>3600000){$days=3600000;echo '<p class="caution">The date has to be less than<br>ten thousand years into the future.<br>The date has been set to ~10000 years.</p>';};
	mysql_query("UPDATE urls SET expiration=DATE_ADD(CURRENT_DATE,INTERVAL $days DAY) WHERE code='$code'");
	echo '<p>This link will expire in ',$days,' days</p>';
}

function update_riddle($code){
	$riddle=mysql_real_escape_string(htmlentities($_POST['riddle_text'],ENT_COMPAT,'UTF-8'));
	if(strlen($riddle)>256){header('Location: .?long_riddle');exit;}
	mysql_query("UPDATE urls SET riddle='$riddle' WHERE code='$code'");
}

function check_barriers($code){
	if(mysql_num_rows(mysql_query("SELECT url FROM urls WHERE code='$code' AND(expiration IS NOT NULL AND expiration<CURRENT_DATE)"))===1){
		require './includes/expired.php';
		return false;
	}
	else
		return true;
}
