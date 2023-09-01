<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization Search Results</title>
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
                    <th>Номер телефона</th>
                    <th>Название организации</th>
                    <th>Отдел</th>
                    <th>Страна</th>
                    <th>Город</th>
                    <th>Улица</th>
                    <th>Дом</th>
                    <th>Квартира</th>
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

                // Получаем данные из POST-запроса
                $phone = $_POST['org-phone'];
                $orgName = $_POST['org-name'];
                $deptName = $_POST['department'];
                $country = $_POST['country'];
                $city = $_POST['city'];
                $street = $_POST['street'];
                $houseNumber = $_POST['house'];
                $apartmentNumber = $_POST['apartment'];

                // Запрос к базе данных
                $sql = "SELECT * FROM organization WHERE 
                        phone_number = '$phone' OR 
                        organization_name = '$orgName' OR 
                        department_name = '$deptName' OR 
                        country = '$country' OR 
                        city = '$city' OR 
                        street = '$street' OR 
                        house_number = '$houseNumber' OR 
                        apartment_number = '$apartmentNumber'";
                
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["phone_number"] . "</td>";
                        echo "<td>" . $row["organization_name"] . "</td>";
                        echo "<td>" . $row["department_name"] . "</td>";
                        echo "<td>" . $row["country"] . "</td>";
                        echo "<td>" . $row["city"] . "</td>";
                        echo "<td>" . $row["street"] . "</td>";
                        echo "<td>" . $row["house_number"] . "</td>";
                        echo "<td>" . $row["apartment_number"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>0 результатов</td></tr>";
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
