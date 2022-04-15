<?php
$favourites = $_SESSION["favourites"];

function createFavourites()
{
  $result = "";
  $favourites = $_SESSION["favourites"];
  if (empty($favourites)) {
    $result .= "<div class='col s12 center-align'><h1>You Have No Favourite Movies</h1></div>";
  } else {
    foreach ($favourites as $favourite) {
      $result .= createCard($favourite);
    }
  }
  return $result;
}

function createCard($favourite)
{
  $result = "<div class='col s6 l3 move'>";
  $result .= "<div class='card'>";
  $result .= createCardImage($favourite);
  $result .= createCardContent($favourite);
  $result .= "</div></div>";
  return $result;
}

function createCardImage($favourite)
{
  $src = $favourite["poster_path"];
  $alt = $favourite["title"];
  $movie_id = $favourite["id"];
  $user_id = $_SESSION["user_id"];
  $result = "<div class='card-image'>";
  $result .= "<a href='../singlemovie/single-movie.php?id=$movie_id'><img src='https://image.tmdb.org/t/p/w185/$src' alt='$alt'></a>";
  $result .= "<a href='../favourtiespage/removefavourite.php?id=$movie_id&ref=fav' class='halfway-fab btn-floating btn-medium pink'>";
  $result .= "<i class='material-icons'>favorite</i></a></div>";
  return $result;
}

function createCardContent($favourite)
{
  $title = $favourite["title"];
  $movie_id = $favourite["id"];
  $result = "<div class='card-content'>";
  $result .= "<a href='../singlemovie/single-movie.php?id=$movie_id'><span class='card-title center-align truncate redirect' data-id='$movie_id'>$title</span></a></div>";
  return $result;
}

function createFavouriteButton()
{
  $user_id = $_SESSION['user_id'];
  $result = "<div class='col s12 center-align' id='button'>";
  $result .= "<a href='../favourtiespage/removefavourite.php?&ref=fav'";
  empty($_SESSION["favourites"]) ? $result .= "class='waves-effect waves-light btn disabled'>" : $result .= "class='waves-effect waves-light btn'>";
  $result .= "Unfavourite All Movies</a></div>";
  return $result;
}
