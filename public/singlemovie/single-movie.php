<?php
include "../header/header.php";
include "../../database/Connection.php";

$tmdb_id = "";
$imdb_id = "";
$movie_title = "";
$release_date = "";
$vote_average = "";
$vote_count = "";
$runtime = "";
$popularity = "";
$revenue = "";
$poster_path = "";
$tagline = "";
$overview = "";
$companies = [];
$countries = [];
$genres = [];
$keywords = [];
$names_cast = [];
$roles = [];
$crewComplete = array();


require_once "./query-sanitization.php";

$movieSearchedID = $_GET["id"];
$query = "SELECT * FROM movie WHERE id=:id";
$namedParam = array('id' => $searchedID);
$movie_array = queryDB($query, $namedParam);
$result = $movie_array[0];
$tmdb_id = $result['tmdb_id'];
$imdb_id = $result['imdb_id'];
$movie_title = $result['title'];
$release_date = $result['release_date'];
$vote_average = $result['vote_average'];
$vote_count = $result['vote_count'];
$runtime = $result['runtime'];
$popularity = $result['popularity'];
$revenue = $result['revenue'];
$poster_path = $result['poster_path'];
$tagline = $result['tagline'];
$overview = $result['overview'];

$production_companies_array = $result['production_companies'];
$production_companies_array = json_decode($production_companies_array, true);
if (!empty($production_companies_array)) {
  foreach ($production_companies_array as $company) {
    array_push($companies, $company['name']);
  }
}

$production_countries_array = $result['production_countries'];
$production_countries_array = json_decode($production_countries_array, true);
if (!empty($production_countries_array)) {
  foreach ($production_countries_array as $country) {
    array_push($countries, $country['name']);
  }
}

$genres_array = $result['genres'];
$genres_array = json_decode($genres_array, true);
if (!empty($genres_array)) {
  foreach ($genres_array as $genre) {
    array_push($genres, $genre['name']);
  }
}

$keywords_array = $result['keywords'];
$keywords_array = json_decode($keywords_array, true);
if (!empty($keywords_array)) {
  foreach ($keywords_array as $keyword) {
    array_push($keywords, $keyword['name']);
  }
}


$cast_array = $result['cast'];
$cast_array = json_decode($cast_array, true);
if (!empty($cast_array)) {
  foreach ($cast_array as $member) {
    array_push($names_cast, $member['name']);
    array_push($roles, $member['character']);
  }
}


$crew_array = $result['crew'];
$crew_array = json_decode($crew_array, true);
if (!empty($crew_array)) {
  $newArr = array();
  $counter = 0;
  foreach ($crew_array as $member) {
    $name = $member['name'];
    $desc = $member['department'] . " - " . $member['job'];

    $newArr[$counter]['name'] = $name;
    $newArr[$counter]['desc'] = $desc;
    $counter++;
  }

  $crewComplete = array_merge($crewComplete, $newArr);
}


function convertToHoursMins($time)
{
  $hours = floor($time / 60);
  $minutes = ($time % 60);
  return "<p> $hours h $minutes m </p>";
}

function createMovieTitle()
{
  global $movie_title;
  $result = "<h5 class='center title-details movie-title-event title-color'> $movie_title ";
  if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1) {
    $id = $_GET['id'];
    if (isFavourited()) {
      $result .= "<i class='far fa-heart fav-icon toggle-fav' data-id='$id'></i></h5>";
    } else {
      $result .= "<i class='far fa-heart fav-icon' data-id='$id'></i></h5>";
    }
  } else {
    $result .= "</h5>";
  }
  return $result;
}

function isFavourited()
{
  if (empty($_SESSION["favourites"])) {
    return false;
  } else {
    $exists = false;
    $favourite_movies = $_SESSION["favourites"];
    foreach ($favourite_movies as $movie) {
      if ($_GET["id"] == $movie["id"]) {
        $exists = true;
      }
    }
    return $exists;
  }
}

function createPoster($width, $className)
{
  global $poster_path;
  global $movie_title;
  $url = 'https://image.tmdb.org/t/p/w' . $width . "/" . $poster_path;
  return "<img src='$url' alt='$movie_title' class='$className'/>";
}

function createBoxContent($array)
{
  $result = "<p>";
  foreach ($array as $item) {
    $result .= "<span class='kwordbox-details'>" . $item . "</span>";
  }
  $result .= "</p>";
  return $result;
}

function createMidSectionContent($item, $isRevenue = false)
{
  return $isRevenue ? "<p>$ $item</p>" : "<p>$item</p>";
}

function createAnchorTag($whichDB)
{
  global $imdb_id, $tmdb_id;
  if ($whichDB == 'imdb') {
    $imdbURL = 'https://www.imdb.com/title/' . $imdb_id;
    return "<a class='details-a' rel='noopener noreferrer' id='IMDB' href='$imdbURL' > <i class='fab fa-imdb db-icon imdb-event'></i> </a>";
  } else {
    $tmdbURL = 'https://www.themoviedb.org/movie/' . $tmdb_id;
    return "<a class='details-a' rel='noopener noreferrer' id='TMDB' href='$tmdbURL' > <span id='tmdb-event'> <i class='fas fa-film db-icon'></i> <i class='fas fa-database db-icon'></i> </span></a>";
  }
}

function createCast()
{
  global $names_cast, $roles;
  $result = "";
  foreach ($names_cast as $index => $castMember) {
    $result .= "<div class='row'> <div class='col s6'> <p>$castMember</p> </div> <div class='col s6'> <p>$roles[$index]</p> </div> </div>";
  }

  return $result;
}


function createCrew() {
  global $crewComplete;
  usort($crewComplete, function($a, $b) {
    $retval = $a['desc'] <=> $b['desc'];
    if ($retval == 0) {
      $retval = $a['name'] <=> $b['name'];
    }
    return $retval;
  });

  $result = "";
  foreach ($crewComplete as $value) {
    $name = $value['name'];
    $desc = $value['desc'];
    $result .= "<div class='row'> <div class='col s5'> <p>$name</p> </div> <div class='col s7'> <p>$desc</p> </div> </div>";
  }

  return $result;
}

require '../views/detailsPageView.php';
