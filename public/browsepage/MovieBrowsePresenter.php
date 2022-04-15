<?php

class MovieBrowsePresenter
{
  private $movie;

  public function __construct($movie)
  {
    $this->movie = $movie;
  }

  public function listMovies()
  {
    $result = '';
    foreach ($this->movie as $key) {
      $result .= $this->createMovieEntry($key);
    }
    return $result;
  }

  private function createMovieEntry($movie)
  {
    $result = $this->createBrowsePoster($movie->posterURL(92), $movie->title);
    $result .= $this->createBrowseTitle($movie->title);
    $result .= $this->createBrowseYear($movie->release_date);
    $result .= $this->createBrowseRating($movie->vote_average);
    // if (login()) {
    //   $result .= $this->createBrowseFavourite();
    // }
    return $result;
  }

  private function createBrowsePoster($posterURL, $title)
  {
    return "<div><img class='clickPoster' src='$posterURL' alt='$title' style='cursor: pointer'></img></div>";
  }

  private function createBrowseTitle($title)
  {
    return "<div class='clickTitle' style='cursor: pointer'>$title</div>";
  }

  private function createBrowseYear($release_date)
  {
    $time = strtotime($release_date);
    $year = date("Y", $time);
    return "<div class='yearDiv'>$year</div>";
  }

  private function createBrowseRating($rating)
  {
    return "<div class='rateDiv'>$rating<img src='../images/star.png' width='15' height='15' alt='star'></div>";
  }
}
