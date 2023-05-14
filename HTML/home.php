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
    <style>
        .container {
            text-align: center;
            margin-top: 100px;
        }
        
        .logout-button {
            padding: 10px 20px;
            background-color: #ddd;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['user_name'])) { ?>
            <h3>Hi, <span>user</span></h3>
            <h1>Welcome, <span><?php echo $_SESSION['user_name']; ?></span></h1>
            <p>This is a student page</p>
            <a href="logout.php" class="btn">Logout</a>
        <?php } else { ?>
            <h3>Hi, <span>user</span></h3>
            <h1>Welcome to our project</h1>
            <p>This is a user page</p>
         <button>   <a href="logout.php" class="btn">Log Out </a> </button>
            
        <?php } ?>
    </div>
</body>
</html>
