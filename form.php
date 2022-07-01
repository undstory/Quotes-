<?php



if(isset($_POST['new__quote--text'])){
    $is_ok = true;

    $newQuoteText = $_POST['new__quote--text'];
    $newQuoteAuthor = $_POST['new__quote--author'];


    if((strlen($newQuoteText)<10) || (strlen($newQuoteText)>500)) {
        $is_ok = false;
        $_SESSION['e_newQuoteText']="Cytat nie może mieć mniej niż 10 i więcej niż 500 znaków";
    }
    if((strlen($newQuoteAuthor)<3) || (strlen($newQuoteAuthor)>30)) {
        $is_ok = false;
        $_SESSION['e_newQuoteAuthor']="Dane autora cytatu nie moga mieć mnież niż 3 i więcej niż 30 znaków";
    }

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $connect = new mysqli($host, $db_user, $db_password, $db_name);

        if($connect->connect_errno!=0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            if($is_ok== true) {
                if($connect->query("INSERT INTO myQuotes VALUES (NULL, '$newQuoteText', '$newQuoteAuthor')"))
                {
                     $_SESSION['successful'] = true;
                     header('Location: allQuotes.php');
                } else {
                    throw new Exception($connect->error);
                }
            }
            $connect->close();
        }
    }
    catch(Exception $e) {
        echo '<span style="color: red;">Bład serwera! Przpraszamy za niedogodności, spróbuj ponownie później.</span>';
        echo '<br />Informacja deweloperska: '.$e;
    }

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
<script
      src="https://kit.fontawesome.com/220bbdbf50.js"
      crossorigin="anonymous"
    ></script>
<link rel="stylesheet" href="styles/css/style.css">
    <title>Quotes</title>
</head>
<body>
<div class="quotes__container">
<main class="container">
    <nav class="quotes__nav">
        <h2 class="intro__title">Hello Quotes</a></h2>
        <span>
            <?php

            echo "<a href='logout.php' class='quotes__logout'>Wyloguj się!</a>";
        ?>
        </span>
    </nav>
    <h3 class="quotes__subtitle">Dodaj nowy cytat</h3>

    <ul class="quotes__btns">
        <li><a class="quotes__link" href="quotes.php">Wróć do strony glównej</a></li>
    </ul>
<div class="add__quote">

    <form  method="post" class="add__form">

        <textarea class="add__textarea" id="new__quote--text" name="new__quote--text" row="10" placeholder="Wpisz treść cytatu"></textarea>
    <?php
    if(isset($_SESSION['e_newQuoteText'])) {
        echo '<div class="error">'.$_SESSION['e_newQuoteText'].'</div>';
        unset($_SESSION['e_newQuoteText']);
    }
    ?>

    <input class="add__input" id="new__quote--author" name="new__quote--author" placeholder="Wpisz imię i nazwisko autora cytatu" />
    <?php
    if(isset($_SESSION['e_newQuoteAuthor'])) {
        echo '<div class="error">'.$_SESSION['e_newQuoteAuthor'].'</div>';
        unset($_SESSION['e_newQuoteAuthor']);
    }
    ?>
    <br />
    <input class="add__button" type="submit" value="Dodaj" />
    </form>
</div>
</main>
</div>
</body>
</html>