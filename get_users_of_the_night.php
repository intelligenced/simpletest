<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
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








?>