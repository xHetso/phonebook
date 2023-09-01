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

$jwt_secret = 'arukam'; // Секретный ключ, должен быть таким же, как и при создании токена

if (isset($_COOKIE['jwt'])) {
    $jwt = $_COOKIE['jwt'];

    try {
        $decoded = JWT::decode($jwt, $jwt_secret, array('HS256'));
        $user_id = $decoded->user_id;
        // Дополнительные данные из токена, если необходимо

        // Теперь у вас есть $user_id, который можно использовать для запроса к базе данных
        // и проверки, является ли пользователь админом

        // Пример запроса к базе данных для получения информации о пользователе
        $query = "SELECT is_admin FROM users WHERE id = '$user_id'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $user = mysqli_fetch_assoc($result);
            if ($user['is_admin'] == 1) {
                // Пользователь - админ, показываем содержимое админской страницы
            } else {
                echo "Вы не являетесь администратором.";
                // Можно также перенаправить на другую страницу или скрыть контент
            }
        } else {
            echo "Ошибка при выполнении запроса: " . mysqli_error($connection);
        }

    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage();
    }
} else {
    echo "Доступ запрещен. Пожалуйста, авторизуйтесь.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Административная панель</title>
    <!-- Подключение библиотеки Iconify для иконок -->
    <script src="https://code.iconify.design/2/2.0.4/iconify.min.js"></script>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</head>
<body>
    <header class="mb-3">
        <div class="container header">
            <h3 class="logo">Телефонный справочник</h3>
            <button id="mainButton" class="header_button">Главная страница</button>
        </div>
        <script>
            document.getElementById("mainButton").addEventListener("click", function() {
            window.location.href = "index.php";
            });
        </script>
    </header>
    <div class="container">
        <select name="user_profile_products_1" onchange="updateProducts()">
            <option value="">Список частных лиц и предприятий</option>
            <option value="organization_sort">Организация</option>
        </select>
        <div id="privatePersonsTable" style="display: block;">
            <h1>Список частных лиц и частных предприятий</h1>
            <button class="btn btn-primary mb-3"  onclick="location.href='add.php'">Добавить частное лицо</button>
            <?php
                $servername = "127.0.0.1";
                $username = "root"; 
                $password = "root"; 
                $dbname = "phonebook"; 

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Ошибка подключения: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM private_person";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table'>
                            <thead>
                                <tr>
                                    <th><a href='#' class='sort-link' data-column='id'>id</a></th>
                                    <th><a href='#' class='sort-link' data-column='phone_number'>Телефон</a></th>
                                    <th><a href='#' class='sort-link' data-column='last_name'>Фамилия</a></th>
                                    <th><a href='#' class='sort-link' data-column='first_name'>Имя</a></th>
                                    <th><a href='#' class='sort-link' data-column='patronymic'>Отчество</a></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td data-column='id'>" . $row["id"] ."</td>
                                <td data-column='phone_number'>" . $row["phone_number"] . "</td>
                                <td data-column='last_name'>" . $row["last_name"] . "</td>
                                <td data-column='first_name'>" . $row["first_name"] . "</td>
                                <td data-column='patronymic'>" . $row["patronymic"] . "</td>
                                <td>
                                    <a href='edit.php?id=" . $row["id"] . "'><span class='iconify' data-icon='ic:baseline-edit' data-inline='false'></span></a>
                                    <a href='delete.php?id=" . $row["id"] . "'><span class='iconify' data-icon='ic:baseline-delete' data-inline='false'></span></a>
                                </td>
                            </tr>";
                    }

                    echo "</tbody></table>";
                } else {
                    echo "Нет данных в таблице.";
                }

                $conn->close();
                ?>
            
        </div>
        <div id="organizationsTable" style="display: none;">
            <h1>Список организаций</h1>
            <button class="btn btn-primary mb-3" onclick="location.href='add2.php'">Добавить организацию</button>
            <?php
                $servername = "127.0.0.1";
                $username = "root"; 
                $password = "root"; 
                $dbname = "phonebook"; 

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Ошибка подключения: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM organization";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table'>
                            <thead>
                                <tr>
                                    <th> <a href='#' class='sort-link2' data-column='id2'> id</th>
                                    <th> <a href='#' class='sort-link2' data-column='phone_number2'> Телефон</th>
                                    <th> <a href='#' class='sort-link2' data-column='organization'>Организация</th>
                                    <th> <a href='#' class='sort-link2' data-column='department'>Департамент</th>
                                    <th> <a href='#' class='sort-link2' data-column='country'>Страна</th>
                                    <th> <a href='#' class='sort-link2' data-column='city'>Город</th>
                                    <th> <a href='#' class='sort-link2' data-column='street'>Улица</th>
                                    <th> <a href='#' class='sort-link2' data-column='house_number'>Дом</th>
                                    <th> <a href='#' class='sort-link2' data-column='apartment_number'>Квартира</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td data-column='id2'>" . $row["id"] ."</td>
                                <td data-column='phone_number2'>" . $row["phone_number"] . "</td>
                                <td data-column='organization'>" . $row["organization_name"] . "</td>
                                <td data-column='department'>" . $row["department_name"] . "</td>
                                <td data-column='country'>" . $row["country"] . "</td>
                                <td data-column='city'>" . $row["city"] . "</td>
                                <td data-column='street'>" . $row["street"] . "</td>
                                <td data-column='house_number'>" . $row["house_number"] . "</td>
                                <td data-column='apartment_number'>" . $row["apartment_number"] . "</td>
                                <td>
                                    <a href='edit2.php?id=" . $row["id"] . "'><span class='iconify' data-icon='ic:baseline-edit' data-inline='false'></span></a>
                                    <a href='delete2.php?id=" . $row["id"] . "'><span class='iconify' data-icon='ic:baseline-delete' data-inline='false'></span></a>
                                </td>
                            </tr>";
                    }

                    echo "</tbody></table>";
                } else {
                    echo "Нет данных в таблице.";
                }

                $conn->close();
            ?>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const privateSortLinks = document.querySelectorAll(".sort-link");
                        const organizationSortLinks = document.querySelectorAll(".sort-link2");

                        privateSortLinks.forEach(link => {
                            link.addEventListener("click", function(event) {
                                event.preventDefault();
                                const column = this.getAttribute("data-column");
                                const currentSort = this.getAttribute("data-sort");
                                const newSort = currentSort === "asc" ? "desc" : "asc";
                                this.setAttribute("data-sort", newSort);
                                sortTable(column, newSort, "privatePersonsTable");
                            });
                        });

                        organizationSortLinks.forEach(link2 => {
                            link2.addEventListener("click", function(event) {
                                event.preventDefault();
                                const column2 = this.getAttribute("data-column");
                                const currentSort2 = this.getAttribute("data-sort");
                                const newSort2 = currentSort2 === "asc" ? "desc" : "asc";
                                this.setAttribute("data-sort", newSort2);
                                sortTable(column2, newSort2, "organizationsTable");
                            });
                        });

                        function sortTable(column, sortDirection, tableId) {
                            const table = document.getElementById(tableId).querySelector("table tbody");
                            const rows = Array.from(table.querySelectorAll("tr"));

                            rows.sort((rowA, rowB) => {
                                const cellA = rowA.querySelector(`td[data-column="${column}"]`).textContent.trim();
                                const cellB = rowB.querySelector(`td[data-column="${column}"]`).textContent.trim();

                                return sortDirection === "asc" ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
                            });

                            table.innerHTML = "";
                            rows.forEach(row => table.appendChild(row));
                        }
                    });
                </script>

            
        </div>
    </div>
    <script>
        function updateProducts() {
            var selectValue = document.querySelector("select[name=user_profile_products_1]").value;
            var privatePersonsTable = document.getElementById("privatePersonsTable");
            var organizationsTable = document.getElementById("organizationsTable");
            
            if (selectValue === "organization_sort") {
                privatePersonsTable.style.display = "none";
                organizationsTable.style.display = "block";
            } else {
                privatePersonsTable.style.display = "block";
                organizationsTable.style.display = "none";
            }
        }
    </script>

</body>
</html>

