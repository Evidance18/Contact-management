<?php // functions.php
  $dbhost  = 'localhost';  // localhost
  $dbname  = 'contact';    // database name
  $dbuser  = 'root';   // user name
  $dbpass  = 'password';   // user password
// Connect to the database
  $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($connection->connect_error) die("Fatal Error On Connecting");
  //Get connection
  function queryMysql($query)
  {
    global $connection;
    $result = $connection->query($query);
    if (!$result) die("Fatal Error on insersion");
    return $result;
  }
// Destroy Session
  function destroySession()
  {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  }
//The sanitizeString and sanitizeMySQL functions
  function sanitizeString($var)
  {
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if (get_magic_quotes_gpc())
      $var = stripslashes($var);
    return $connection->real_escape_string($var);
  }
  //Functions for preventing both SQL and XSS injection attacks
  function mysql_entities_fix_string($connection, $string)
  {
	  return htmlentities(mysql_fix_string($connection, $string));
  }
  //Functions for preventing both SQL and XSS injection attacks
  function mysql_fix_string($connection, $string)
  {
	  if (get_magic_quotes_gpc()) $string = stripcslashes($string);
	  return $connection->real_escape_string($string);
  }

	  
?>
