<?php
	

	$dsn="mysql:host=localhost;dbname=almusbah;charset=utf8";
	$user="root";
	$pass="";
	$option=array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
	
	try{
	$con=new PDO($dsn,$user,$pass,$option);
	//echo "Connected to Database";
	
	}
	catch(PDOException $e){
		exit($e->getMessage());
	}



?>