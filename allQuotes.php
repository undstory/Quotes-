<?php

require_once "connect.php";
// // mysqli_report(MYSQLI_REPORT_STRICT);
// $is_ok = false;


try {
    $connect = new mysqli($host, $db_user, $db_password, $db_name);


    if($connect->connect_errno!=0) {
        throw new Exception(mysqli_connect_errno());
    } else {

        $result = $connect->query("SELECT * FROM myQuotes");
        if(!$result) throw new Exception($connect->error);

        $how_these_quotes = $result->num_rows;


        if($how_these_quotes>0){
            // while ($row = $result->fetch_assoc()){
            //     $quotes[]=array('id'=>$row['id'], 'quote'=>$row['quote'], 'author'=>$row['author']);
            // }
            foreach ($result as $row) {
                $quotes[]=array('id'=>$row['id'], 'quote'=>$row['quote'], 'author'=>$row['author']);
            }
        } else {
            $_SESSION['e_empty']='Nie ma żadnych cytatów w bazie';
            $quotes=[];

        }
        $connect->close();
    }


}

catch(Exception $e) {
    echo '<span style="color: red;">Bład serwera! Przpraszamy za niedogodności, spróbuj ponownie później.</span>';
    echo '<br />Informacja deweloperska: '.$e;
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
    <h3 class="quotes__subtitle">Wszystkie cytaty</h3>
    <ul class="quotes__btns">
        <li><a class="quotes__link" href="quotes.php">Wróć do strony glównej</a></li>
        <li><a class="quotes__link" href="form.php">Dodaj nowy cytat</a></li>
    </ul>


    <?php
        if(isset($_SESSION['e_empty'])){
            echo '<div class="error">'.$_SESSION['e_empty'].'</div>';
            unset($_SESSION['e_empty']);
        }
    ?>

    <?php foreach ($quotes as $quote): ?>
        <div class="allQuotes__box">
            <form action="deleteQuote.php" method="post">
                <blockquote class="allQuotes__blockquote">
                    <p class="allQuotes__text"><?php echo htmlspecialchars($quote['quote'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="allQuotes__author"><?php echo htmlspecialchars($quote['author'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <input type="hidden" name="id" value="<?php echo $quote['id']; ?>" />
                    <div class="allQuotes__btns">
                        <a a class="allQuotes__btn" href="editQuote.php?id=<?php echo $quote['id']; ?>">Edytuj cytat</a>
                        <input a class="allQuotes__btn" type="submit" value="Usuń cytat" />
                    </div>
                </blockquote>
            </form>
        </div>
    <?php endforeach; ?>



  </main>

  </div>
</body>
</html>