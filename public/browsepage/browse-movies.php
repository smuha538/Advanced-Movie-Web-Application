<?php
include "../header/header.php";

isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1 ? $logged = true : $logged = false;
$movie_ids = "";
if (isset($_SESSION["favourites"])) {
  $favourites = $_SESSION["favourites"];
  foreach ($favourites as $movie) {
    $movie_ids .= $movie["id"] . " ";
  }
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
  <link rel="stylesheet" type="text/css" href="../CSSFolder/browseMovies.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="../header/sidenav.js"></script>
  <title>Browse Movies</title>
</head>

<body>
  <?= createHeader2(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1, '../header/logo.png', 'black') ?>
  <div id="container">
    <div id="aside">
      <div id="filterForm">
        <section id="titleSection">
          <h3 id="browserDisplay">Movie Filters</h3>
          <h4 id="titleText">Movie Title</h4>
          <label>
            <input type="search" name="searchbar" id="searchBar" placeholder="Enter Movie Title">
          </label>
        </section>
        <section id="year">
          <h4 id="yearText">Year</h4>
          <label id="beforeYearLabel">
            <input type="radio" name="year" value="beforeYear">Before
          </label>
          <label>
            <input type="number" class="textbox" id="beforeYear" min="0" max="9999">
          </label>
          <br>
          <label id="afterYearLabel">
            <input type="radio" name="year" value="afterYear">After
          </label>
          <label>
            <input type="number" class="textbox" id="afterYear" min="0" max="9999">
          </label>
          <br>
          <label id="betweenYear">
            <input type="radio" name="year" value="betweenYear">Between
          </label>
          <label>
            <input type="number" class="textbox" id="betweenFrom" min="0" max="9999">
          </label>
          <label>
            <input type="number" class="textbox" id="betweenTill" min="0" max="9999">
          </label>
        </section>
        <section id="rate">
          <h4 id="rateText">Rating</h4>
          <label id="belowRateLabel">
            <input type="radio" name="rating" value="belowRate">Below
          </label>
          <label>
            <input type="range" min="0" max="10" class="slider" id="belowRate">
          </label>
          <label>
            <output id="belowOutput" class="outputs"></output>
          </label>
          <br>
          <label id="aboveRateLabel">
            <input type="radio" name="rating" value="aboveRate">Above
          </label>
          <label>
            <input type="range" min="0" max="10" class="slider" id="aboveRate">
          </label>
          <label>
            <output id="aboveOutput" class="outputs"></output>
          </label>
          <br>
          <label id="betweenRate">
            <input type="radio" name="rating" value="betweenRate">Between
          </label>
          <label>
            <input type="range" min="0" max="10" class="slider" id="betweenFromRate">
          </label>
          <label>
            <output id="betweenFromOutput" class="outputs"></output>
          </label>
          <label>
            <input type="range" min="0" max="10" class="slider" id="betweenTillRate">
          </label>
          <label>
            <output id="betweenTillOutput" class="outputs"></output>
          </label>
        </section>

        <button type="submit" id="filterMovies" class="buttons">Filter</button>
        <button type="reset" id="clearFilters" class="buttons">Clear</button>
      </div>
    </div>
    <button type="button" id="toggle"> &#9776; </button>
    <div id="main">
      <h2 class="title" id="mainHeading">List / Matches</h2>
      <div class='movieListingHeaders'>
        <div class="headings" id="movieTitleDefault">Title
          <button type="button" class="sortButtons" id="titleAsc">&#8673;</button>
          <button type="button" class="sortButtons" id="titleDsc">&#8675;</button>
        </div>
        <div class="headings" id="movieYearDefault">Year
          <button type="button" class="sortButtons" id="yearAsc">&#8673;</button>
          <button type="button" class="sortButtons" id="yearDsc">&#8675;</button>
        </div>
        <div class="headings" id="movieRatingDefault">Rating
          <button type="button" class="sortButtons" id="rateAsc">&#8673;</button>
          <button type="button" class="sortButtons" id="rateDsc">&#8675;</button>
        </div>
        <?php
        if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1) {
          echo "<div class='headings' id='movieFavouriteDefault'>Favourite</div>";
        }
        ?>

      </div>
      <?php
      if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1) {
        echo "<div id='movieListingMovies' class='favouriteMovieListing'></div>";
      } else {
        echo "<div id='movieListingMovies' class='movieListing'></div>";
      }
      ?>
      <div id="message"></div>
    </div>
    <?php
    echo "<div id='favourites' style='display:none;' data-status='$logged'>$movie_ids</div>";
    ?>
  </div>
  <script src="browse-movies.js"></script>
  <script src="../logoutpage/logout.js"></script>
</body>

</html>
