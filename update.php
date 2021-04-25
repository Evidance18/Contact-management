<?php
// Include config file
require_once "functions.php";
 
// Define variables and initialize with empty values
$fullname = $profession = $email = $phoneNo = $city = $address = $category = "";
$fullname_err = $profession_err = $email_err = $phoneNo_err = $city_err = $address_err = $category_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_fullname = trim($_POST["fullname"]);
    if(empty($input_fullname)){
        $fullname_err = "Please enter a full name.";
    } elseif(!filter_var($input_fullname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $fullname_err = "Please enter a valid name and surname.";
    } else{
        $fullname = $input_fullname;
    }
	
	// Validate profession
    $input_profession = trim($_POST["profession"]);
    if(empty($input_profession)){
        $profession_err = "Please enter a profession.";
    } elseif(!filter_var($input_profession, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $surname_err = "Please enter a valid profession.";
    } else{
        $profession = $input_profession;
    }
	
	// Validate email
	$input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an address.";     
    } else{
        $email = $input_email;
    }
	
	// Validate phoneNo
    $input_phoneNo = trim($_POST["phoneNo"]);
    if(empty($input_phoneNo)){
        $phoneNo_err = "Please enter the Phone Number.";     
    } elseif(!ctype_digit($input_phoneNo)){
        $phoneNo_err = "Please enter a positive integer value.";
    } else{
        $phoneNo = $input_phoneNo;
    }
	
	
	
	// Validate city
    $input_city = trim($_POST["city"]);
    if(empty($input_city)){
        $city_err = "Please enter a city.";
    } elseif(!filter_var($input_city, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $city_err = "Please enter a valid city.";
    } else{
        $city = $input_city;
    }
    
    // Validate address address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
        // Validate category
    $input_category = trim($_POST["category"]);
    if(empty($input_category)){
        $category_err = "Please enter category.";
    } elseif(!filter_var($input_category, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[PrivateBusiness\s]+$/")))){
        $category_err = "Category must be Private or Business.";
    } else{
        $category = $input_category;
    }
    
    // Check input errors before inserting in database
    if(empty($fullname_err) && empty($profession_err) && empty($email_err) && empty($phoneNo_err) && empty($gender_err) && empty($address_err) && empty($category_err)){
        // Prepare an update statement
        $sql = "UPDATE contacts SET fullname=?, profession=?, phoneNo=?, email=?, city=?, address=?, category=? WHERE id=?";
         
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssi", $param_fullname, $param_profession, $param_phoneNo, $param_email, $param_city, $param_address, $param_category, $param_id);
            
            // Set parameters
            $param_fullname = $fullname;
			$param_profession = $profession;
			$param_email = $email;
			$param_phoneNo = $phoneNo;
			$param_city = $city;
            $param_address = $address;
			$param_category = $category;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                //Notify when process is successful
                echo "<script>alert('Contact is successfully updated');</script>";

                // Records updated successfully. Redirect to landing page
                echo "<script type='text/javascript'> document.location = 'allcontacts.php'; </script>";
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($connection);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM contacts WHERE id = ?";
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
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
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset='utf-8'>
<title>Update Record</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src='javascript.js'></script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="header">
                        <h2>Update Contact</h2>
                        <p>Please edit the input values and submit to update the contact.</p>
                    </div>
                    
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="input-group <?php echo (!empty($fullname_err)) ? 'has-error' : ''; ?>">
                            <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" placeholder="Full Name" value="<?php echo $fullname; ?>">
                            <span class="help-block"><?php echo $fullname_err;?></span>
                        </div>
						<div class="input-group <?php echo (!empty($profession_err)) ? 'has-error' : ''; ?>">
                            <label>Profession</label>
                            <input type="text" name="profession" class="form-control" placeholder="Profession" value="<?php echo $profession; ?>">
                            <span class="help-block"><?php echo $profession_err;?></span>
                        </div>
						<div class="input-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Address" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
						<div class="input-group <?php echo (!empty($phoneNo_err)) ? 'has-error' : ''; ?>">
                            <label>Phone Number</label>
                            <input type="text" name="phoneNo" class="form-control" placeholder="Phone Number" value="<?php echo $phoneNo; ?>">
                            <span class="help-block"><?php echo $phoneNo_err;?></span>
                        </div>
                        <div class="input-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" placeholder="City" value="<?php echo $city; ?>">
                            <span class="help-block"><?php echo $city_err;?></span>
                        </div>
						<div class="input-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <textarea name="address" class="form-control" placeholder="Address"><?php echo $address; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        <div class="input-group <?php echo (!empty($category_err)) ? 'has-error' : ''; ?>">
                            <label>Category</label>
                            <select name="category" size="1"> <option value="Private">Private</option>
							<option value="Business">Business</option></select>
                            <span class="help-block"><?php echo $category_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="allcontacts.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>