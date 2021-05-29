<?php
session_start();
require "function.php";

$email = $_POST["email"];
$password = $_POST["password"];

// $email = "daanas@mail.com";
// $password = "1234";

//соединяемся с БД он прописан function.php
$user = get_user_by_email($email);


//теперь проверить пусто или нет
if(!empty($user)){
    set_flash_message("danger", "Этот эл.адрес уже занят другим пользователем.");
    redirect_to("page_register.php");
}

add_user($email, $password);

set_flash_message("success", "Регистрация успешна");
redirect_to("/page_login.php");
 

