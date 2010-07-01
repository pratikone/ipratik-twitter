

<!--
Using Abraham's twitter OAuth api 
Abraham Williams (abraham@abrah.am) http://abrah.am

Coded by :
Pratik Anand <pratik.preet@gmail.com>  ,  <pratik3d.blogspot.com>
May-June 2010
-->
<?php
//disabling error reporting
error_reporting(0);

// require twitterOAuth lib
require_once('twitteroauth/twitterOAuth.php');

/* Sessions are used to keep track of tokens while user authenticates with twitter */
session_start();
/* Consumer key from twitter */
$consumer_key = 'MKBDrDVkP4bLsvhjbHC0FA';
/* Consumer Secret from twitter */
$consumer_secret = 'OMJemmrf5zgpqfUZx2UrurymBfPBRdILHDUlvP3kwY';

   /* Create TwitterOAuth with app key/secret and user access key/secret */
    $to = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['oauth_access_token'], $_SESSION['oauth_access_token_secret']);
    /* Run request on twitter API as user. */
    $content1=$to->OAuthRequest('https://twitter.com/statuses/followers/'.$_POST['username'].'.xml',array(),'GET');
    $content11 = $to->OAuthRequest('https://twitter.com/statuses/followers/pratikone.xml', array(), 'GET');
   // break;
//}/*}}}*/?>

<?php
echo "Followers of <b>".$_POST['username']."</b> are :";
echo "<pre>";
 print_r($content1);
 echo "</pre>";
?>

