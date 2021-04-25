<?php // checkcontact.php

  //Include functions file
  require_once 'functions.php';

  if (isset($_POST['id']))
  {
    $id   = sanitizeString($_POST['id']);
	  $idno = sanitizeString($_POST['phoneNo']);
    $result = queryMysql("SELECT * FROM contacts WHERE phoneNo='$phoneNo'"); // check patient by mobile number

    //Display if the contact is already on the system or not
    if ($result->num_rows)
      echo  "<span class='taken'>&nbsp;&#x2718; " .
            "The mobile number '$phoneNo' is already on the system</span>"; 
    else
      echo "<span class='available'>&nbsp;&#x2714; " .
           "The mobile number '$idno' is available</span>";
  }
?>