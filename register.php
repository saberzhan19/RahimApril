<?php
session_start();

// $email = $_POST["email"];
// $password = $_POST["password"];

$email = "sam@mail.com";
$password = "1234";

//соединяемся с БД
$pdo = new PDO("mysql:host=localhost;dbname=rahimapril", "root", "root");

$sql = "SELECT * FROM users WHERE email=:email";

//защита от повторного записи ползователя в БД
$statement = $pdo->prepare($sql);
$statement->execute(["email" => $email ]);
$user = $statement->fetchAll(PDO::FETCH_ASSOC);

//теперь проверить пусто или нет
if(!empty($user)){
    $_SESSION["danger"] = "Этот эл. адрес уже занят другим пользователем.";
    header("Location: /page_register.php");//возращаем на страницу
    exit;
} else{

}

//подготавлеваем сам запрос
$sql = "INSERT INTO users(email, password) VALUES (:email, :password)";
 
//в пдо подготавлеваем запрос
$statement = $pdo->prepare($sql);
//выполнение запроса, где в массиве передаю значение
$statement->execute([
    "email" => $email,
    "password" => password_hash($password, PASSWORD_DEFAULT)//пароль шифруется в БД
]);

$_SESSION["success"] = "Регистрация успешна";
header("Location: /page_login.php");//возращаем на страницу
    exit;