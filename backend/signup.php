<?php 
    include ("CORSHeaders.php");
    CORS2();
    require ("./config/connect.php");
    $data = json_decode(file_get_contents("php://input"), true);
    // print_r($data);


    $first_name = $data['firstName'];
    $last_name = $data['lastName'];
    $email = $data['email'];
    $password = $data['password'];
    
    $query = "INSERT INTO users(first_name, last_name, email, password) VALUES('$first_name', '$last_name', '$email', '$password')";
    if ($connect->query($query) === TRUE) {
        http_response_code(201);
        echo(json_encode(["message" => "User created successfully", "status"=> true]));
    }else{
        http_response_code(500);
        echo(json_encode(["message" => "Error: " . mysqli_error($connect), "status"=> false]));
    }
?>