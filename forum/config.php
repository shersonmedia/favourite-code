<?php
//include_once('config_errors.php');
// Start using  session info  
session_start();  
  
// Establish a link to the server  
$dbLink = mysql_connect("sql108.freewebhost.co.nz","freew_11486829","gsatcvc12");
if (!$dbLink) die('Can\'t establish a connection to the server: ' . mysql_error());  

// Connect to the database
$dbSelected = mysql_select_db('freew_11486829_myforum', $dbLink);  
if (!$dbSelected) die ('We\'re connected, but can\'t use the database: ' . mysql_error());  
  
// Check that the session id matches a session in the database (this is a hash coded string)
// Start from a position of NOT being logged in
$isUserLoggedIn = false;   
$query      = 'SELECT * FROM users WHERE session_id = "' . session_id() . '" LIMIT 1';  
$userResult     = mysql_query($query);  
if(mysql_num_rows($userResult) == 1){  
//If the session id is found then get all the user details and put them in a session variable called user
    $_SESSION['user'] = mysql_fetch_assoc($userResult);  
    //Set the user logged in to true
    $isUserLoggedIn = true;  
}
 
?>