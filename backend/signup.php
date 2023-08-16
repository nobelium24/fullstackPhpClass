<?php 
    include ("CORSHeaders.php");
    CORS2();
    require ("./config/connect.php");
    $data = json_decode(file_get_contents("php://input"), true);

    $first_name = $data['firstName'];
    $last_name = $data['lastName'];
    $email = $data['email'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);

    //password_verify($data['password'], $dataBasePassword);

    try {
        $checkEmail = $connect->prepare("SELECT * FROM users WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $result = $checkEmail->get_result();
        $fetched = $result->fetch_all(MYSQLI_ASSOC);

    
        if(count($fetched) > 0){
            http_response_code(401);
            echo(json_encode(["Message"=>"Email already in use", "status"=>"false"]));
            exit;
        }
        
        $query = $connect->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ? , ?, ?)"); 
        $query->bind_param("ssss", $first_name, $last_name, $email, $password);
        $insert = $query->execute();
        if($insert){
            http_response_code(201);
            echo(json_encode(["message" => "Account created successfully", "status"=> true]));
        }else{
            http_response_code(400);
            echo(json_encode(["message" => "Error: " . $query->error, "status"=> false]));
        }

    } catch (\Throwable $error) {
        http_response_code(500);
        echo(json_encode(["message" => "Internal Server Error". $error, "status"=> false]));
    }
?>