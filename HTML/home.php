<?php
session_start();

// Check if the logout button is clicked
if (isset($_POST['logout'])) {
    // Perform any necessary logout actions here

    // Destroy the session and redirect to the login page or any other desired location
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../CSS/home.css">
  
  
</head>
<body>
    <div class="back"></div>
 <div><img style="width:10%;"src="../images/salt.png">
</div>
<p style="margin-right: 15%">
<img style = " width: 5% ; margin-left:15%" src = "../images/password.png">
</p>
    
   
    <div class="container">
            <h1>Welcome Message</h1>
            <p>This project is implemented by group 33 using HTML,
                 CSS and PHP for saving your data and especially<br> your password as salted hash</p>
            <h1></h1>
         <button>   <a href="login.php" class="btn">Log Out </a> </button>
    </div>
</body>
</html>
