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
    <title>Wszystkie cytaty</title>
</head>
<body>
    <h2>Wszytskie cytaty</h2>
    <a href="quotes.php">Wróć do strony glównej</a>
    <a href="form.php">Dodaj nowy cytat</a>
    <?php
        if(isset($_SESSION['e_empty'])){
            echo '<div class="error">'.$_SESSION['e_empty'].'</div>';
            unset($_SESSION['e_empty']);
        }
    ?>
    <?php

  foreach ($quotes as $quote): ?>
            <form action="deleteQuote.php" method="post">
                <blockquote>

                <p>
            <?php echo htmlspecialchars($quote['quote'], ENT_QUOTES, 'UTF-8'); ?>
            <?php echo htmlspecialchars($quote['author'], ENT_QUOTES, 'UTF-8'); ?>
            <input type="hidden" name="id" value="<?php echo $quote['id']; ?>" />
            <a href="editQuote.php?id=<?php echo $quote['id']; ?>">Edytuj cytat</a>
            <input type="submit" value="Usuń cytat" />
        </p>
                </blockquote>

            </form>


<?php endforeach; ?>
</body>
</html>