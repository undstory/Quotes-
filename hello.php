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
    <title>Quotes</title>
</head>
<body>

    <h2>HEllo Quotes</h2>
    <span>Dzięki za rejestrację w aplikacji!</span><br />>
    <span>Zaloguj się na swoje konto</span>
    <form action="login.php" method="post">
        <label>Login</label><input type="text" name="login" />
        <label>Password</label><input type="password" name="password" />
       <button type="submit">Login</button>
    </form>

<?php

if(isset($_SESSION['error'])){
    echo $_SESSION['error'];
}
?>

</body>
</html>