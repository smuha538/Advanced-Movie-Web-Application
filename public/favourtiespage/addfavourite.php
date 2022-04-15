<?php
require "../../database/PDO.php";
require "../../database/QueryBuilder.php";
require "../../partials/recommendationhelper.php";

session_start();
if (!empty($_GET['id']) && !empty($_SESSION['user_id'])) {
  $pdo = pdo();
  $querybuilder = new QueryBuilder($pdo);
  $movie_id = $_GET['id'];
  $user_id = $_SESSION['user_id'];
  $querybuilder->addFavourite($user_id, $movie_id);
  $favourites = $querybuilder->favourites($user_id);
  unset($_SESSION["favourites"]);
  $_SESSION["favourites"] = $favourites;
  require "../../partials/recommendationupdate.php";
  if (isset($_GET["ref"]) && $_GET["ref"] == "sin") {
    header("Location: ../singlemovie/single-movie.php?id=$movie_id");
  } else if (isset($_GET["ref"]) && $_GET["ref"] == "brow") {
    header("Location: ../browsepage/browse-movies.php");
  } else {
    header("Location: ../error/error.php");
  }
} else {
  header("Location: ../error/error.php");
}
