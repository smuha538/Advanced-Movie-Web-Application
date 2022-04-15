<?php

class QueryBuilder
{

  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  private function error($e)
  {
    if ($e->errorInfo[1] == 1062) {
      header("Location: ../registerPage/register.php?err=duplicate");
    } else {
      die($e->getMessage());
    }
  }

  public function api($title)
  {
    $theQuery = "SELECT * FROM movie WHERE title LIKE '%$title%'";

    try {
      $statement = $this->pdo->prepare($theQuery);
      $statement->execute();
    } catch (PDOException $e) {
      // pop the error message if there is duplicated entry in the database
      if ($e->errorInfo[1] == 1062) {
        header("Location: ../registerPage/register.php?err=duplicate");
      } else {
        die($e->getMessage());
      }
    }
    // fetch the statement into asso array format and put into result
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function favourites($user_id)
  {
    $theQuery = <<<'EOD'
    SELECT title, poster_path, release_date, vote_average, id FROM movie, favourites WHERE favourites.movieId = movie.id AND favourites.userId = :user_id
    EOD;

    try {
      $statement = $this->pdo->prepare($theQuery);
      $statement->execute(["user_id" => $user_id]);
    } catch (PDOException $e) {
      $this->error($e);
    }
    // fetch the statement into asso array format and put into result
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function topRated()
  {
    $theQuery = <<<'EOD'
    SELECT title, poster_path, id FROM movie ORDER BY vote_average DESC LIMIT 15 
    EOD;

    try {
      $statement = $this->pdo->prepare($theQuery);
      $statement->execute();
    } catch (PDOException $e) {
      $this->error($e);
    }
    // fetch the statement into asso array format and put into result
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function recommendations($release_date_from, $release_date_till, $rating_from, $rating_till)
  {
    $theQuery = <<<'EOD'
    SELECT title, poster_path, id FROM movie WHERE release_date BETWEEN :release_date_from AND :release_date_till AND vote_average BETWEEN :rating_from AND :rating_till LIMIT 15
    EOD;

    try {
      $statement = $this->pdo->prepare($theQuery);
      $statement->execute(["release_date_from" => $release_date_from, "release_date_till" => $release_date_till, "rating_from" => $rating_from, "rating_till" => $rating_till]);
    } catch (PDOException $e) {
      $this->error($e);
    }
    // fetch the statement into asso array format and put into result
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function removeFavourite($user_id, $movie_id)
  {
    $theQuery = <<<'EOD'
    DELETE FROM favourites WHERE userId = :user_id AND movieId = :movie_id
    EOD;

    try {
      $statement = $this->pdo->prepare($theQuery);
      $statement->execute(["user_id" => $user_id, "movie_id" => $movie_id]);
    } catch (PDOException $e) {
      $this->error($e);
    }
  }

  public function removeAllFavourites($user_id)
  {
    $theQuery = <<<'EOD'
    DELETE FROM favourites WHERE userId = :user_id
    EOD;

    try {
      $statement = $this->pdo->prepare($theQuery);
      $statement->execute(["user_id" => $user_id]);
    } catch (PDOException $e) {
      $this->error($e);
    }
  }

  public function addFavourite($user_id, $movie_id)
  {
    $theQuery = <<<'EOD'
    INSERT INTO favourites (userId, movieId) VALUES (:user_id, :movie_id)
    EOD;

    try {
      $statement = $this->pdo->prepare($theQuery);
      $statement->execute(["user_id" => $user_id, "movie_id" => $movie_id]);
    } catch (PDOException $e) {
      $this->error($e);
    }
  }
}
