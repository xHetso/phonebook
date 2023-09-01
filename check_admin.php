<?php
require 'vendor/autoload.php'; // Подключение библиотеки для JWT

use \Firebase\JWT\JWT;

// Проверяем наличие JWT в куки
if (isset($_COOKIE['jwt'])) {
    $jwt = $_COOKIE['jwt'];

    try {
        // Раскодируем JWT
        $decoded = JWT::decode($jwt, 'arukam', array('HS256'));

        // Проверяем, является ли пользователь администратором
        if ($decoded->is_admin == 1) {
            echo "admin";
        } else {
            echo "not_admin";
        }
    } catch (Exception $e) {
        // Обработка ошибки раскодирования JWT
        echo "error";
    }
} else {
    // Если JWT отсутствует в куки
    echo "not_admin";
}
?>
