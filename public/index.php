<?php

include "./header/header.php";


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
  <script src="./header/sidenav.js"></script>
  <link rel="stylesheet" href="./CSSFolder/home.css">
  <title>Home</title>
</head>

<body>
  <?= createHeader2(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1, './header/logo.png', 'black') ?>
  <div class="row">
    <div class="col s12 l5">
      <div class="row">
        <div class="col s12">
          <div class="card green lighten-1">
            <div class="card-content white-text center">
              <span class="center"><img src='./header/logo.png' alt='Movie Browser Logo' height=50 width=50></span>
              <span class="card-title center" style="font-weight: 500; font-size: 2rem">Welcome to MoviEZ</span>

              <div class="row center" id="card-body" style="border-bottom: 5px solid black; margin-bottom: 10px">
                <div class="col s12">
                  <p style="font-size: larger;">Title to search:</p>

                  <!-- search bar -->
                  <div class="input-field col s12" style="border: 4px solid black; padding: 1rem 1rem; border-radius: 10px">
                    <input placeholder="Eg. Spiderman: No way home" id="searchbar" type="text" class="validate">
                    <label for="searchbar" class="white-text" id="searchbar_title"></label>
                    <span class="helper-text left-align white-text" style="display:none" id="searchBarHelper">Enter a Movie Title</span>
                  </div>
                  <!-- button -->
                  <div class="col s12 center" style="margin-bottom: 2rem;">
                    <button class="waves-effect waves-light btn-large deep-purple lighten-1 col s12" id="searchButton">Search</button>
                  </div>
                </div>
              </div>
              <?php
              if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1) {
                require "../partials/loggedinwelcome.php";
              } else {
                require "../partials/loggedouthome.php";
              }
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>
    <?php if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1) {
      require "../partials/loggedinhome.php";
    } ?>
  </div>
  <script src="./index.js"></script>
  <script src="./logoutpage/logout.js"></script>
</body>

</html>
