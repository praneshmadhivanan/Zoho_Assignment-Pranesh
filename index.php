<?php

$email  = $_POST['email'];
$upswd1 = $_POST['upswd1'];
$upswd2 = $_POST['upswd2'];




if (!empty($email) || !empty($upswd1) || !empty($upswd2) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "zohopranesh";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT Into register (email ,upswd1, upswd2 )values(?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sss", $email,$upswd1,$upswd2);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Contact App</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="main.css">
        <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
    </head>
    <body>
        
        <div class = "main-container">
            <!-- input record -->
            <div class = "record-input">
                <h2>Add Contacts</h2>
                <div class = "entry-form">
                    <form>
                        <label for = "name">Name</label>
                        <input type = "text" id = "name">

                        <label for = "address">Email</label>
                        <input type = "text" id = "address">

                        <label for = "contact-num">Ph No</label>
                        <input type = "text" id = "contact-num">
                    </form>

                    <!-- alert message -->
                    <span class = "message"></span>

                    <div class = "input-btns">
                        <button type = "submit" id = "submit-btn">
                            <span>
                                <i class = "fas fa-plus"></i>
                            </span> Save
                        </button>

                        <button type = "button" id = "cancel-btn">
                            <span>
                                <i class = "fas fa-times"></i>
                            </span> Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- display record -->
            <div class = "record-display">
                <h2>My Contacts: </h2>
                <!-- reset btn -->
                <button type = "button" id = "reset-btn">
                    Reset
                </button>

                <div class = "record-container">
                    <!-- single record -->
                    <!--
                    <div class = "record-item">
                        <div class = "record-el">
                            <span id = "labelling">Contact ID: </span>
                            <span id = "contact-id-content">1</span>
                        </div>

                        <div class = "record-el">
                            <span id = "labelling">Name: </span>
                            <span id = "name-content">John Doe</span>
                        </div>

                        <div class = "record-el">
                            <span id = "labelling">Address: </span>
                            <span id = "address-content">Ohio</span>
                        </div>

                        <div class = "record-el">
                            <span id = "labelling">Contact Number: </span>
                            <span id = "contact-num-content">123-456-7890</span>
                        </div>

                        <button type = "button" id = "delete-btn">
                            <span>
                                <i class = "fas fa-trash"></i>
                            </span> Delete
                        </button>
                    </div>
                    -->
                    <!-- end of single record -->
                </div>
            </div>
        </div>
        

        <!-- JS file -->
        <script src = "script.js"></script>
    </body>
</html>