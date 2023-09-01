<?php
require 'vendor/autoload.php'; // Подключение библиотеки для JWT

use \Firebase\JWT\JWT;

// Подключение к базе данных
$servername = "127.0.0.1";
$username = "root"; 
$password = "root"; 
$dbname = "phonebook"; 

// Создаем подключение к базе данных
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Проверяем соединение
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = mysqli_real_escape_string($connection, $_POST['login']); 
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE login = '$login'";
    $result = mysqli_query($connection, $query);
    
    if (!$result) {
        echo "Ошибка при выполнении запроса: " . mysqli_error($connection);
        exit();
    }

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Создаем JWT на основе логина и пароля
        $payload = array(
            "user_id" => $user['id'],
            // Другие поля по вашему усмотрению
        );

        $jwt = JWT::encode($payload, 'arukam'); 

        // Сохраняем JWT в куки
        setcookie("jwt", $jwt, time() + 36000, "/"); // Пример: срок действия 10 час

        if ($user['is_admin'] == 1) {
            header('Location: admin.php');
            exit();
        } else {
            echo "Вы успешно вошли, но вы не администратор.";
        }
    } else {
        echo "Неверный логин или пароль.";
    }

    mysqli_close($connection);
}
?>
