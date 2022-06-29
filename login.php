<?php
session_start();

if((!isset($_POST['login'])) || (!isset($_POST['password']))){
    header('Location: index.php');
    exit();
}

require_once "connect.php";

$connect = @new mysqli($host, $db_user, $db_password, $db_name);

if($connect->connect_errno!=0) {
    echo "Error: ".$connect->connect_errno;
} else {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");

    if($result = @$connect->query(sprintf("SELECT * FROM users WHERE username='%s'",
    mysqli_real_escape_string($connect, $login)))){
        $how_users = $result->num_rows;
        if($how_users>0){
            $row = $result->fetch_assoc();

            if(password_verify($password, $row['password'])){



            $_SESSION['logged'] = true;


            $_SESSION['id'] = $row['id'];
            $_SESSION['user'] = $row['username'];
            $_SESSION['email'] = $row['email'];

            unset($_SESSION['error']);
            $result->close();
            header('Location: quotes.php');

            }
            else {
                $_SESSION['error']='<span style="color: red">Nieprawidłowy login lub hasło</span>';
                header('Location: index.php');
            }

        } else {
            $_SESSION['error']='<span>Nieprawidłowy login lub hasło</span>';
            header('Location: index.php');
        }
    }

    $connect->close();
}




?>