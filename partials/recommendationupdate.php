<?php
if (empty($favourites)) {
  $_SESSION["favourites"] = [];
  $_SESSION["recommendations"] = $querybuilder->topRated();
} else {
  $_SESSION["favourites"] = $favourites;
  $movie = getRecommendation($favourites, $querybuilder);
  count($movie) < 10 ? $_SESSION["recommendations"] = array_merge($querybuilder->topRated(), $movie) : $_SESSION["recommendations"] = $movie;
}
