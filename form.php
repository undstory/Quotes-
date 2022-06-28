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
                     header('Location: quotes.php');
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
    <title>Dodawanie cytatu</title>

    <style>
        .error {
            color: red;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="insert__quote">
<a href="quotes.php">Wróć do strony glównej</a>
    <form  method="post">
    <label for="new__quote--text">Wpisz treść cytatu</label>
    <textarea id="new__quote--text" name="new__quote--text" rows="3" cols="40"></textarea>
    <?php
    if(isset($_SESSION['e_newQuoteText'])) {
        echo '<div class="error">'.$_SESSION['e_newQuoteText'].'</div>';
        unset($_SESSION['e_newQuoteText']);
    }
    ?>
    <label for="new__quote--author">Wpisz imię i nazwisko autora cytatu</label>

    <input id="new__quote--author" name="new__quote--author" />
    <?php
    if(isset($_SESSION['e_newQuoteAuthor'])) {
        echo '<div class="error">'.$_SESSION['e_newQuoteAuthor'].'</div>';
        unset($_SESSION['e_newQuoteAuthor']);
    }
    ?>
    <br />
    <input type="submit" value="Dodaj" />
    </form>
</div>
</body>
</html>