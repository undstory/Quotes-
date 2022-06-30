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
        $_SESSION['e_nickname']="Nazwa użytkownika może składać się tylko z liter i cyfr (bez polskich znaków)";
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Righteous&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles/css/style.css">
    <title>Quotes</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


</head>
<body>
<div class="main-container">
        <main class="container">
            <div class="intro">
                <h2 class="intro__title"><a href="index.php">Hello Quotes</a></h2>
                <form class="register__form" method="post">
                    <input class="intro__input register__input--nick" type="text" name="nickname" placeholder="Nazwa użytkownika" />
                        <?php
                        if(isset($_SESSION['e_nickname'])) {
                            echo '<div class="register__error register__input--nickE">'.$_SESSION['e_nickname'].'</div>';
                            unset($_SESSION['e_nickname']);
                        }
                        ?>
                    <input class="intro__input register__input--email" type="text" name="email" placeholder="Email" />
                        <?php
                            if(isset($_SESSION['e_email'])) {
                                echo '<div class="register__error register__input--emailE">'.$_SESSION['e_email'].'</div>';
                                unset($_SESSION['e_email']);
                            }
                            ?>

                    <input class="intro__input register__input--pass1" type="password" name="password1" placeholder="Hasło" /><br />

                        <?php
                        if(isset($_SESSION['e_password'])) {
                            echo '<div class="register__error register__input--passE">'.$_SESSION['e_password'].'</div>';
                            unset($_SESSION['e_password']);
                        }
                        ?>
                    <input class="intro__input register__input--pass2"  type="password" name="password2" placeholder="Powtórz hasło" /><br />
                    <label class="register__input--check" ><input class="register__checkbox" type="checkbox" name="regimen" />Akceptuję regulamin</label>
                        <?php
                        if(isset($_SESSION['e_regimen'])) {
                            echo '<div class="register__error register__input--checkE">'.$_SESSION['e_regimen'].'</div>';
                            unset($_SESSION['e_regimen']);
                        }
                        ?>

                    <button class="intro__button register__input--button" type="submit">Zarejestruj się</button>
                </form>
            </div>
            <footer class="footer">Design&develope by undstory</footer>
        </main>
</div>

</body>
</html>