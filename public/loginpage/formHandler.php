<?php

require "../../database/Connection.php";
require "../../database/PDO.php";
require "../../database/QueryBuilder.php";
require "../../partials/recommendationhelper.php";

session_start();

if (isset($_POST["action"])) {
  $email = strtolower($_POST["email"]);
  $query = "SELECT Id, FirstName, LastName, City, Country, Password, Salt, Password_SHA256 FROM user WHERE Email=:email";
  $nameParameter = array('email' => $_POST["email"]);
  $results = queryDB($query, $nameParameter);
  if (count($results) == 0) {
    header("Location: ./login.php?err=noEmail");
  } else {

    $firstName = $results[0]["FirstName"];
    $lastName = $results[0]["LastName"];
    $city = $results[0]["City"];
    $country = $results[0]["Country"];
    $id = $results[0]["Id"];
    $hash = $results[0]["Password"];
    $password = $_POST["password"];
    if (password_verify($password, $hash)) {
      $pdo = pdo();
      $querybuilder = new QueryBuilder($pdo);
      $favourites = $querybuilder->favourites($id);
      require "../../partials/recommendationupdate.php";
      $_SESSION["loggedIn"] = true;
      $_SESSION["lastName"] = $lastName;
      $_SESSION["firstName"] = $firstName;
      $_SESSION["city"] = $city;
      $_SESSION["country"] = $country;
      $_SESSION["user_id"] = $id;

      header("Location: ../index.php");
    } else {
      header("Location: ./login.php?err=wrongPassword");
    }
  }
}
