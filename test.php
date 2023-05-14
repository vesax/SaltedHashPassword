<!doctype html>
<html lang="en">
<head>
  <title>LogInSignUP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>
<?php 

include_once( 'connectDB.php');



if(isset($_POST['submit'])){
$password = $_POST['password'];
$password_confirm = $_POST['confirm_pass'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);

   // Generate a random salt
   $salt = bin2hex(random_bytes(16));

   // Hash the password using the salt and the bcrypt algorithm
   $pass = $password . $salt;
   $pass = password_hash($pass, PASSWORD_BCRYPT);

   // Hash the confirm password using the same salt and bcrypt algorithm
   $cpass = $password_confirm. $salt;
   $cpass = password_hash($cpass, PASSWORD_BCRYPT);

   $select = "SELECT * FROM user_form WHERE email = '$email'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'User already exists!';

   }else{

      if(!password_verify($_POST['password'] . $salt, $cpass)){
         $error[] = 'Password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, salt) VALUES('$name','$email','$pass', '$salt')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
   }
   $errors = array();

   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($errors, "Email is not valid");
   }
   if (strlen($password)<8) {
    array_push($errors,"Password must be at least 8 charactes long");
   }
   if ($password!==$password_confirm) {
    array_push($errors,"Password does not match");
   }
};
mysqli_close($conn);
?>


<?php 
require_once("connectDB.php");

if(isset($_POST['login'])){
  $_POST['email'];

  $email = mysqli_real_escape_string($conn, $_POST['email']);

  $select = "SELECT * FROM user_form WHERE email = '$email'";

  $result = mysqli_query($conn, $select);

  if(mysqli_num_rows($result) > 0){

     $user = mysqli_fetch_assoc($result);

     // Verify the password using the stored salt and hashed password
     $pass = $_POST['password'] . $user['salt'];

     if(password_verify($pass, $user['password'])){
        // Password matches, log in the user
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['user_type'];
        header('location:home.php');
     }else{
        $error[] = 'Incorrect password!';
     }

  }else{

     $error[] = 'User not found!';

  }

};

?>






<form action="" method="POST" >
  <div class="section">
    <div class="container">
      <div class="row full-height justify-content-center">
        <div class="col-12 text-center align-self-center py-5">
          <div class="section pb-5 pt-5 pt-sm-2 text-center">
            <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
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
                        <input type="password" class="form-style" name="password" placeholder="Password">
                        <i class="input-icon uil uil-lock-alt"></i>
                      </div>
                      <input type="submit" name="login" value="Login"></input>
                      <p class="mb-0 mt-4 text-center"><a href="" class="link">Forgot your
                          password?</a></p>
                    </div>
                  </div>
                </div>
                <div class="card-back">
                  <div class="center-wrap">
                    <div class="section text-center">
</form>





                        <h4 class="mb-3 pb-3">Sign Up</h4>
                      <form action="" method="POST">   
                        <div class="form-group">
                          <input type="text" class="form-style" placeholder="Full Name" name="name">
                          <i class="input-icon uil uil-user"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input type="email" class="form-style" placeholder="Email" name="email">
                          <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input type="password" class="form-style" placeholder="Password" name="password">
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input type="password" class="form-style" placeholder="Confirm Password" name="confirm_pass">
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <input type="submit" name="submit" value="Signup"></input>
                      </form>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>