<?php
// redirect to error page with specific error string
function populateError($err)
{
  header("Location: ../error/error.php?err=${err}");
}

// string sanitizaiton
// if it has no arg or more than 1 arg
$searchedID = $_GET["id"];
if (count($_GET) != 1) {
  populateError("wrongArgNum");
} elseif (!isset($_GET["id"])) {
  populateError("noid");
  // reference: https://www.php.net/ctype_digit
} elseif (!ctype_digit($_GET["id"])) {
  populateError("notInt");
} elseif ($_GET["id"] <= 0) {
  populateError("notPos");
  // if id is duplicate
} elseif (substr_count(strtolower($_SERVER["QUERY_STRING"]), "id") != 1) {
  populateError("dupId");
} else {
  if (count(queryDB("SELECT * FROM movie WHERE id=$searchedID")) == 0) {
    populateError("notInList");
  }
}
