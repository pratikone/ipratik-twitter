<?php
/*
Using Abraham's twitter OAuth api 
Abraham Williams (abraham@abrah.am) http://abrah.am

Coded by :
Pratik Anand <pratik.preet@gmail.com>  ,  <pratik3d.blogspot.com>
 May-June 2010

*/

// require twitterOAuth lib
require_once('twitteroauth/twitterOAuth.php');

/* Sessions are used to keep track of tokens while user authenticates with twitter */
session_start();
/* Consumer key from twitter */
$consumer_key = 'MKBDrDVkP4bLsvhjbHC0FA';
/* Consumer Secret from twitter */
$consumer_secret = 'OMJemmrf5zgpqfUZx2UrurymBfPBRdILHDUlvP3kwY';
/* Set up placeholder */
$content = NULL;
/* Set state if previous session */
$state = $_SESSION['oauth_state'];
/* Checks if oauth_token is set from returning from twitter */
$session_token = $_SESSION['oauth_request_token'];
/* Checks if oauth_token is set from returning from twitter */
$oauth_token = $_REQUEST['oauth_token'];
/* Set section var */
$section = $_REQUEST['section'];

/* Clear PHP sessions */
if ($_REQUEST['test'] === 'clear') {/*{{{*/
  session_destroy();
  session_start();
}/*}}}*/

/* If oauth_token is missing get it */
if ($_REQUEST['oauth_token'] != NULL && $_SESSION['oauth_state'] === 'start') {/*{{{*/
  $_SESSION['oauth_state'] = $state = 'returned';
}/*}}}*/

/*
 * Switch based on where in the process you are
 *
 * 'default': Get a request token from twitter for new user
 * 'returned': The user has authorize the app on twitter
 */
switch ($state) {/*{{{*/
  default:
    /* Create TwitterOAuth object with app key/secret */
    $to = new TwitterOAuth($consumer_key, $consumer_secret);
    /* Request tokens from twitter */
    $tok = $to->getRequestToken();

    /* Save tokens for later */
    $_SESSION['oauth_request_token'] = $token = $tok['oauth_token'];
    $_SESSION['oauth_request_token_secret'] = $tok['oauth_token_secret'];
    $_SESSION['oauth_state'] = "start";

    /* Build the authorization URL */
    $request_link = $to->getAuthorizeURL($token);

    /* Build link that gets user to twitter to authorize the app */
    $content = 'Click on the link to go to twitter to authorize your account.';
    $content .= '<br /><a href="'.$request_link.'">'.$request_link.'</a>';
    break;
  case 'returned':
    /* If the access tokens are already set skip to the API call */
    if ($_SESSION['oauth_access_token'] === NULL && $_SESSION['oauth_access_token_secret'] === NULL) {
      /* Create TwitterOAuth object with app key/secret and token key/secret from default phase */
      $to = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['oauth_request_token'], $_SESSION['oauth_request_token_secret']);
      /* Request access tokens from twitter */
      $tok = $to->getAccessToken();

      /* Save the access tokens. Normally these would be saved in a database for future use. */
      $_SESSION['oauth_access_token'] = $tok['oauth_token'];
      $_SESSION['oauth_access_token_secret'] = $tok['oauth_token_secret'];
    }
    /* Random copy */
    /*$content = 'your account should now be registered with twitter. Check here:<br />';
    $content .= '<a href="https://twitter.com/account/connections">https://twitter.com/account/connections</a>'; */

    /* Create TwitterOAuth with app key/secret and user access key/secret */
    $to = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['oauth_access_token'], $_SESSION['oauth_access_token_secret']);
    /* Run request on twitter API as user. */
    //$content = $to->OAuthRequest('https://twitter.com/account/verify_credentials.xml', array(), 'GET');
    //$content1 = $to->OAuthRequest('https://twitter.com/statuses/update.xml', array('status' => 'api test'), 'POST');
    //$content2 = $to->OAuthRequest('https://twitter.com/statuses/replies.xml', array(), 'GET');
    break;
}/*}}}*/
?>

<html>
  <head>
    <title>Twitter OAuth in PHP</title>
  </head>
  <body>
    <h1>Welcome to a iPRATIK -twitter webapp created by Pratik Anand <br>&lt pratik.preet@gmail.com &gt </h1>
    <p>This site is a basic showcase of Twitters new OAuth authentication method. Everything is saved in sessions. If you want to start over <a href='<?php echo $_SERVER['PHP_SELF']; ?>?test=clear'>clear sessions</a>.</p>

    

    <p><pre><?php 
//print_r($content); 
echo "<br><a href=$request_link><img src='img/login.gif' border='0'/></a>";
 if(isset($_SESSION['oauth_access_token_secret']))
   {
	   echo "<form action='main.php' method='POST'>";
	   echo "Login<input type='text' name='n1'/>";
	   echo "<input type='submit' value='Go!'/>";
	   echo "</form>";
	 	   
   }
 ?><pre></p>
<pre>
Created by <b>Pratik Anand</b> 2010 
email:pratik.preet@gmail.com | blog:<a href="http://pratik3d.blogspot.com">pratik3d.blogspot.com</a> | twitter:<a href='http://twitter.com/pratikone'>twitter.com/pratikone</a>
<br>

Get the API powering this at <a href='http://github.com/abraham/twitteroauth'>http://github.com/abraham/twitteroauth</a>
          
  </body>
</html>
