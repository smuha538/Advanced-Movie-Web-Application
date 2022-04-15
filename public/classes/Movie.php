<?php

class Movie
{
  public static $tmdb_link = "https://image.tmdb.org/t/p/w";
  public $tmdb_id;
  public $imdb_id;
  public $title;
  public $release_date;
  public $vote_average;
  public $vote_count;
  public $runtime;
  public $popularity;
  public $revenue;
  public $poster_path;
  public $tagline;
  public $overview;
  public $production_companies;
  public $production_countries;
  public $genre;
  public $keywords;
  public $cast;
  public $crew;

  public function __construct($tmdb_id, $imdb_id, $title, $release_date, $vote_average, $vote_count, $runtime, $popularity, $revenue, $poster_path, $tagline, $overview, $production_companies, $production_countries, $genre, $keywords, $cast, $crew)
  {
    $this->tmdb_id = $tmdb_id;
    $this->imdb_id = $imdb_id;
    $this->title = $title;
    $this->release_date = $release_date;
    $this->vote_average = $vote_average;
    $this->vote_count = $vote_count;
    $this->runtime = $runtime;
    $this->popularity = $popularity;
    $this->revenue = $revenue;
    $this->poster_path = $poster_path;
    $this->tagline = $tagline;
    $this->overview = $overview;
    $this->production_companies = $production_companies;
    $this->production_countries = $production_countries;
    $this->genre = $genre;
    $this->keywords = $keywords;
    $this->cast = $cast;
    $this->crew = $crew;
  }

  public function posterURL($width)
  {
    return  $url = self::$tmdb_link . $width . "/" . $this->poster_path;
  }
}
