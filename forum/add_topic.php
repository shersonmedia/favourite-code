<?php
include_once('config.php');

// get data that sent from form 
 $topic=htmlentities($_POST['topic']);
 $detail=htmlentities($_POST['detail']);
 // get stored session details
 $username=$_SESSION['user']['user_name'];
 $userid=$_SESSION['user']['user_id'];
 //create date time to store
 $topicdate=date("d/m/y h:i:s"); 
 
$sql="INSERT INTO forum_topics(topic_name, topic_content, user_name, user_id, topic_date)VALUES('$topic', '$detail', '$username', '$userid', '$topicdate')";

$result=mysql_query($sql);


?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Topic Added</title>
</head>

<body>

<?php


if($result){
echo "Successful<BR>";
echo "<a href=index.php>View your topic</a>";
}
else {
echo "ERROR";
 }
 mysql_close();
 ?>
 
  </body>

</html>

