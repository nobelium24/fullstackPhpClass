<?php
require("./config/connect.php");

require __DIR__ . "/vendor/autoload.php";

use Firebase\JWT\JWT;

$secret = "testRam24";

$email = "testtest4@gmail.com";
$password = "fish";



$payload = [
    'email' => $email,
    'expires' => time() + 86400,
    'secret' => $secret
];

$token2 = JWT::encode($payload, $secret, "HS512");
print_r($token2);


$query = "SELECT * FROM users WHERE email = '$email'";
$user = mysqli_query($connect, $query);
$user = mysqli_fetch_all($user, MYSQLI_ASSOC);
print_r($user);

$verify = password_verify($password, $user[0]['password']);
echo "<br>";
if ($verify) {
    echo 'Welcome';
} else {
    echo "Impostor";
}



function verifyJWT($token)
{
    global $jwt_secret;
    try {
        //Validate JWT format
        if (preg_match("/^[a-zA-Z0-9-_]+\.[a-zA-Z0-9-_]+\.[a-zA-Z0-9-_]*$/", $token)) {
            // $decoded_token = JWT::decode($token, $jwt_secret, array('HS512'));
            $decoded_token = json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $token)[1]))));
            return $decoded_token;
        } else {
            throw new Exception('Invalid token format');
        }

    } catch (Exception $e) {
        echo $e;
        return null;
    }
}
print_r(verifyJWT($token2));
?>