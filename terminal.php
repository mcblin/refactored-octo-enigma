<?php
session_start();

// Подключите библиотеку PHPSpreadsheet
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Функция для экспорта базы данных в XLS
function exportDBToXLS($mysqli) {
    // Создаем новый Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Запрос к базе данных
    $result = $mysqli->query("SELECT * FROM your_table");

    // Задаем заголовки
    $fields = $result->fetch_fields();
    foreach ($fields as $i => $field) {
        $sheet->setCellValueByColumnAndRow($i + 1, 1, $field->name);
    }

    // Заполняем данные
    $row = 2;
    while ($data = $result->fetch_assoc()) {
        $col = 1;
        foreach ($data as $value) {
            $sheet->setCellValueByColumnAndRow($col, $row, $value);
            $col++;
        }
        $row++;
    }

    // Сохраняем в файл
    $writer = new Xlsx($spreadsheet);
    $writer->save('database_export.xlsx');
}


// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Если пользователь не авторизован, перенаправляем на страницу входа или другую страницу
    header("Location: index.php");
    exit;
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


// Проверяем роль пользователя (это может быть необходимо в зависимости от вашей логики)
if ($_SESSION['role'] !== 'terminal') {
    // Если у пользователя нет прав доступа, перенаправляем на страницу с сообщением об ошибке или другую страницу
    header("Location: access_denied.php");
    exit;
}

// Далее идет содержимое страницы, доступное только авторизованным пользователям с ролью "teacher"
?>


<!DOCTYPE html>
<html lang="ru">
<head>ё
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Терминал</title>
    <link rel="stylesheet" href="css/terminal.css">
</head>
<header>
    <div class="header-container">
        <h2>Данные из базы данных</h2>
        <a href="?logout=true">Выход из аккаунта</a>
    </div>
</header>
<body>
<div class="container">
    <table>
        <thead>
        <tr>
            <th>№</th>
            <th>Дата и время отправки</th>
            <th>Класс</th>
            <th>Зст</th>
            <th>Ост</th>
            <th>Овзс</th>
            <th>Сб</th>
            <th>ДЗст</th>
            <th>ДОст</th>
            <th>МБ</th>
            <th>Нов</th>
            <th>Ом</th>
            <th>Сц</th>
            <th>Зм</th>
            <th>Комментарий</th>
        </tr>
        </thead>
        <tbody>
        <?php include 'FROM_terminal.php'; ?>
        </tbody>
    </table>
</div>
<footer>
    <div class="footer-container">
        <p>&copy; Создано Матвеем Белоноговым. Все права защищены.</p>
    </div>
</footer>

<script>
    // JavaScript для отслеживания ввода текста и отображения/скрытия кнопки "Сохранить"
    document.addEventListener('DOMContentLoaded', function() {
        let commentInputs = document.querySelectorAll('.comment-input');

        commentInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                let saveButton = this.parentNode.querySelector('.save-button');
                if (this.value.trim() !== '') {
                    saveButton.style.display = 'inline-block';
                } else {
                    saveButton.style.display = 'none';
                }
            });
        });
    });
</script>

</body>
</html>
