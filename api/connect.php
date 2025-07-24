<?php
	date_default_timezone_set('Asia/Kolkata');
	$db = new mysqli('localhost','jt_laravel','88?55ilhneeJXsPvt','jt_laravel');
	if($db->connect_errno){
		die('Sorry, We are having some errors');
	}
?>