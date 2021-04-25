<?php
require_once "functions.php";

// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    
    
    // Prepare a select statement
    $sql = "SELECT * FROM contacts WHERE id = ?";
    
    if($stmt = mysqli_prepare($connection, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $fullname = $row["fullname"];
                $profession = $row["profession"];
                $email = $row["email"];
				$phoneNo = $row["phoneNo"];
				$city = $row["city"];
				$address = $row["address"];
				$category = $row["category"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($connection);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset='utf-8'>
<title>View Record</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src='javascript.js'></script> 
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="header">
                        <h1>View Contact</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="input-group">
                        <label><h2>Full Name</h2></label>
                        <p class="form-control-static"><?php echo $row["fullname"]; ?></p>
                    </div>
                    <div class="input-group">
                        <label><h2>Profession</h2></label>
                        <p class="form-control-static"><?php echo $row["profession"]; ?></p>
                    </div>
					<div class="input-group">
                        <label><h2>Email</h2></label>
                        <p class="form-control-static"><?php echo $row["email"]; ?></p>
                    </div>
					<div class="input-group">
                        <label><h2>Phone Number</h2></label>
                        <p class="form-control-static"><?php echo $row["phoneNo"]; ?></p>
                    </div>
                    <div class="input-group">
                        <label><h2>City</h2></label>
                        <p class="form-control-static"><?php echo $row["city"]; ?></p>
                    </div>
					<div class="input-group">
                        <label><h2>Address</h2></label>
                        <p class="form-control-static"><?php echo $row["address"]; ?></p>
                    </div>
					<div class="input-group">
                        <label><h2>Category</h2></label>
                        <p class="form-control-static"><?php echo $row["category"]; ?></p>
                    </div>
					
                    <p><a href="allcontacts.php" class="btn btn-primary">Back</a></p>
                </div>
                </form>
            </div>        
        </div>
    </div>
</body>
</html>