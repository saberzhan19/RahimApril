<?php 

function get_user_by_email( $email ){
    $pdo = new PDO("mysql:host=localhost;dbname=rahimapril", "root", "root");

    $sql = "SELECT * FROM users WHERE email=:email";

    //защита от повторного записи ползователя в БД
    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email ]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function set_flash_message($name, $message){
    $_SESSION["$name"] = $message;

}

function redirect_to($path){
    header("Location: {$path}");
    exit;
}

function add_user($email, $password){
    $pdo = new PDO("mysql:host=localhost;dbname=rahimapril", "root", "root");

    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";

    //защита от повторного записи ползователя в БД
    $statement = $pdo->prepare($sql);
    $result = $statement->execute([
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT)   
    ]);
    
    
    return $pdo->lastInsertId();
}

function display_flash_message($name) {
    if(isset($_SESSION[$name])){
        echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset($_SESSION[$name]);
    }
}
 