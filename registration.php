<?php
session_start();

if(isset($_POST['email'])){

    $is_ok = true;

    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];



    if((strlen($nickname)<3) || (strlen($nickname)>20)) {
        $is_ok = false;
        $_SESSION['e_nickname']="Nickname musi posiadać od 3 do 20 znaków";
    }

    if(ctype_alnum($nickname) == false) {
        $is_ok = false;
        $_SESSION['e_nickname']="Nickname może składać się tylko z liter i cyfr (bez polskich znaków)";
    }

    if((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB!=$email)) {
        $is_ok = false;
        $_SESSION['e_email']="Podaj poprawny adres email";
    }

    if((strlen($password1)<8) || (strlen($password1)>20)) {
        $is_ok = false;
        $_SESSION['e_password']="Hasło musi posiadać od 8 do 20 znaków";
    }

    if($password1!=$password2) {
        $is_ok = false;
        $_SESSION['e_password']="Podane hasła nie są identyczne";
    }

    $password__hash = password_hash($password1, PASSWORD_DEFAULT);
    // echo $password__hash; exit();

    if(!isset($_POST['regimen'])) {
        $is_ok = false;
        $_SESSION['e_regimen']="Potwierdź akceptacje regulaminu";
    }

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $connect = new mysqli($host, $db_user, $db_password, $db_name);


        if($connect->connect_errno!=0) {
            throw new Exception(mysqli_connect_errno());
        } else {


            $result = $connect->query("SELECT id FROM users WHERE email='$email'");

            if(!$result) throw new Exception($connect->error);
            $how_these_mails = $result->num_rows;

            if($how_these_mails > 0) {
                $is_ok=false;
                $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu email";
            }

            $result = $connect->query("SELECT id FROM users WHERE username='$nickname'");

            if(!$result) throw new Exception($connect->error);
            $how_these_nicknames = $result->num_rows;

            if($how_these_nicknames> 0) {
                $is_ok=false;
                $_SESSION['e_nickname']="Istnieje już taki login w bazie. Wybierz inny.";
            }

            if($is_ok== true) {
                if($connect->query("INSERT INTO users VALUES (NULL, '$nickname', '$password__hash', '$email')"))
                {
                     $_SESSION['successful'] = true;
                     header('Location: hello.php');
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
    <title>Quotes</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        .error {
            color: red;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<form method="post">
    <label>Nick</label><input type="text" name="nickname" /><br />
    <?php
    if(isset($_SESSION['e_nickname'])) {
        echo '<div class="error">'.$_SESSION['e_nickname'].'</div>';
        unset($_SESSION['e_nickname']);
    }
    ?>
    <label>Email</label><input type="text" name="email" /><br />
<?php
    if(isset($_SESSION['e_email'])) {
        echo '<div class="error">'.$_SESSION['e_email'].'</div>';
        unset($_SESSION['e_email']);
    }
    ?>

    <label>Hasło</label><input type="password" name="password1" /><br />

    <?php
    if(isset($_SESSION['e_password'])) {
        echo '<div class="error">'.$_SESSION['e_password'].'</div>';
        unset($_SESSION['e_password']);
    }
    ?>
    <label>Powtórz hasło</label><input type="password" name="password2" /><br />
    <label><input type="checkbox" name="regimen" />Akceptuję regulamin</label>
    <?php
    if(isset($_SESSION['e_regimen'])) {
        echo '<div class="error">'.$_SESSION['e_regimen'].'</div>';
        unset($_SESSION['e_regimen']);
    }
    ?>

    <button type="submit">Zarejestruj się</button>
</form>

</body>
</html>