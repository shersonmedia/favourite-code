<?php
include_once('config.php');  
$query = 'UPDATE users SET session_id = NULL WHERE user_id = ' . $_SESSION['user']['user_id'] . ' LIMIT 1';  
mysql_query($query);  
unset($_SESSION['user']);  
//session_destroy();
header('Location: login.php');  
exit;  
?>