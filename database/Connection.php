<?php
  // take in a SQL query and return the fetched result array
  function queryDB($query, $namedParameter = null){
    // include the config.php connecting to heroku environmental environment
    $config = include "../../config.php";
    $connectionString = "{$config["database"]["connection"]}; dbname={$config["database"]["name"]}; charset=utf8mb4";
      // try creating an PDO instance
      try{
        $pdo = new PDO($connectionString, $config["database"]["user"], $config["database"]["password"]);
      } catch (PDOException $e){
        // pop the error message
        die($e->getMessage());
      }

      // prepare() will return an executable statement (convo between php and DB)
      try{
        $statement = $pdo->prepare($sql = $query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY)); 
        $statement->execute($namedParameter);
      } catch (PDOException $e){
        // pop the error message if there is duplicated entry in the database
        if ($e->errorInfo[1] == 1062) {
          header("Location: ../registerpage/register.php?err=duplicate");
        } else {
          die($e->getMessage());
        }
      }
      // fetch the statement into asso array format and put into result
      return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
