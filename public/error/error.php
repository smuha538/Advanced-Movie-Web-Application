<?php
include "../header/header.php";

function populateError()
{
  if (empty($_GET["err"])) {
    echo "Invalid action";
  } else if ($_GET["err"] == "wrongArgNum") {
    echo "Wrong argument number.";
  } else if ($_GET["err"] == "noid") {
    echo "Please enter movie ID.";
  } else if ($_GET["err"] == "notInt") {
    echo "ID must be an integer.";
  } else if ($_GET["err"] == "notPos") {
    echo "ID must be bigger than 0";
  } else if ($_GET["err"] == "notInList") {
    echo "The movie ID is not in list";
  } else if ($_GET["err"] == "dupId") {
    echo "Please enter only 1 movie ID.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:400,500,600,700" />

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" crossorigin="anonymous" />

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" crossorigin="anonymous"></script>
  <script src="../header/sidenav.js"></script>
  <link rel="stylesheet" href="../CSSFolder/error.css">
  <title>Error Page</title>
</head>

<body>
  <?= createHeader2(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1, '../header/logo.png', 'black') ?>
  <div class="row"></div>
  <div class="row"></div>
  <div class="error container row white green lighten-1 center-align">
    <div class="col s8 l6 offset-s2 offset-l3 row">
      <img src="../images/error.png" alt="error" id="error" class="">
      <div class="">
        <h5><?= populateError() ?></h5>
      </div>
      <div class="row"></div>
      <a class="waves-effect waves-light btn light-blue darken-4" href="../index.php">Back to Homepage</a>
      <div class="row"></div>
      <div class="icons">
        <!-- https://www.flaticon.com/free-icons/error -->
        Error icons created by Freepik - Flaticon
      </div>
    </div>
  </div>
  <script src="../logoutpage/logout.js"></script>
</body>

</html>
