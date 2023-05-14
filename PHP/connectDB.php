<?php
$DataBase="localhost";
$username="root";
$password ="";
$DataBaseName="siguri";

$conn = mysqli_connect($DataBase,$username,$password,$DataBaseName);

if(!$conn){
echo"Connection with database failed";

}

?>