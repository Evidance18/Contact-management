<?php
require_once 'functions.php'; // Indlude functions file
//HTML
echo <<<_INIT
  <!DOCTYPE html> 
  <html>
    <head>
    <meta charset='utf-8'>
    <title>Add Record</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src='javascript.js'></script>


  _INIT;

// Check if contact number do not exist
echo <<<_END
<script>
    function checkContact(phoneNo)
    {
    if (phoneNo.value == '')
    {
        $('#used').html('&nbsp;')
        return
    }

    $.post
    (
        'checkcontact.php',
        { phoneNo : phoneNo.value },
        function(data)
        {
        $('#used').html(data)
        }
    )
    }
</script>  
_END;
// Check input errors before inserting in database
$error = $fullname = $profession = $email = $phoneNo = $city = $address = $category = "";
if (isset($_SESSION['id'])) destroySession();

//Sanitize user input for MySQL
if (isset($_POST['id']))
{
    $id           = mysql_fix_string($connection, $_POST['id']);
    $fullname     = mysql_fix_string($connection, $_POST['fullname']);
    $profession   = mysql_fix_string($connection, $_POST['profession']);
    $email        = mysql_fix_string($connection, $_POST['email']);
    $phoneNo      = mysql_fix_string($connection, $_POST['phoneNo']);
    $city         = mysql_fix_string($connection, $_POST['city']);
    $address      = mysql_fix_string($connection, $_POST['address']);
    $category     = mysql_fix_string($connection, $_POST['category']);

    // Check if inputs are not empty
    if ($fullname == "" || $profession == "" || $email == "" || $phoneNo == "" || $city == "" || $address == "" || $category == "")
    $error = 'Not all fields were entered<br><br>'; // Display error if fields are empty
    else
    {
        //Select mobile number from table to check if it exists
    $result = queryMysql("SELECT * FROM contacts WHERE phoneNo='$phoneNo'"); 
    // Collecting data from table
    if ($result->num_rows)
        $error = 'That contact already exists<br><br>'; // Out printing error
    else
    {
        // Prepare statement
        $stmt = $connection->prepare('INSERT INTO contacts (fullname, profession, email, phoneNo, city, address, category, id) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('sssssssi', $fullname, $profession, $email, $phoneNo, $city, $address, $category, $id);
        // Execute statement
        $stmt->execute(); 
        // Insert ID auto
        echo "The Insert ID was: " . $connection->insert_id; 
        // Notify if the process is successful
        echo "<script>alert('Contact is successfully added');</script>"; 
        // Redirect to allcontacts form
        echo "<script type='text/javascript'> document.location = 'allcontacts.php'; </script>"; 
        $stmt->close(); // Close statement
    }
    }   
}

echo <<<_END
<div class="header">
      <h2>Contacts Management System</h2>
      <h4>Add contact</h4>
      </div>
<form method='post' action='create.php'>$error
    <div class="input-group">
        <label></label>
        <input type="hidden" name="id" class="form-control" value="id">
    </div>
    <div class="input-group">
        <label>Full Name</label>
        <input type="text" name="fullname" class="form-control" placeholder="Full Name" value="$fullname">
    </div>
    <div class="input-group">
        <label>Profession</label>
        <input type="text" name="profession" class="form-control" placeholder="Profession" value="$profession">
    </div>
    <div class="input-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" placeholder="Email Address" value="$email">  
    </div>
    <div class="input-group">
        <label>Mobile Number</label>
        <input type="text" name="phoneNo" minlength="9" maxlength="13" class="form-control" placeholder="Phone Number" value="$phoneNo">
    </div>
    <div class="input-group">
        <label>Citty</label>
        <input type="text" name="city" class="form-control" placeholder="City" value="$city">		
    </div>
    <div class="input-group">
        <label>Address</label>
        <textarea name="address" class="form-control" placeholder="Address" value="$address"></textarea>
    </div>
    <div class="input-group">
        <label>Category</label>
        <select name="category" size="1"> <option value="Private">Private</option>
        <option value="Business">Business</option></select>
    </div>
    <div class="input-group">
        <label></label>
        <input data-transition='slide' type='submit' value='ADD'>
    </div>
    <div class="input-group">
        <label></label>
        <a href="allcontacts.php" class="btn btn-success pull-right">Cancel</a>
    </div>
</div>
</body>
</html>
_END;

$connection->close();  // Close connection
?>