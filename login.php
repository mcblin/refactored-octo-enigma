<?php
session_start();

$servername = 'localhost';
$username_db = 'root';
$password_db = 'mysql';
$dbname = 'mysite';

$conn = mysqli_connect($servername, $username_db, $password_db, $dbname);

$username = $_POST['username'];
$password = $_POST['password'];

if(empty($username) || empty($password)) {
    echo "<script>alert('Заполните все поля');</script>";
} else {
    $sql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $role = $row['role'];

            if (password_verify($password, $row['password'])) {
                // Успешная аутентификация, устанавливаем сессию
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                // Перенаправляем на соответствующую страницу в зависимости от роли
                if ($role === 'teacher') {
                    header("Location: request.php?username=$username");
                    exit();
                } elseif ($role === 'terminal') {
                    header("Location: terminal.php");
                    exit();
                } else {
                    echo "<script>alert('Неизвестная роль! Свяжитесь с администратором.');</script>";
                }
            } else {
                echo "<script>alert('Неправильный пароль');</script>";
            }
        }
    } else {
        echo "<script>alert('Данный пользователь не зарегистрирован!');</script>";
    }
}
?>
