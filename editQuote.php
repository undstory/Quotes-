<?php

require_once "connect.php";


    $connect = new mysqli($host, $db_user, $db_password, $db_name);

        $id = $_REQUEST['id'];

        $result = $connect->query("SELECT * FROM myQuotes WHERE id=$id");

      foreach ($result as $quote) {
        $editedQuote = $quote['quote'];
        $editedAuthor= $quote['author'];
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
<script
      src="https://kit.fontawesome.com/220bbdbf50.js"
      crossorigin="anonymous"
    ></script>
<link rel="stylesheet" href="styles/css/style.css">
    <title>Quotes</title>
    <style>
        .error {
            color: red;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
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
    <h3 class="quotes__subtitle">Edytuj cytat</h3>

<div class="insert__quote">
<ul class="quotes__btns">
        <li><a class="quotes__link" href="quotes.php">Wróć do strony glównej</a></li>
    </ul>

    <form  class="add__form" action="edited.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />

    <label for="new__quote--text">Edytuj treść cytatu</label>
    <textarea class="add__textarea" id="new__quote--text" name="new__quote--text" rows="10"
>
<?php echo $editedQuote; ?>
    </textarea>



    <input class="add__input" id="new__quote--author" name="new__quote--author"
value="<?php echo $editedAuthor; ?>"
    />

    <br />
    <input class="add__button" type="submit" value="Zmień" />
    </form>
</div>
    </main>
    </div>
</body>
</html>
<!--
<?php


  // if (isset($_POST['submit']))
  //       {

  //         $quote = $_POST['new__quote--text'];
  //         $author = $_POST['new__quote--author'];
  //           $id = $_POST['id'];


  //         $query = "UPDATE myQuotes SET quote='$quote', author='$author' WHERE id='$id'";
  //         $data = mysqli_query($connect,$query);
  //         if ($data) {
  //           echo "It works";

  //         } else {
  //           echo "Error";
  //         }
  //       }

?> -->



