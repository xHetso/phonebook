<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title>Телефонный справочник 2023</title>
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

        h4 {
            margin-top: 20px;
        }

        form {
            margin-top: 10px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
        }
        form button {
            display: block;
            margin-top: 5px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
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


    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }
    
    .modal-content {
      background-color: #fefefe;
      margin: 10% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 420px;
      border-radius: 30px;
      max-height: 801px;
    }
    
    .close {
      color: #aaa;
      float: right;
      font-size: 60px;
      font-weight: bold;
      position: absolute;
      cursor: pointer;
      right: 25px;
      top: 2px;
    }
    
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
    }
    
    form {
      display: flex;
      flex-direction: column;
    }
    
    label {
      margin-bottom: 5px;
    }
    
    input,
    select {
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    
    .buttons {
      display: flex;
      justify-content: center; /* Выравнивание по центру */
    }
    
    input[type="submit"] {
      padding: 25px 60px;
      background-color: #007bff;
      
      color:white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-bottom: 0px;
      margin-top: 15px;
    }
    input[type="submit"]:hover {
      background-color: #0d66c5;
    }

    </style>
</head>
<body>
    
    <header>
        <div class="container header">
            <h3 class="logo">Телефонный справочник</h3>
            <button class="header_button" id="showFormButton">Admin</button>
        </div>
    </header>
    <div id="modal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h1 class="text-center">Вход</h1>
            <form id="loginForm" action="login.php" method="POST">
              <label for="login">Имя пользователя:</label>
              <input type="text" id="login" name="login" placeholder="Логин" required>
                      
              <label for="password">Пароль пользователя:</label>
              <input type="password" id="password" name="password" placeholder="Пароль" required>
                    
              <div class="buttons">
                  <input type="submit" value="Войти">
              </div>
            </form>
        </div>
    </div>
  <div class="container">
    <select name="user_profile_products_1" onchange="updateProducts()">
        <option value="">Поиск частных лиц и предприятий</option>
        <option value="organization_sort">Поиск организаций</option>
    </select>
    <div class="row">
        <div class="col-md-6" id="individualSearchForm">
            <h4>Поиск частного лица или частной организации:</h4>
            <form action="search.php" method="post" id="searchForm">
                <label for="phone">Номер телефона</label>
                <input type="tel" id="phone" name="phone">
        
                <label for="last-name">Фамилия</label>
                <input type="text" id="last-name" name="last-name">
        
                <label for="first-name">Имя</label>
                <input type="text" id="first-name" name="first-name">
        
                <label for="middle-name">Отчество</label>
                <input type="text" id="middle-name" name="middle-name">
                <button type="submit">Поиск</button>
            </form>
        </div>
        <div class="col-md-6" id="organizationSearchForm" style="display: none;">
            <h4>Поиск организации:</h4>
            <form action="search2.php" method="post" id="searchForm2">
                <label for="org-phone">Номер телефона</label>
                <input type="tel" id="org-phone" name="org-phone">

                <label for="org-name">Название организации</label>
                <input type="text" id="org-name" name="org-name">

                <label for="department">Название отдела</label>
                <input type="text" id="department" name="department">

                <label for="country">Страна</label>
                <input type="text" id="country" name="country">

                <label for="city">Город</label>
                <input type="text" id="city" name="city">

                <label for="street">Улица</label>
                <input type="text" id="street" name="street">

                <label for="house">Дом</label>
                <input type="text" id="house" name="house">

                <label for="apartment">Квартира</label>
                <input type="text" id="apartment" name="apartment">
                <button type="submit">Поиск</button>
              </form>
          </div>
      </div>
        <div id="search-results">
        <!-- Здесь будут отображаться результаты -->
        </div>
  </div>
  
    <script>
      function updateProducts() {
          var selectedValue = document.getElementsByName("user_profile_products_1")[0].value;
          var individualForm = document.getElementById("individualSearchForm");
          var organizationForm = document.getElementById("organizationSearchForm");
          
          if (selectedValue === "organization_sort") {
              individualForm.style.display = "none";
              organizationForm.style.display = "block";
          } else {
              individualForm.style.display = "block";
              organizationForm.style.display = "none";
          }
      }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var showFormButton = document.getElementById("showFormButton");
        var modal = document.getElementById("modal");
        var closeBtn = document.getElementsByClassName("close")[0];
        var form = document.querySelector("form");

        showFormButton.addEventListener("click", function() {
            modal.style.display = "block";
        });

        closeBtn.addEventListener("click", function() {
            modal.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });

        $('#searchForm').submit(function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'search.php', // Укажите путь к вашему PHP файлу
                data: $('form').serialize(),
                success: function(response){
                    $('#search-results').html(response); // Элемент, в который будет вставлена таблица с результатами
                }
            });
        });

        $('#searchForm2').submit(function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'search2.php', // Укажите путь к вашему PHP файлу
                data: $('form').serialize(),
                success: function(response){
                    $('#search-results').html(response); // Элемент, в который будет вставлена таблица с результатами
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function(){
        var showFormButton = document.getElementById("showFormButton");
        var modal = document.getElementById("modal");
        var closeBtn = document.getElementsByClassName("close")[0];
        var form = document.querySelector("form");

        showFormButton.addEventListener("click", function() {
            // Отправляем AJAX-запрос на сервер для проверки статуса пользователя
            $.ajax({
                type: 'GET',
                url: 'check_admin.php', // Создайте файл check_admin.php для проверки администраторского статуса
                success: function(response){
                    if (response === "admin") {
                        // Если пользователь администратор, перейдите на admin.php
                        window.location.href = 'admin.php';
                    } else {
                        // Если пользователь не администратор, отобразите модальное окно
                        modal.style.display = "block";
                    }
                }
            });
        });

        closeBtn.addEventListener("click", function() {
            modal.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });

        // Другие обработчики событий и код
    });
</script>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>
