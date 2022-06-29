<?php
session_start();

if((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) {
    header('Location: quotes.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Righteous&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles/css/style.css">
    <title>Quotes</title>
</head>
<body>
    <div class="main-container">
        <main class="container">
            <div class="intro">
                <h2 class="intro__title">Hello Quotes</h2>

                    <form class="intro__form" action="login.php" method="post">

                        <input class="intro__input"type="text" name="login" placeholder="Nazwa użytkownika" />

                        <input class="intro__input" type="password" name="password" placeholder="Hasło" />
                        <button class="intro__button" type="submit">Zaloguj się</button>

                    </form>
                    <?php

    if(isset($_SESSION['error'])){
        echo '<div class="error">'.$_SESSION['error'].'</div>';
        unset($_SESSION['error']);
    }
    ?>
                        <p>Jeśli nie masz konta - <a href="registration.php" class="intro__register">zarejestruj się</a><p/>
            </div>

        </main>

    </div>




</body>
</html>