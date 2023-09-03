<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phonebook Search Results</title>
    <!-- Подключение Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Результаты на ваш запрос</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Номер</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Подключение к базе данных
                $servername = "127.0.0.1";
                $username = "root"; 
                $password = "root"; 
                $dbname = "phonebook"; 

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $phone = $_POST['phone'];
                $lastName = $_POST['last-name'];
                $firstName = $_POST['first-name'];
                $middleName = $_POST['middle-name'];

                // Используйте подготовленные запросы
                $sql = "SELECT id, phone_number, last_name, first_name, patronymic FROM private_person WHERE phone_number = ? OR last_name = ? OR first_name = ? OR patronymic = ?";
                $stmt = $conn->prepare($sql);

                if ($stmt) {
                    $stmt->bind_param("ssss", $phone, $lastName, $firstName, $middleName);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["phone_number"] . "</td>";
                            echo "<td>" . $row["last_name"] . "</td>";
                            echo "<td>" . $row["first_name"] . "</td>";
                            echo "<td>" . $row["patronymic"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>0 результатов</td></tr>";
                    }

                    $stmt->close();
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <!-- Подключение Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>