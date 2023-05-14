<!doctype html>
<html lang="en">
<head>
  <title>LogInSignUP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../CSS/signup.css">
</head>
<body>
    <div class="container">

    <?php
include_once( 'connectDB.php');
if(isset($_POST['submit'])){
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = $_POST['password'];
  $password_confirm = $_POST['confirm_pass'];

  $errors = array();

if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm_pass']) ){

  echo "<div class='alert alert-danger p-3'>All fields are required</div>";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  array_push($errors, "Email is not valid");
 }
 if (strlen($password)<8) {
  echo "<div class='alert alert-danger p-3'>Password must be at least 8 charactes long</div>";
 }
 if ($password!==$password_confirm) {
  echo "<div class='alert alert-danger p-3'>Password does not match.</div>";
 }



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

  array_push($errors,"Email already exists!");

 }else{

      if(!password_verify($_POST['password'] . $salt, $cpass)){
         $error[] = 'Password not matched!';
      }else{
        $sql = "INSERT INTO user_form ( name, email, password, salt) VALUES ( ?, ?,?, ?)";
            $statemant = mysqli_stmt_init($conn);
            $prepareStatemant = mysqli_stmt_prepare($statemant,$sql);
            if ($prepareStatemant) {
                mysqli_stmt_bind_param($statemant,"ssss", $name, $email, $pass, $salt);
                mysqli_stmt_execute($statemant);
                echo "<div class='alert alert-success p-3'>You are registered successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }
          };
        };
 mysqli_close($conn);
?>


        <h4 class="mb-3 pb-3">Sign Up </h4>
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
          <input type="submit" name="submit" value="Sign Up"></input>
          <p class='HaveAnAccount'>Already have an account?<a class="loginbutton"href="login.php"> Login</p>
          
         
        </form>
      </div>
</body>
</html>      