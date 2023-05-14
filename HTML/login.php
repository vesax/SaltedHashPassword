<!doctype html>
<html lang="en">
<head>
  <title>LogInSignUP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../CSS/login1.css">
</head>
<body>

<?php 
require_once("connectDB.php");

if(isset($_POST['login'])){


  $email = mysqli_real_escape_string($conn, $_POST['email']);

  $select = "SELECT * FROM user_form WHERE email = $email";

  $result = mysqli_query($conn, $select);

  if(mysqli_num_rows($result) > 0){

     $user = mysqli_fetch_assoc($result);

     // Verify the password using the stored salt and hashed password
     $pass = $_POST['password'] . $user['salt'];

     if(password_verify($pass, $user['password'])){
        // Password matches, log in the user
        session_start();
        $_SESSION['email'] = $user['email'];
        header('location:home.php');
     }else{
      echo "<div class='alert alert-danger p-3'>Incorrect email or password.</div>";
     }

  }else{

     $error[] = 'User not found!';

  }

};
mysqli_close($conn);
?>




<from action="" method="POST" >
  <div class="section">
    <div class="container">
      <div class="row full-height justify-content-center">
        <div class="col-12 text-center align-self-center py-5">
          <div class="section pb-5 pt-5 pt-sm-2 text-center">
            <label for="reg-log"></label>
            <div class="card-3d-wrap mx-auto">
              <div class="card-3d-wrapper">
                <div class="card-front">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <h4 class="mb-4 pb-3">Log In
                      </h4>
                      <div class="form-group">
                        <input type="email" class="form-style" name="email" placeholder="Email">
                        <i class="input-icon uil uil-at"></i>
                      </div>
                      <div class="form-group mt-2">
                        <input type="password" class="form-style" name = "password" placeholder="Password">
                        <i class="input-icon uil uil-lock-alt"></i>
                      </div>
                      <a href="" class="btn mt-4">Login</a>
                      <p class="signupklasa"><a href="signup.php">Create an account</p>
                      <p class="mb-0 mt-4 text-center"><a href="" class="link">Forgot your
                          password?</a></p>
                    </div>
                  </div>
                </div>
                
</form>
</body>

                  