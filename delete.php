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

// Получаем ID товара из параметра запроса
$person_id = $_GET['id'];

// Запрос на удаление товара с использованием подготовленного запроса
$delete_sql = "DELETE FROM private_person WHERE id=?";

$stmt = $conn->prepare($delete_sql);
if (!$stmt) {
    die("Ошибка подготовки запроса: " . $conn->error);
}

$stmt->bind_param("i", $person_id);

if ($stmt->execute()) {
    echo "Данные успешно удалены.";
    // Перенаправляем пользователя на страницу со списком товаров через секунду
    echo '<script>
            setTimeout(function() {
                window.location.href = "admin.php";
            }, 1000);
          </script>';
} else {
    echo "Ошибка при удалении данных: " . $stmt->error;
    // Перенаправляем пользователя на страницу admin.php через секунду
    echo '<script>
            setTimeout(function() {
                window.location.href = "admin.php";
            }, 1000);
          </script>';
}

// Закрываем подготовленный запрос и соединение
$stmt->close();
$conn->close();
?>
