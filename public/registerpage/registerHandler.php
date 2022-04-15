<?php

require "../../database/Connection.php";
require "../../database/PDO.php";
require "../../database/QueryBuilder.php";
require "../../partials/recommendationhelper.php";

session_start();

if (isset($_POST["register"])) {
  $duplicated = false;
  // handle duplicated email
  $query = "SELECT * FROM user WHERE Email=:email";
  $namedParameter = array('email' => strtolower($_POST["email"]));
  $results = queryDB($query, $namedParameter);
  if (count($results) != 0) $duplicated = true;

  if ($duplicated) {
    header("Location: ../registerpage/register.php?err=duplicate");
    $_SESSION["tempFirstName"] = $_POST["first_name"];
    $_SESSION["tempLastName"] = $_POST["last_name"];
    $_SESSION["tempCountry"] = $_POST["country"];
    $_SESSION["tempCity"] = $_POST["city"];
    $_SESSION["tempEmail"] = $_POST["email"];
    $_SESSION["tempPassword"] = $_POST["password"];
    $_SESSION["tempConfirmPassword"] = $_POST["confirmPassword"];
  } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    header("Location: ../registerpage/register.php?err=invalidEmail");
  } else if($_POST["password"] != $_POST["confirmPassword"]){
      header("Location: ../registerpage/register.php?err=notSamePw");
  } else {
    $email = strtolower($_POST["email"]);
    // reference: https://stackoverflow.com/questions/6101956/generating-a-random-password-in-php/31284266#31284266
    $salt = "NA";
    $sha256 = "NA";
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT, ["cost" => 12]);
    $query = "INSERT INTO user(FirstName, LastName, City, Country, Email, Password, Salt, Password_SHA256)
      VALUES (:first_name, :last_name, :city, :country, :email, :password, :salt, :sha256)";
    $namedParameter = array(
      'first_name' => $_POST["first_name"], 'last_name' => $_POST["last_name"],
      'city' => $_POST["city"], 'country' => $_POST["country"], 'email' => strtolower($_POST["email"]),
      'password' => $password, 'salt' => $salt, 'sha256' => $sha256
    );
    $results = queryDB($query, $namedParameter);

    $_SESSION["loggedIn"] = true;
    $_SESSION["lastName"] = $_POST["last_name"];
    $_SESSION["firstName"] = $_POST["first_name"];
    $_SESSION["city"] = $_POST["city"];
    $_SESSION["country"] = $_POST["country"];
    $query = "SELECT Id, FirstName, LastName, City, Country, Password, Salt, Password_SHA256 FROM user WHERE Email=:email";
    $nameParameter = array('email' => $_POST["email"]);
    $results = queryDB($query, $nameParameter);

    $_SESSION["user_id"] = $results[0]["Id"];
    $pdo = pdo();
    $querybuilder = new QueryBuilder($pdo);
    $favourites = $querybuilder->favourites($id);
    if (empty($favourites)) {
      $_SESSION["favourites"] = [];
      $_SESSION["recommendations"] = $querybuilder->topRated();
    } else {
      $_SESSION["favourites"] = $favourites;
      $movie = getRecommendation($favourites, $querybuilder);
      count($movie) < 10 ? $_SESSION["recommendations"] = array_merge($querybuilder->topRated(), $movie) : $_SESSION["recommendations"] = $movie;
    }

    header("Location: ../index.php");
  }
}
