<?php
$servername = "127.0.0.1";
$username = "root"; 
$password = "root"; 
$dbname = "phonebook"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    $phone = $_POST["phone"];
    $lastName = $_POST["last_name"];
    $firstName = $_POST["first_name"];
    $patronymic = $_POST["patronymic"];

    $sql = "INSERT INTO private_person (phone_number, last_name, first_name, patronymic) 
            VALUES ('$phone', '$lastName', '$firstName', '$patronymic')";

    if ($conn->query($sql) === TRUE) {
        // Перенаправляем на admin.php перед отправкой любых данных в поток вывода
        header("Location: admin.php");
        exit; // Важно завершить выполнение скрипта после перенаправления
        
        echo "Запись успешно добавлена."; // Теперь это не вызовет проблем
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить частное лицо</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Добавить частное лицо</h1>
        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">Телефон:</label>
                <input type="text" name="phone" class="form-control" required pattern="^[0-9+]+$" title="Введите номер телефона (цифры и символ +)">
            </div>
            <div class="mb-3">
                <label class="form-label">Фамилия:</label>
                <input type="text" name="last_name" class="form-control" required pattern="^[A-Za-zА-Яа-яЁё]+$" title="Фамилия должна содержать только буквы (русские или английские)">
            </div>
            <div class="mb-3">
                <label class="form-label">Имя:</label>
                <input type="text" name="first_name" class="form-control" required pattern="^[A-Za-zА-Яа-яЁё]+$" title="Имя должно содержать только буквы (русские или английские)">
            </div>
            <div class="mb-3">
                <label class="form-label">Отчество:</label>
                <input type="text" name="patronymic" class="form-control" pattern="^[A-Za-zА-Яа-яЁё]+$" title="Отчество должно содержать только буквы (русские или английские)">
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
            <a href="javascript:history.back()" class="btn btn-secondary">Отменить</a>
        </form>
    </div>
</body>
</html>

