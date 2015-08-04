<?php
/*
	$myArray = array();


  $myPDO = new PDO('sqlite:database.sqlite');
   $query = $myPDO->query("SELECT * FROM users");

foreach ($myPDO->query($query) as $row) {
echo json_encode($row[0]);
}
//header('Content-Type: application/json');

//var_dump($result);

 INNER JOIN logs ON users.number=logs.user_details INNER JOIN types ON users.id=types.type_id


*/
 require 'vendor/autoload.php';

use Carbon\Carbon;

 function carbondance($time){

$carbontime= Carbon::createFromFormat('Y-m-d H:i:s',$time,'Indian/Maldives'); 
$test = $carbontime->diffForHumans();

   return $test;



 }

 function time2str($ts) {
    if(!ctype_digit($ts)) {
        $ts = strtotime($ts);
    }
    $diff = time() - $ts;
    if($diff == 0) {
        return 'now';
    } elseif($diff > 0) {
        $day_diff = floor($diff / 86400);
        if($day_diff == 0) {
            if($diff < 60) return 'just now';
            if($diff < 120) return '1 minute ago';
            if($diff < 3600) return floor($diff / 60) . ' minutes ago';
            if($diff < 7200) return '1 hour ago';
            if($diff < 86400) return floor($diff / 3600) . ' hours ago';
        }
        if($day_diff == 1) { return 'Yesterday'; }
        if($day_diff < 7) { return $day_diff . ' days ago'; }
        if($day_diff < 31) { return ceil($day_diff / 7) . ' weeks ago'; }
        if($day_diff < 60) { return 'last month'; }
        return date('F Y', $ts);
    } else {
        $diff = abs($diff);
        $day_diff = floor($diff / 86400);
        if($day_diff == 0) {
            if($diff < 120) { return 'in a minute'; }
            if($diff < 3600) { return 'in ' . floor($diff / 60) . ' minutes'; }
            if($diff < 7200) { return 'in an hour'; }
            if($diff < 86400) { return 'in ' . floor($diff / 3600) . ' hours'; }
        }
        if($day_diff == 1) { return 'Tomorrow'; }
        if($day_diff < 4) { return date('l', $ts); }
        if($day_diff < 7 + (7 - date('w'))) { return 'next week'; }
        if(ceil($day_diff / 7) < 4) { return 'in ' . ceil($day_diff / 7) . ' weeks'; }
        if(date('n', $ts) == date('n') + 1) { return 'next month'; }
        return date('F Y', $ts);
    }
}
 
$dir = 'sqlite:database.sqlite';
 $dbh = new PDO($dir) or die("cannot open database");
 $query = "SELECT users.name,users.number,types.type_name,logs.message,logs.created_at FROM users  INNER JOIN logs ON users.number=logs.user_details  INNER JOIN types ON users.type_id=types.type_id ORDER BY logs.created_at DESC LIMIT 5


 ";


	$myArray = array();
 
foreach ($dbh->query($query) as $row) {

		$myArray[] = array(
    	"name" => $row['name'],
     	"number" => $row['number'],
     	"type_name"=>$row['type_name'],
     	"message"=>$row['message'],
     	"created"=>carbondance($row['created_at'])

		);   
}

echo json_encode($myArray);

?>