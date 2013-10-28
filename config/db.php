<?php
$dbhost='localhost';
$dbuser='root';
$dbpass='';
$db=new mysqli($dbhost,$dbuser,$dbpass);
if($db->connect_errno){
	die('Could not connect database');
}
?>