<?php

require '../../database/PDO.php';
require '../../database/QueryBuilder.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('content-type: application/json');

if (count($_GET) == 0 || $_GET['title'] == null || count($_GET) != 1) {
  echo json_encode([]);
  exit();
} elseif (substr_count(strtolower($_SERVER["QUERY_STRING"]), "title") != 1) {
  echo json_encode([]);
  exit();
}

$searchedMovie = urlencode($_GET['title']);
$titleToSearch = str_replace('+', '%', $searchedMovie);

$pdo = pdo();
$querybuilder = new QueryBuilder($pdo);


// function queryBuilder($title)
// {
//   return "SELECT * FROM movie WHERE title LIKE '%$title%' ";
// }
$searchedMovieResult = $querybuilder->api($titleToSearch);
$apiResponse = json_encode($searchedMovieResult);
echo $apiResponse;
