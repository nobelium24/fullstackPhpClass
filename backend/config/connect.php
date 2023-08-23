<?php
    $connect = mysqli_connect("localhost", "nobelium24", "oluwatobi", "testram");
    if(!$connect){
        print_r("Connection error: " .   mysqli_connect_error() );
    }else{
        echo("Connection successful");
    }
// try {
//     require "vendor/autoload.php";

//     $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//     $dotenv->load();

//     $host = $_ENV['DB_HOST'];
//     $user = $_ENV['DB_USER'];
//     $password = $_ENV['DB_PASSWORD'];
//     $database = $_ENV['DATABASE'];

//     $connect = mysqli_connect($host, $user, $password, $database);

//     if(!$connect){
//         print_r("Connection error: " .   mysqli_connect_error() );
//     }else{
//         echo("Connection successful");
//     }
// } catch (\Throwable $th) {
//     print_r("error" . $th);
// }
?>