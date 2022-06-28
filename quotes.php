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
    <title>Document</title>
</head>
<body>
    <h2>My quotes:</h2>

    <?php

    echo "<p>Witaj ".$_SESSION['user'].'! [<a href="logout.php">Wyloguj się!</a>]</p>';
    echo "<p>Twój email to ".$_SESSION['email']."</p>";
?>

<p>Co chcesz zrobić?</p>
<button type='button' class="api__btn">Pobierz randomowy cytat</button>
<a href="?allQuotes">Pokaż moją bazę cytatów różnych</a>
<a href="?addQuotes">Dodaj nowy cytat do mojej bazy</a>
<div class="random__quote">
<p class="random__quote--text"></p>
<p class="random__quote--author"></p>
</div>

</body>
</html>