<?php
require("./config/connect.php");

$email = "testtest4@gmail.com";
$password = "fish";

$query = "SELECT * FROM users WHERE email = '$email'";
$user = mysqli_query($connect, $query);
$user = mysqli_fetch_all($user, MYSQLI_ASSOC);
print_r($user);

$verify = password_verify($password, $user[0]['password']);
echo "<br>";
if($verify){
    echo 'Welcome';
}else{
    echo "Impostor";
}
?>