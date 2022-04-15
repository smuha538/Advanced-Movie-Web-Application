<?php

function pdo()
{
  // include the config.php connecting to heroku environmental environment
  $config = include "../../config.php";
  $connectionString = "{$config["database"]["connection"]}; dbname={$config["database"]["name"]}; charset=utf8mb4";
  // try creating an PDO instance
  try {
    $pdo = new PDO($connectionString, $config["database"]["user"], $config["database"]["password"]);
  } catch (PDOException $e) {
    // pop the error message
    die($e->getMessage());
  }

  return $pdo;
}
