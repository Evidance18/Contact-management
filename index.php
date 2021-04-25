<?php 
// Start Session
session_start();
//Include HTML
echo <<<_INIT
  <!DOCTYPE html> 
  <html>
    <head>
    <title>Log in</title>
    <meta charset='utf-8'>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src='javascript.js'></script>


  _INIT;
//Include functions file
  require_once 'functions.php';
  // Error if the inputs are empty
  $error = $user = $pass = "";
//An associative array of variables passed to the current script via the HTTP POST method.
  if (isset($_POST['user']))
  {
    $user = mysql_fix_string($connection, $_POST['user']);
    $pass = mysql_fix_string($connection, $_POST['pass']);
    // Check if the fields are not empty
    if ($user == "" || $pass == "")
      $error = 'Not all fields were entered';
    else
    {
      $result = queryMySQL("SELECT user,pass FROM admin
        WHERE user='$user' AND pass='$pass'");

        //Validate cridentials
      if ($result->num_rows == 0)
      {
        $error = "Invalid login attempt";
      }
      else
      {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        //Redirect to allcontacts form
        echo "<script type='text/javascript'> document.location = 'allcontacts.php'; </script>";
      }
    }
  }

  //login form
echo <<<_END
      <div class="header">
      <h2>Contacts Management System</h2>
      <h4>Admin Login</h4>
      </div>
      <form method='post' action='index.php'>
      <div class="input-group">
          <label></label>
          <span class='error'>$error</span>
        </div>
        
        <div class="input-group">
          <label>Username</label>
          <input type='text' maxlength='16' name='user' value='$user' placeholder='Username'>
        </div>
        <div class="input-group">
          <label>Password</label>
          <input type='password' maxlength='16' name='pass' value='$pass' placeholder='Password'>
        </div>
        <div class="input-group">
          
        <button type="submit" style="float: left;" name="login" class="btn">Login</button>
        </div>
        <div class="input-group" align='center'>
		  <label></label>
          <a href="resetpassword.php" >Forgot Password?</a>
        </div>
      </form>
    </div>
  </body>
</html>
_END;

?>
