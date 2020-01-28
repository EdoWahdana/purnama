<?php 
session_start();

$dbHost = "localhost";
$dbName = "live_chat";
$dbUser = "root";
$dbPass = "";

$db = new PDO("mysql:host=$dbHost; dbname=$dbName; charset=utf8", $dbUser, $dbPass);

define('BASE_URL', "http://localhost/purnama/livechat/");

function base_url($url = null){
    if($url != null){
        return BASE_URL. "$url";
    } else {
        return BASE_URL;
    }
}

function pesan($tag, $isi, $loc=null){
	$_SESSION[$tag] = $isi;
	if(!empty($loc)){
		header("location:$loc");
		exit;
	}
}

function msgHandling($arr = array("danger", "success", "warning")){
	foreach($arr as $r){
		if(isset($_SESSION[$r])){
			echo "<div class='alert alert-$r'>$_SESSION[$r] <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button> </div>";
			unset($_SESSION[$r]);
		}
	}
}




?>