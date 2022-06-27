<?php


require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);

try {
    $connect = new mysqli($host, $db_user, $db_password, $db_name);


    if($connect->connect_errno!=0) {
        throw new Exception(mysqli_connect_errno());
    } else {
        $result = $connect->query("SELECT quote FROM myQuotes");
        while ($row = $result->fetch_assoc()){
            $quotes[] =$row['quote'];
        }
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

<?php foreach ($quotes as $quote): ?>
<p>
    <?php echo htmlspecialchars($quote, ENT_QUOTES, 'UTF-8'); ?>

</p>
<?php endforeach; ?>
</body>
</html>