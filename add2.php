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
    $orgName = $_POST["organization_name"];
    $deptName = $_POST["department_name"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $street = $_POST["street"];
    $house = $_POST["house_number"];
    $apartment = $_POST["apartment_number"];

    // Используем подготовленный запрос
    $sql = "INSERT INTO organization (phone_number, organization_name, department_name, country, city, street, house_number, apartment_number) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Привязываем параметры к значениям
        $stmt->bind_param("ssssssss", $phone, $orgName, $deptName, $country, $city, $street, $house, $apartment);
        
        if ($stmt->execute()) {
            // Перенаправляем на admin.php перед отправкой любых данных в поток вывода
            header("Location: admin.php");
            exit;
        } else {
            echo "Ошибка выполнения запроса: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Ошибка подготовки запроса: " . $conn->error;
    }

    $conn->close();
}
?>

<!-- Форма для добавления организации -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить организацию</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Добавить организацию</h1>
        <form method="post">
        <div class="mb-3">
            <label class="form-label">Телефон:</label>
            <input type="text" name="phone" pattern="^[0-9+]+$" title="Введите номер телефона (цифры и символ +)" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Организация:</label>
            <input type="text" name="organization_name" pattern="^[A-Za-zА-Яа-яЁё]+$" title="Фамилия должна содержать только буквы (русские или английские)" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Департамент:</label>
            <input type="text" name="department_name" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Страна:</label>
            <input type="text" name="country" required pattern="^[A-Za-zА-Яа-яЁё]+$" title="Страна должна содержать только буквы (русские или английские)" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Город:</label>
            <input type="text" name="city" required pattern="^[A-Za-zА-Яа-яЁё]+$" title="Город должен содержать только буквы (русские или английские)" class="form-control">
        </div>
        <!-- Остальные поля без атрибута required -->
        <div class="mb-3">
            <label class="form-label">Улица:</label>
            <input type="text" required pattern="^[A-Za-zА-Яа-яЁё]+$" title="Улица должна содержать только буквы (русские или английские)" name="street" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Дом:</label>
            <input type="text" name="house_number" class="form-control" pattern="[0-9]*">
        </div>
        <div class="mb-3">
            <label class="form-label">Квартира:</label>
            <input type="text" name="apartment_number" class="form-control" pattern="[0-9]*">
        </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
            <a href="javascript:history.back()" class="btn btn-secondary">Отменить</a>
        </form>
    </div>
</body>
</html>

