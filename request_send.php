<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "mysite";

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получаем данные из формы
$sender = $_POST['sender'];
$Zst = $_POST['Zst'];
$Ost = $_POST['Ost'];
$Ovzs = $_POST['Ovzs'];
$Sb = $_POST['Sb'];
$DZst = $_POST['DZst'];
$DOst = $_POST['DOst'];
$MB = $_POST['MB'];
$Nov = $_POST['Nov'];
$Om = $_POST['Om'];
$Sc = $_POST['Sc'];
$Zm = $_POST['Zm'];


// Защита от SQL-инъекций (можно улучшить с использованием подготовленных запросов)
$sender = mysqli_real_escape_string($conn, $sender);
$Zst = mysqli_real_escape_string($conn, $Zst);
$Ost = mysqli_real_escape_string($conn, $Ost);
$Ovzs = mysqli_real_escape_string($conn, $Ovzs);
$Sb = mysqli_real_escape_string($conn, $Sb);
$DZst = mysqli_real_escape_string($conn, $DZst);
$DOst = mysqli_real_escape_string($conn, $DOst);
$MB = mysqli_real_escape_string($conn, $MB);
$Nov = mysqli_real_escape_string($conn, $Nov);
$Om = mysqli_real_escape_string($conn, $Om);
$Sc = mysqli_real_escape_string($conn, $Sc);
$Zm = mysqli_real_escape_string($conn, $Zm);


// SQL-запрос INSERT
$sql = "INSERT INTO terminal_output (data, sender, Zst, Ost, Ovzs, Sb, DZst, DOst, MB, Nov, Om, Sc, Zm) VALUES (NOW(), '$sender', '$Zst', '$Ost', '$Ovzs', '$Sb', '$DZst', '$DOst', '$MB', '$Nov', '$Om', '$Sc', '$Zm')";

// Отправляем запрос
$result = $conn->query($sql);

// Проверяем результат выполнения запроса
if ($result === TRUE) {
    // Перенаправляем пользователя на request_finish.php
    header("Location: request_finish.php");
    exit(); // Завершаем выполнение скрипта после перенаправления
} else {
    echo "Ошибка при добавлении данных: " . $conn->error;
}

// Закрываем соединение
$conn->close();
?>