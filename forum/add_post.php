<?php

include_once('config.php');

// Get value of id that sent from hidden field 
$topic_id=$_POST['topic_id'];
// Get value of user from config 
$user_id = $_SESSION['user']['user_id'];
$user_name = $_SESSION['user']['user_name'];
// get values that sent from form 
$post_content=htmlentities($_POST['post_content']);
$post_date=date("d/m/y H:i:s"); // create date and time 

// Insert answer 
$sql2="INSERT INTO forum_post (topic_id, user_id, user_name, post_content, post_date) VALUES ('$topic_id', '$user_id', '$user_name', '$post_content', '$post_date')";
$result2=mysql_query($sql2);
//echo $sql2;

?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Post Added</title>
</head>

<body>

<?php


if($result2){
echo "Successful<BR>";
echo "<a href='view_topic.php?id=".$topic_id."'>View your Post</a>";
}
else {
echo "ERROR";
}

// Close connection


mysql_close();
 ?>
 </body>

</html>

