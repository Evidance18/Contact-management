<?php // logout.php
// Include header file
  require_once 'header.php';
// Destry session
  if (isset($_SESSION['user']))
  {
    destroySession();
    //Redirect to login/index form
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
  }
  else echo "<div class='center'>You cannot log out because
             you are not logged in</div>";
?>
    </div>
  </body>
</html>
