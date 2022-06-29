
<?php
require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);

$newQuoteText = $_POST['new__quote--text'];
    $newQuoteAuthor = $_POST['new__quote--author'];
    $id = $_POST['id'];

try {
    $connect = new mysqli($host, $db_user, $db_password, $db_name);


    if($connect->connect_errno!=0) {
        throw new Exception(mysqli_connect_errno());
    } else {

        $connect->query("UPDATE myQuotes SET quote='$newQuoteText', author='$newQuoteAuthor' WHERE id='$id'");

        header('Location: quotes.php');

        $connect->close();
    }

}
catch(Exception $e) {
    echo '<span style="color: red;">Bład serwera! Przpraszamy za niedogodności, spróbuj ponownie później.</span>';
    echo '<br />Informacja deweloperska: '.$e;
}


?>