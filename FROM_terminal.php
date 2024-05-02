<?php
// Подключаемся к базе данных
$servername = "localhost"; // Имя сервера
$username = "root"; // Имя пользователя
$password = "mysql"; // Пароль
$dbname = "mysite"; // Имя базы данных

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Обработка редактирования комментария
if (isset($_POST['update_commentary'])) {
    $commentary_id = $_POST['commentary_id'];
    $new_commentary = $_POST['new_commentary'];

    $sql_update = "UPDATE terminal_output SET commentary='$new_commentary' WHERE id='$commentary_id'";
    if ($conn->query($sql_update) === TRUE) {
        echo "Комментарий успешно обновлен.";
    } else {
        echo "Ошибка при обновлении комментария: " . $conn->error;
    }
}

// Выполняем запрос к базе данных
$sql = "SELECT id, data, sender, Zst, Ost, Ovzs, Sb, DZst, DOst, MB, Nov, Om, Sc, Zm, commentary FROM terminal_output";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Выводим данные каждой строки
while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>". $row["data"]. "</td><td>" . $row["sender"]. "</td><td>" . $row["Zst"]. "</td><td>". $row["Ost"]. "</td><td>". $row["Ovzs"]. "</td><td>". $row["Sb"]. "</td><td>". $row["DZst"]. "</td><td>". $row["DOst"]. "</td><td>". $row["MB"]. "</td><td>". $row["Nov"]. "</td><td>". $row["Om"]. "</td><td>". $row["Sc"]. "</td><td>". $row["Zm"]. "</td><td>";

    // Форма для редактирования комментария
    echo "<form method='post' action='terminal.php'>";
    echo "<input type='hidden' name='commentary_id' value='" . $row['id'] . "'>";
    echo "<input type='text' class='comment-input' name='new_commentary' value='" . $row['commentary'] . "'>";
    echo "<input type='submit' style='display:none' class='save-button' name='update_commentary' value='Сохранить'>";
    echo "</form>";

    echo "</td></tr>";
}

} else {
    echo "0 результатов";
}

$conn->close();
?>
