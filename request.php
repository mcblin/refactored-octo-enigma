<?php
session_start();
// Получаем значение логина из параметров URL
if (isset($_GET['username'])) {
    $username = $_GET['username'];
}

// Функция для выхода из аккаунта
function logout()
{
    $_SESSION = array(); // Удаляем все переменные сессии
    session_destroy(); // Разрушаем сессию
    header("Location: index.php"); // Перенаправляем на страницу входа
    exit();
}

// Проверяем, был ли передан параметр "logout" в URL
if (isset($_GET['logout'])) {
    logout(); // Если да, вызываем функцию logout()
}

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Если пользователь не авторизован, перенаправляем на страницу входа или другую страницу
    header("Location: index.php");
    exit;
}

// Проверяем роль пользователя (это может быть необходимо в зависимости от вашей логики)
if ($_SESSION['role'] !== 'teacher') {
    // Если у пользователя нет прав доступа, перенаправляем на страницу с сообщением об ошибке или другую страницу
    header("Location: access_denied.php");
    exit;
}

// Далее идет содержимое страницы, доступное только авторизованным пользователям с ролью "teacher"


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание заявки</title>
    <link rel="stylesheet" href="css/request.css">
    <script src="js/request.js"></script>
</head>
<body>
<!-- Модальное окно -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modalText">Отправляем заявку?</p>
        <div id="foodList"></div> <!-- Добавленный блок -->
        <div>
            <button id="cancelButton">Отмена</button>
            <button id="confirmButton">Отправить</button>
        </div>
    </div>
</div>



<header>
    <div class="header-container">
        <h2>Создание заявки</h2>
        <a href="?logout=true">Выход из аккаунта</a>
    </div>
</header>

<form action="request_send.php" method="post">
    <!-- Добавляем скрытое поле для передачи логина -->
    <input type="hidden" name="sender" value="<?php echo isset($username) ? $username : ''; ?>">

    <label for="Zst">Завтрак "Школьника" 5-11 класс:</label>
    <input type="number" id="Zst" name="Zst" placeholder="Количество блюд" value="0">

    <label for="Ost">Обед "Школьника" 5-11 класс:</label>
    <input type="number" id="Ost" name="Ost" placeholder="Количество блюд" value="0">

    <label for="Ovzs">ОВЗ с 5-11 класс:</label>
    <input type="number" id="Ovzs" name="Ovzs" placeholder="Количество блюд" value="0">

    <label for="Sb">Субботний буфет:</label>
    <input type="number" id="Sb" name="Sb" placeholder="Количество блюд" value="0">

    <label for="DZst">Сахарный диабет Завтрак "Школьника" 5-11 класс:</label>
    <input type="number" id="DZst" name="DZst" placeholder="Количество блюд" value="0">

    <label for="DOst">Сахарный диабет Обед "Школьника" 5-11 класс:</label>
    <input type="number" id="DOst" name="DOst" placeholder="Количество блюд" value="0">

    <label for="MB">Мобилизованные:</label>
    <input type="number" id="MB" name="MB" placeholder="Количество блюд" value="0">

    <label for="Nov">Меню "Новинка":</label>
    <input type="number" id="Nov" name="Nov" placeholder="Количество блюд" value="0">

    <label for="Om">Школьный обед мини 5-11 класс:</label>
    <input type="number" id="Om" name="Om" placeholder="Количество блюд" value="0">

    <label for="Sc">Меню Социальное:</label>
    <input type="number" id="Sc" name="Sc" placeholder="Количество блюд" value="0">

    <label for="Zm">Школьный завтрак мини 5-11 класс:</label>
    <input type="number" id="Zm" name="Zm" placeholder="Количество блюд" value="0">

    <input type="submit" value="Добавить">
</form>

<footer>
    <div class="footer-container">
        <p>&copy; Создано Матвеем Белоноговым. Все права защищены.</p>
    </div>
</footer>

</body>
</html>