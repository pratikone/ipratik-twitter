<?php

/* Made by
 * Pratik Anand  <pratik.preet@gmail.com> , pratik3d.blogspot.com, http://twitter.com/pratikone
 * May-Jun 2010
*/ 
$username=$_POST['n1'];
$password=$_POST['p1'];
$status=$_POST['up_text'];

//echo "<br> <h1>$username <br> $password <br>$status";

 $url = 'http://twitter.com/statuses/update.xml?status='.urlencode(stripcslashes(urldecode($status))); 
	// Arguments we are posting to Twitter 
	//$postargs = $url.'?status='.urlencode(stripcslashes(urldecode($status))); 
	// Will store the response we get from Twitter 
	$responseInfo=array(); 
	// Initialize CURL 
	$ch = curl_init();
	
		// Tell CURL we are doing a POST 
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_POST, true); 
	// Give CURL the arguments in the POST 
	//curl_setopt ($ch, CURLOPT_POSTFIELDS, $postargs);
	
		// Set the username and password in the CURL call 
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password"); 
	// Set some cur flags (not too important) 
	curl_setopt($ch, CURLOPT_VERBOSE, 1); 
	curl_setopt($ch, CURLOPT_NOBODY, 0); 
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	// execute the CURL call 
	$response = curl_exec($ch); 
	// Get information about the response 
	$responseInfo=curl_getinfo($ch); 
	// Close the CURL connection 
	curl_close($ch);
	
	if($responseInfo['http_code']=="200")
	   echo "<br><h1>Posted successfully.</h1>";
	else
	   echo "Yikes!! sorry dude! something's Wrong!!";


?>
