<?php
function getRecommendation($favourites, $querybuilder)
{
  $recommendation = [];
  if (count($favourites) != 1) {
    $random = rand(0, count($favourites));
    $recommendation = getMovies($favourites, $random, $querybuilder);
  } else {
    $recommendation = getMovies($favourites, 0, $querybuilder);
  }

  if (count($recommendation) == 0) {
    getRecommendation($favourites, $querybuilder);
  } else {
    return $recommendation;
  }
}

function getMovies($favourites, $index, $querybuilder)
{
  $date_year = getDateYear($favourites[$index]["release_date"]);
  $date_from = getDateFrom($date_year);
  $date_till = getDateTill($date_from);
  $rating = $favourites[$index]["vote_average"];
  $rating_from = getRatingFrom($rating);
  $rating_till = getRatingTill($rating);
  $movies = $querybuilder->recommendations($date_from, $date_till, $rating_from, $rating_till);
  return $movies;
}

function getDateYear($date)
{
  return date('Y', strtotime($date));
}

function getDateFrom($year)
{
  $date = new DateTime();
  $date->setDate($year, 1, 1);
  return $date->format('Y-m-d');
}

function getDateTill($date_from)
{
  $date = new DateTime($date_from);
  $date->add(new DateInterval('P0Y11M30D'));
  $date_till = $date->format('Y-m-d');
  return $date_till;
}

function getRatingFrom($rating)
{
  return $rating - 0.25;
}

function getRatingTill($rating)
{
  return $rating + 0.25;
}
