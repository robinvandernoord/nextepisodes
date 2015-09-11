<?php

function send_email($from, $to, $subject, $message){

	// Helper function for sending email
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/plain; charset=utf-8' . "\r\n";
	$headers .= 'From: '.$from . "\r\n";

	return mail($to, $subject, $message, $headers);
}

function get_page_url(){

	// Find out the URL of a PHP file

	$url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'];

	if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != ''){
		$url.= $_SERVER['REQUEST_URI'];
	}
	else{
		$url.= $_SERVER['PATH_INFO'];
	}

	return $url;
}

function rate_limit($ip, $limit_hour = 20, $limit_10_min = 10){
	
	// The number of login attempts for the last hour by this IP address

	$count_hour = ORM::for_table('reg_login_attempt')
					->where('ip', sprintf("%u", ip2long($ip)))
					->where_raw("ts > SUBTIME(NOW(),'1:00')")
					->count();

	// The number of login attempts for the last 10 minutes by this IP address

	$count_10_min =  ORM::for_table('reg_login_attempt')
					->where('ip', sprintf("%u", ip2long($ip)))
					->where_raw("ts > SUBTIME(NOW(),'0:10')")
					->count();

	if($count_hour > $limit_hour || $count_10_min > $limit_10_min){
		throw new Exception('Too many login attempts!');
	}
}

function rate_limit_tick($ip, $email){

	// Create a new record in the login attempt table

	$login_attempt = ORM::for_table('reg_login_attempt')->create();

	$login_attempt->email = $email;
	$login_attempt->ip = sprintf("%u", ip2long($ip));

	$login_attempt->save();
}

function redirect($url){
	header("Location: $url");
	exit;
}