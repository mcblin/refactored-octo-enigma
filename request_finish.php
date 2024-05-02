<?php
session_start(); // Начинаем или возобновляем сессию
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Finish</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .container {
            margin-top: 100px;
        }

        .countdown {
            font-size: 24px;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Заявка отправлена. Завершаем вашу сессию через <span id="countdown" class="countdown">3</span> <span id="word">секунд</span></h1>
</div>
<script>
    // Уменьшаем счетчик каждую секунду и перенаправляем на logout.php после завершения таймера
    var countdownElement = document.getElementById("countdown");
    var wordElement = document.getElementById("word");
    var countdown = 3;
    var countdownInterval = setInterval(function() {
        countdown--;
        countdownElement.textContent = countdown;
        if (countdown <= 0) {
            clearInterval(countdownInterval);
            // Перенаправляем пользователя на logout.php
            window.location.href = "logout.php";
        }
        // Склонение слова "секунда" в зависимости от значения таймера
        wordElement.textContent = getSecondsWord(countdown);
    }, 1000);

    // Функция для получения правильной формы слова "секунда" в зависимости от числа
    function getSecondsWord(count) {
        if (count >= 11 && count <= 14) {
            return 'секунд';
        } else {
            switch (count % 10) {
                case 1:
                    return 'секунду';
                case 2:
                case 3:
                case 4:
                    return 'секунды';
                default:
                    return 'секунд';
            }
        }
    }
</script>
</body>

</html>
