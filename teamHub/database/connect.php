<?php 

require_once 'db.php';
require_once "quesries.php";

$DB_HOST 	 = 'localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_NAME     = 'teamhub';

//global $DB, $QUERY;

$DB = new DB($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
//var_dump($DB->QUERY());
$QUERY = new Query($DB);