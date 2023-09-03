<?php
$servername = "127.0.0.1"; // Имя сервера базы данных
$username = "root"; // Имя пользователя базы данных
$password = "root"; // Пароль пользователя базы данных
$dbname = "phonebook"; // Имя базы данных

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Ошибка соединения: " . $conn->connect_error);
}

$organization_id = $_GET['id'];

// Подготавливаем SQL-запрос с плейсхолдером
$delete_sql = "DELETE FROM organization WHERE id=?";

// Создаем подготовленное выражение
$stmt = $conn->prepare($delete_sql);

if ($stmt) {
    // Привязываем параметры
    $stmt->bind_param("i", $organization_id);

    // Выполняем подготовленный запрос
    if ($stmt->execute()) {
        echo "Данные успешно удалены.";
    } else {
        echo "Ошибка при удалении данных: " . $stmt->error;
    }

    // Закрываем подготовленное выражение
    $stmt->close();
} else {
    echo "Ошибка при подготовке запроса: " . $conn->error;
}

// Закрываем соединение
$conn->close();
?>
