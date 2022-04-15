<?php
include "../header/header.php";
require "./favouritehelper.php";
if (!isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] != 1) {
  header("Location: ../error/error.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="../header/sidenav.js"></script>
  <link rel="stylesheet" href="../CSSFolder/favourites.css">
  <title>Favourite Movies</title>
</head>

<body>
  <?= createHeader2(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1, '../header/logo.png', 'black') ?>

  <div class="container">
    <div class="row">
      <div class="col s12 center-align">
        <h1>Favourite Movies</h1>
      </div>
      <?= createFavouriteButton() ?>
      <?= createFavourites() ?>
    </div>
  </div>
  <script src="../logoutpage/logout.js"></script>
</body>

</html>
