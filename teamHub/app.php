<?php 
if(!isset($_SESSION)) { 
	session_start(); 
}

require_once "database/connect.php";

require_once "inc/page_parts.php";

require_once "home_url.php";

//include "dummy_users.php";

//$_SESSION['user_info'] = $bruce;

if (!isset($_SESSION['user_info'])) {
	header("Location: login.php");
}

$_USER = $_SESSION['user_info'];