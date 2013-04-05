<?php
include_once('config.php');

//Using the connection in the config file selects all the forum topics
// ORDER BY topic_id DESC means list in descending order

$sql="SELECT * FROM forum_topics ORDER BY topic_id DESC";

$result=mysql_query($sql);
 ?>

<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Forum Topics</title>
</head>

<body>






<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
 <tr>
 <td width="6%" align="center" bgcolor="#E6E6E6"><strong>#</strong></td>
 <td width="53%" align="center" bgcolor="#E6E6E6"><strong>Topic</strong></td>
 <td width="28%" align="center" bgcolor="#E6E6E6"><strong>Username</strong></td>
 <td width="13%" align="center" bgcolor="#E6E6E6"><strong>Date/Time</strong></td>
 </tr>

<?php

 

// Start looping table row
 while($rows=mysql_fetch_array($result)){
 ?>
<tr>
 <td bgcolor="#FFFFFF"><? echo $rows['topic_id']; ?></td>
<td bgcolor="#FFFFFF"><a href="view_topic.php?id=<? echo $rows['topic_id']; ?>"><? echo $rows['topic_name']; ?></a><BR></td>
 <td align="center" bgcolor="#FFFFFF"><? echo $rows['user_name']; ?></td>
<td align="center" bgcolor="#FFFFFF"><? echo $rows['topic_date']; ?></td>
 </tr>

<?php
// Exit looping and close connection 
}
 mysql_close();
 ?>
 </table>
 <?php if ($isUserLoggedIn) { ?>
 
 <!-- CREATE NEW TOPIC CODE -->
 <table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
 <tr>
<form id="form1" name="form1" method="post" action="add_topic.php">
 <td>
 <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
 <tr>
 <td colspan="3" bgcolor="#E6E6E6"><strong>Create New Topic</strong> </td>
 </tr>
 <tr>
 <td width="14%"><strong>Topic</strong></td>
 <td width="2%">:</td>
 <td width="84%"><input name="topic" type="text" id="topic" size="50" /></td>
 </tr>
 <tr>
 <td valign="top"><strong>Detail</strong></td>
 <td valign="top">:</td>
 <td><textarea name="detail" cols="50" rows="3" id="detail"></textarea></td>
 </tr>
  <tr>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td><input type="submit" name="Submit" value="Submit" /> <input type="reset" name="Submit2" value="Reset" /></td>
 </tr>
 </table>
 </td>
</form>
 </tr>
 </table>
<?php } else { ?>

<p><a href="login.php">Login to add topics</a></p>
<?php } ?>

</body>

</html>

