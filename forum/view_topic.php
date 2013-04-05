<?php

include_once('config.php');

// get value of id that sent from address bar 
$id=$_GET['id'];
if ($isUserLoggedIn) { 
$user_id = $_SESSION[users][user_id];
$user_name = $_SESSION[users][user_name];
}
$sql="SELECT * FROM forum_topics WHERE topic_id='$id'";

$result=mysql_query($sql);

$rows=mysql_fetch_array($result);
 ?>

<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>View Topic</title>
</head>

<body>

 <table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
 <tr>
 <td><table width="100%" border="0" cellpadding="3" cellspacing="1" bordercolor="1" bgcolor="#FFFFFF">
 <tr>
 <td bgcolor="#F8F7F1"><strong>Topic: </strong><?php echo $rows['topic_name']; ?></td>
 </tr>

 <tr>
 <td bgcolor="#F8F7F1"><strong>Description: </strong><?php echo $rows['topic_content']; ?></td>
 </tr>

 <tr>
 <td bgcolor="#F8F7F1"><strong>By: </strong> <?php echo $rows['user_name']; ?> </td>
 </tr>

 <tr>
 <td bgcolor="#F8F7F1"><strong>Submitted : </strong><?php echo $rows['topic_date']; ?></td>
 </tr>
 </table></td>
 </tr>
 </table>
 <br />

<?php

$sql2="SELECT * FROM forum_post WHERE topic_id='$id'";
$result2=mysql_query($sql2);

while($rows=mysql_fetch_array($result2)){
 ?>

 <table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
 <tr>
 <td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
 <tr>
 <td bgcolor="#F8F7F1"><strong>ID: </strong></td>
 <td bgcolor="#F8F7F1">:</td>
 <td bgcolor="#F8F7F1"><? echo $rows['post_id']; ?></td>
 </tr>
  <tr>
 <td bgcolor="#F8F7F1"><strong>By: </strong></td>
<td bgcolor="#F8F7F1">:</td>
 <td bgcolor="#F8F7F1"><?php echo $rows['user_name']; ?></td>
 </tr>
 <tr>
 <td bgcolor="#F8F7F1"><strong>Post: </strong></td>
 <td bgcolor="#F8F7F1">:</td>
 <td bgcolor="#F8F7F1"><? echo $rows['post_content']; ?></td>
 </tr>
 <tr>
 <td bgcolor="#F8F7F1"><strong>Submitted: </strong></td>
 <td bgcolor="#F8F7F1">:</td>
 <td bgcolor="#F8F7F1"><? echo $rows['post_date']; ?></td>
 </tr>
 </table></td>
 </tr>
 </table><br />

 

<?php
 }
 mysql_close();
 ?>




 <br />
<?php if ($isUserLoggedIn) { ?> 

 
 <table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
 <tr>
<form name="form1" method="post" action="add_post.php">
 <td>
 <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
 <tr>
 <td valign="top"><strong>Post Content</strong></td>
 <td valign="top">:</td>
 <td><textarea name="post_content" cols="45" rows="3" id="post_content"></textarea></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td><input name="topic_id" type="hidden" value="<? echo $id; ?>"></td>
  <td><input type="submit" name="Submit" value="Submit"> <input type="reset" name="Submit2" value="Reset"></td>
 </tr>
 </table>
 </td>
</form>
 </tr>
 </table>
 
 <?php } else { ?>

<p><a href="login.php">Login to add comments</a></p>
<?php } ?>

</body>

</html>


