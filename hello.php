<?php
session_start();

if((!isset($_SESSION['successful']))){
    header('Location: index.php');
    exit();
}
else {
    unset($_SESSION['successful']);
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
            <h2 class="intro__title">Hello Quotes</a></h2>
    <p class="intro__info">Dziękujemy za rejestrację w aplikacji!</p>
    <p class="intro__info">Zaloguj się na swoje konto</p>
    <form action="login.php" class="intro__form" method="post">
        <input class="intro__input" type="text" name="login" placeholder="Nazwa użytkownika" />
        <input class="intro__input" type="password" name="password" placeholder="Hasło" />
       <button class="intro__button" type="submit">Zaloguj się</button>
    </form>

<?php

if(isset($_SESSION['error'])){
    echo $_SESSION['error'];
}
?>
</div>
<footer class="footer">Design&develope by undstory</footer>
</main>
</div>
</body>
</html>