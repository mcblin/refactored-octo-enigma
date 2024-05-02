<!--регистрация юзера в ДБ

--><?php
/*
// Параметры для подключения к базе данных
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "mysite";

// Имя пользователя и пароль
$usernameToSet = "ter";
$passwordToSet = "qw";
$roleToSet = "terminal";

// Хешируем пароль
$hashedPassword = password_hash($passwordToSet, PASSWORD_DEFAULT);

// Подключаемся к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL-запрос для добавления пользователя с хешированным паролем в базу данных
$sql = "INSERT INTO users (username, password, role) VALUES ('$usernameToSet', '$hashedPassword', '$roleToSet')";

if ($conn->query($sql) === TRUE) {
    echo "Пользователь успешно добавлен";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

// Закрываем соединение
$conn->close();
*/?>
