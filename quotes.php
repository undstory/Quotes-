<?php

session_start();
if(!isset($_SESSION['logged'])){
    header('Location: index.php');
    exit();
}

if(isset($_GET['addQuotes'])){
    include 'form.php';
    exit();
}

if(isset($_GET['allQuotes'])){
    include 'allQuotes.php';
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="scripts.js" defer async></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Righteous&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles/css/style.css">
    <title>Quotes</title>
</head>
<body>
<div class="quotes__container">
<main class="container quotes__container--img">
    <nav class="quotes__nav">
        <h2 class="intro__title">Hello Quotes</a></h2>
        <span>
            <?php

            echo "<p>Witaj ".$_SESSION['user'].'! <a href="logout.php" class="quotes__logout">Wyloguj się!</a></p>';
        ?>
        </span>
    </nav>
    <h3 class="quotes__subtitle">Co chcesz zrobić?</h3>
    <ul class="quotes__btns">
        <li><a class="quotes__link" href="?allQuotes">Pokaż bazę cytatów</a></li>
        <li><a class="quotes__link" href="?addQuotes">Dodaj nowy cytat do bazy</a></li>
    </ul>
    <div class="random__quote">
        <p class="random__quote--text"></p>
        <p class="random__quote--author"></p>
    </div>
    <footer class="footer">Design&develope by undstory</footer>
</main>
</div>
</body>
</html>