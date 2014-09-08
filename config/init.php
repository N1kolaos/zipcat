<?php
ob_start();
error_reporting(E_ALL);
ini_set('session.cookie_httponly',true);
session_start();
if(!isset($_SESSION['urls_created']))$_SESSION['urls_created']=0;
require './includes/functions/general.php';
?>
