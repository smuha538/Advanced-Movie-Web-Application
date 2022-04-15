<?php
function noFavourities($movies)
{
  return empty($movies) ? true : false;
}

function createCarousel($movies, $type = "recommendations")
{
  $result = "";
  if (noFavourities($movies) && $type == "favourites") {
    $result = "<div class= 'col s12 white-text center-align'>You have no favourite movies</div>";
  } elseif(count($movies) == 2){
    $result .= '<p class="center" style="color: white; font-weight: bold"> You have 2 favourited movies, swipe to see each!</p>';
    $result .= "<div class='carousel'>";
    $result .= createCarouselItems($movies);
    $result .= "</div>";
  } else {
    $result .= "<div class='carousel'>";
    $result .= createCarouselItems($movies);
    $result .= "</div>";
  }
  return $result;
}

function createCarouselItems($movies)
{
  $result = "";
  foreach ($movies as $movie) {
    $movie_poster = $movie['poster_path'];
    $movie_title = $movie['title'];
    $id = $movie['id'];
    $src = "https://image.tmdb.org/t/p/w92/$movie_poster";
    $result .= "<a class='carousel-item center-align'><img src='$src' class='movie' data-id='$id'><span class='white-text truncate'>$movie_title</span></a>";
  }
  return $result;
}

function firstName()
{
  $firstName = ucfirst($_SESSION["firstName"]);
  return $firstName;
}

function lastName()
{
  $lastName = ucfirst($_SESSION["lastName"]);
  return $lastName;
}

function country()
{
  $country = ucfirst($_SESSION["country"]);
  return $country;
}

function city()
{
  $city = ucfirst($_SESSION["city"]);
  return $city;
}

function favouriteMovies()
{
  $movies = $_SESSION["favourites"];
  $result = createCarousel($movies, "favourites");
  return $result;
}

function recommendations()
{
  $movies = $_SESSION["recommendations"];
  $result = createCarousel($movies);
  return $result;
}
