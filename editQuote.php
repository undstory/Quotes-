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
    <title>Edycja cytatu</title>

    <style>
        .error {
            color: red;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="insert__quote">
<a href="quotes.php">Wróć do strony glównej</a>
    <form  action="edited.php" method="post">
    <input type="text" name="id" value="<?php echo $id; ?>" />

    <label for="new__quote--text">Edytuj treść cytatu</label>
    <textarea id="new__quote--text" name="new__quote--text" rows="3" cols="40"
>
<?php echo $editedQuote; ?>
    </textarea>


    <label for="new__quote--author">Edytuj dane autora cytatu</label>

    <input id="new__quote--author" name="new__quote--author"
value="<?php echo $editedAuthor; ?>"
    />

    <br />
    <input type="submit" value="Zmień" />
    </form>
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



