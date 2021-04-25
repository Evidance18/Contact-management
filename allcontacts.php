<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Contact Management Systems</title>
        <!--Script file-->
        <script src="script.js"> </script>
        <!--jQuery link-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!--Stylesheet-->
        <link rel="stylesheet" type="text/css" href="style.css">
        <!--jQuery for searching data in the table-->
        <script>
          $(document).ready(function() {
            $("#myInput").on("keyup", function() {
              var value =$(this).val().toLowerCase();
              $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
            });
          });
          //Function to confirm if you want to exit the system
          $(function(){
            $('a#logout').click(function(){
                if(confirm('Are you sure to exit the system?')) {
                    return true;
                }

                return false;
            });
        });
        </script>
    </head>

    <body>
        <!-- header-->
        <div class="header"> <h2>All contacts</h2> <h4>Contact Management System</h4> </div>
          <form>      
          <!-- Creating table-->
    <table id="myTable" border="1" class="center">
        <!--Add new contact button -->
    <button><a href="create.php" name title="Add contacts" data-toggle="tooltip" id="btn-add" class="btn btn-add">Add Contact</a></button>
    
    <!--Add private button to go to Private contacts form-->
    <button style="float: right;"><a href="privatecontacts.php" name title="Private Contacts" data-toggle="tooltip" id="btn-add" class="btn btn-add">Private</a></button>
    <!--Add business button to go to Business contacts form-->
    <button style="float: right;"><a href="businesscontacts.php" name title="Business Contacts" data-toggle="tooltip" id="btn-add" class="btn btn-add">Business</a></button><br>
    <!--Add search bar for searching data in the table-->
    <label >Search:    </label><input id="myInput" class="search" name="search" style="float: center;" type="text" placeholder="Search here"><br>

<?php
//Include functions
require_once 'functions.php';


    // Attempt select query execution
    $sql = "SELECT * FROM contacts";
    if($result = mysqli_query($connection, $sql)){
        if(mysqli_num_rows($result) > 0){
            
            echo "<thead>";
              echo  "<tr>";
                   echo "<th>S.NO</th>";
                   echo "<th>Full Name</th>";
                   echo "<th>Mobile Number</th>";
                   echo "<th>Action</th>";
                echo"</tr>";
           echo "</thead>";
           //Start counting at number 1
                $counter = 1; 
                while($row = mysqli_fetch_array($result)){
                echo "<tbody>";
                    echo "<tr>";
                    echo "<td>" . $counter . "</td>";
                    echo "<td>" . htmlspecialchars($row['1']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['4']) . "</td>";
                    echo "<td>";
                        echo "<a data-role='button' data-inline='true' style='text-decoration: none' title='View Patient' href='read.php?id=". $row['0'] ."'>View</a>";
                        echo "<a data-role='button' data-inline='true' style='text-decoration: none' title='Update Patient' href='update.php?id=". $row['0'] ."'>Edit</a>";
                        echo "<a data-role='button' data-inline='true' style='text-decoration: none' title='Delete Patient' href='delete.php?id=". $row['0'] ."'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";

                    //Incremenent S.No
                    $counter++;
                }
                echo "</tbody>";  
               //Closing Table                           
            echo "</table><br>";
            
            // Free result set
            mysqli_free_result($result);
        } else{
            // Print if the is no data to display
            echo '<div class="next">';
            echo "<p class='lead'><em>No records were found.</em></p>";
            echo '</div>';
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    }
    
    // Close connection
    mysqli_close($connection);
?>
    
        <!--Log out button-->
        <button><a href="logout.php" id="logout" title="Log Out" class="btn btn-add">Logout</a></button>
        <!-- Dellete all data button-->
        <button style="float: right;"><a href="deleteall.php" name title="Delete all" data-toggle="tooltip" id="btn-add" class="btn btn-add">DELETE_ALL</a></button>
</form>
    </body>
</html>