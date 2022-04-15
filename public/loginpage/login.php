<?php
include "../header/header.php";
include "../../database/Connection.php";

function populateLoginError()
{
  // handling error from formHandler.php
  if (isset($_GET["err"])) {
    if ($_GET["err"] == "noEmail") {
      echo "<div style='color:red'>Login unsuccessful, please check your email or password.</div>";
      // these two should do the same thing but just in case for further amendment
    } elseif ($_GET["err"] == "wrongPassword") {
      echo "<div style='color:red'>Login unsuccessful, please check your email or password.</div>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:400,500,600,700" />
  <link rel="stylesheet" href="../CSSFolder/login.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="login.css">
  <script src="../header/sidenav.js"></script>
  <title>Login Page</title>
</head>

<body>
  <?= createHeader2(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1, '../header/logo.png', 'black') ?>
  <div class="row">
    <div class="col s8"><span>.</span></div>
    <div class="col s12 l4 center" id="card-styles">
      <div class="row">
        <form action="./formHandler.php" method="post" name="login" onsubmit="return emptyForm()">
          <div class="col s12 m12">
            <div class="card" id="card-padding">
              <span class="card-title center">Welcome to MoviEZ</span>
              <div class="card-content">
                <div class="row s12">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="email" type="text" name="email">
                    <label for="email">Email</label>
                    <span class="helper-text red-text hide left-align" id="emailHelper">Enter your email</span>
                  </div>
                </div>
                <div class="row s12">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="password" type="password" name="password">
                    <label for="password">Password</label>
                    <span class="helper-text red-text hide left-align" id="passwordHelper">Enter your password</span>
                  </div>
                </div>
              </div>
              <?= populateLoginError() ?>
              <div class="card-action">
                <div class="col s12" id='button-section-signup'>
                  <button class="btn-large waves-effect waves-light black" id="login-btn" type="submit" name="action">Login</button>
                </div>
                <div class="col s12 center" style="margin-top: 1rem;">
                  <span class="center signIn">Don't Have an Account? <a href="../registerpage/register.php" style="color: green;">REGISTER</a></span>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="./login.js"></script>
</body>

</html>
