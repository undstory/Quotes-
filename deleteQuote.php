

<?php
require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);

try {
    $connect = new mysqli($host, $db_user, $db_password, $db_name);


    if($connect->connect_errno!=0) {
        throw new Exception(mysqli_connect_errno());
    } else {
        $id = $_REQUEST['id'];
        $connect->query("DELETE FROM myQuotes WHERE id='".$id."'");

        header('Location: .');

        $connect->close();
    }

}
catch(Exception $e) {
    echo '<span style="color: red;">Bład serwera! Przpraszamy za niedogodności, spróbuj ponownie później.</span>';
    echo '<br />Informacja deweloperska: '.$e;
}


?>