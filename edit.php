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
$person_id = $_GET['id'];

// Fetch person data based on ID
$sql = "SELECT * FROM private_person WHERE id = '$person_id'";
$result = $conn->query($sql);

// Check if data exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $phone_number = $row["phone_number"];
    $last_name = $row["last_name"];
    $first_name = $row["first_name"];
    $patronymic = $row["patronymic"];
} else {
    echo "Person not found.";
    exit;
}

// Update person data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_phone_number = $_POST["phone_number"];
    $new_last_name = $_POST["last_name"];
    $new_first_name = $_POST["first_name"];
    $new_patronymic = $_POST["patronymic"];

    // Update query
    $update_sql = "UPDATE private_person SET phone_number='$new_phone_number', last_name='$new_last_name', first_name='$new_first_name', patronymic='$new_patronymic' WHERE id='$person_id'";

    if ($conn->query($update_sql) === TRUE) {
        // Redirect after successful update
        header("Location: admin.php"); // Replace with your desired page
        exit;
    } else {
        echo "Error updating person data: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Person</title>
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
    <div class="container mt-5">
        <h1>Изменить данные</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $person_id); ?>">
            <div class="mb-3">
                <label for="phone_number" class="form-label">Номер:</label>
                <input type="text" class="form-control" name="phone_number" id="phone_number" value="<?php echo $phone_number; ?>" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Фамилия:</label>
                <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $last_name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">Имя:</label>
                <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $first_name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="patronymic" class="form-label">Отчество:</label>
                <input type="text" class="form-control" name="patronymic" id="patronymic" value="<?php echo $patronymic; ?>">
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
            window.location.href = 'delete.php?id=<?php echo $person_id; ?>'; // Замените на фактический URL вашего сценария удаления
        }
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
