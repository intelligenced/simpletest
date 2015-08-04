<?php
require 'vendor/autoload.php';

use Carbon\Carbon;

$now = Carbon::now()->addHours('5');
    	$hour= $now->hour;

    	$int_hour=(int)$hour;
    	//$int_hour='8';


    	if( $int_hour < '7' or $int_hour > '18'){

    		    	$dir = 'sqlite:database.sqlite';
 $dbh = new PDO($dir) or die("cannot open database");
 $query = "SELECT * FROM users INNER JOIN types ON users.type_id=types.type_id  WHERE (users.duty='1')


 ";
$myArray = array();
 
foreach ($dbh->query($query) as $row) {

		$myArray[] = array(
    	"name" => $row['name'],
     	"number" => $row['number'],
     	"type_name"=>$row['type_name'],
     	"created"=>$row['created_at'],
     	"duty"=>$row['duty']

		);   
}

echo json_encode($myArray);




    }else{

    	$dir = 'sqlite:database.sqlite';
 $dbh = new PDO($dir) or die("cannot open database");
 $query = "SELECT * FROM users INNER JOIN types ON users.type_id=types.type_id  WHERE (users.duty='0')


 ";
$myArray = array();
 
foreach ($dbh->query($query) as $row) {

		$myArray[] = array(
    	"name" => $row['name'],
     	"number" => $row['number'],
     	"type_name"=>$row['type_name'],
     	"created"=>$row['created_at'],
     	"duty"=>$row['duty']

		);   
}

echo json_encode($myArray);




 }




?>