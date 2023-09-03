<?php
$servername = "127.0.0.1"; // Database server name
$username = "root"; // Database username
$password = "root"; // Database password
$dbname = "phonebook"; // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get ID from query parameter
$organization_id = $_GET['id'];

// Prepare and execute a SELECT statement
$sql = "SELECT * FROM organization WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $organization_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if data exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $phone_number = $row["phone_number"];
    $organization_name = $row["organization_name"];
    $department_name = $row["department_name"];
    $country = $row["country"];
    $city = $row["city"];
    $street = $row["street"];
    $house_number = $row["house_number"];
    $apartment_number = $row["apartment_number"];
} else {
    echo "Organization not found.";
    exit;
}

// Update organization data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_phone_number = $_POST["phone_number"];
    $new_organization_name = $_POST["organization_name"];
    $new_department_name = $_POST["department_name"];
    $new_country = $_POST["country"];
    $new_city = $_POST["city"];
    $new_street = $_POST["street"];
    $new_house_number = $_POST["house_number"];
    $new_apartment_number = $_POST["apartment_number"];

    // Prepare and execute an UPDATE statement
    $update_sql = "UPDATE organization SET phone_number=?, organization_name=?, department_name=?, country=?, city=?, street=?, house_number=?, apartment_number=? WHERE id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssssssi", $new_phone_number, $new_organization_name, $new_department_name, $new_country, $new_city, $new_street, $new_house_number, $new_apartment_number, $organization_id);

    if ($stmt->execute()) {
        // Redirect after successful update
        header("Location: admin.php"); // Replace with your desired page
        exit;
    } else {
        echo "Error updating organization data: " . $stmt->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }
        header h5 {
            margin: 0;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }
        .header_button{
            display: block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 40px;
        }
        header{
            padding: 20px;
            
            background-color: black;
        }
        .header{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo{
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <div class="container header">
            <h3 class="logo">Телефонный справочник</h3>
            <button class="header_button" id="showFormButton">Главная страница</button>
        </div>
    </header>
    <!-- Header content here -->
    <div class="container mt-5">
        <h1>Редактировать данные организации</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $organization_id); ?>">
            <div class="mb-3">
                <label for="phone_number" class="form-label">Номер телефона:</label>
                <input type="text" class="form-control" name="phone_number" id="phone_number" value="<?php echo $phone_number; ?>" required>
            </div>
            <div class="mb-3">
                <label for="organization_name" class="form-label">Название отдела:</label>
                <input type="text" class="form-control" name="organization_name" id="organization_name" value="<?php echo $organization_name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="department_name" class="form-label">Название отдела:</label>
                <input type="text" class="form-control" name="department_name" id="department_name" value="<?php echo $department_name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Страна:</label>
                <input type="text" class="form-control" name="country" id="country" value="<?php echo $country; ?>" required>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">Город:</label>
                <input type="text" class="form-control" name="city" id="city" value="<?php echo $city; ?>" required>
            </div>
            <div class="mb-3">
                <label for="street" class="form-label">Улица:</label>
                <input type="text" class="form-control" name="street" id="street" value="<?php echo $street; ?>" required>
            </div>
            <div class="mb-3">
                <label for="house_number" class="form-label">Номер дома:</label>
                <input type="text" class="form-control" name="house_number" id="house_number" value="<?php echo $house_number; ?>" required>
            </div>
            <div class="mb-3">
                <label for="apartment_number" class="form-label">Номер квартиры:</label>
                <input type="text" class="form-control" name="apartment_number" id="apartment_number" value="<?php echo $apartment_number; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='admin.php'">Отмена</button>
            <button type="button" class="btn btn-danger" id="deleteButton">Удалить</button>
        </form>
    </div>
    <script>
    document.getElementById('deleteButton').addEventListener('click', function() {
        if (confirm('Вы уверены, что хотите удалить этого человека?')) {
            // Пользователь подтвердил, выполняем удаление
            window.location.href = 'delete2.php?id=<?php echo $organization_id; ?>'; // Замените на фактический URL вашего сценария удаления
        }
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
