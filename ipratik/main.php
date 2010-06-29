<html>
<head>
<!--<style type="text/css"> 

.faintyfont
{ font-size:18px;
}

</style>
-->
<?php $_SESSION['username']=$_POST['n1'];
 ?>
</head>
<body>
<div align='center'>
<div align='left'>
<h1>iPRATIK: twitter web application</h1>
<br>
<form action='update.php' method='POST'>
<!--Login:    <input type='text' name='n1'/> -->
<!-- bug:  [solved]First get logged in then come back to this page for viewing other's profile details -->
<!--Password: <input type='password' name='p1'/>  -->

Update Status
<input type='text' name='up_text' size='80' value='Optional.Use if u want to update ur twitter status'/>

<br>
<input type='submit' value='GO!'/>

</form>
<!-- end of form  -->
</div>
<img src='img/ele_d.jpg' alt='twitter elephant' height=250 width=400>
<!--
status check 
<button type='button' onClick="javascript:window.open('debug1.php')">View Status</button>
<button type='button' onClick="javascript:window.open('replies.php')">Replies</button>
<button type='button' onClick="javascript:window.open('followers.php')">Followers</button>
-->

<!-- status check-->
<form action=msg.php method='POST'>
<input type='submit' value='Status Check'/>
<?php $err=$_SESSION['username'];
  echo "<input type='hidden' value=$err name='username'/>";
 ?>
</form>
<!--replies-->
<form action=replies.php method='POST'>
<input type='submit' value='Replies'/>
<?php $err=$_SESSION['username'];
  echo "<input type='hidden' value=$err name='username'/>";
 ?>
 </form>
 <!--followers-->
  <form action=followers.php method='POST'>
<input type='submit' value='Followers'/>
<?php $err=$_SESSION['username'];
  echo "<input type='hidden' value=$err name='username'/>";
 ?>
</form>

<BR>
<h1>
<pre>
Created by <u>Pratik Anand</u> &lt pratik.preet@gmail.com&gt 2010.
blog: pratik3d.blogspot.com
twitter: twitter.com/pratikone
<br></h1>
<h4>Using OAuth api developed by Abraham Williams &lt abraham@abrah.am &gt </h4>
</pre>
</div>

</body>







</html>
