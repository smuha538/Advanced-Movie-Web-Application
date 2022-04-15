<?php
include "../header/header.php";
include "../timer/timer.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:400,500,600,700" />

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" crossorigin="anonymous" />

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" crossorigin="anonymous"></script>
  <script src="../header/sidenav.js"></script>
  <link rel="stylesheet" href="../CSSFolder/aboutCSS.css">
  <link rel="stylesheet" href="../CSSFolder/aboutus.css">
  <title>About Page</title>
</head>

<body>
  <?= createHeader2(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1, '../header/logo.png', 'black') ?>

  <div class="row center">
    <div class="row headerStyle">
      <h1 class="aboutHeader">About us</h1>
    </div>
    <div class="col s12 l6 cardStyleInd">
      <div class="row">
        <div class="col s12">
          <div class="card red darken-1">
            <div class="card-content white-text">
              <span class="card-title" style="font-weight: 500; font-size: 2rem">About the Assignment</span>
              <div class="row">
                <img src="../images/mruLogo.png" alt="Mount Royal University" width="200">
                <p>COMP 3512: WEB II - Winter 2022</p>
              </div>
              <div class="row">
                <?php
                echo albertaTimeDate();
                echo milestoneDeadline();
                ?>
              </div>
              <div class="row">
                <h5>Tech Stack</h5>
              </div>
              <div class="row center">
                <div class="col s12 l4">
                  <img src="../images/htmlLogo.png" alt="HTML Logo" width="100">
                </div>
                <div class="col s12 l4">
                  <img src="../images/cssLogo.png" alt="CSS Logo" width="60">
                </div>
                <div class="col s12 l4">
                  <img src="../images/javascriptLogo.png" alt="Javascript Logo" width="60">
                </div>
              </div>
              <div class="row center">
                <div class="col s12 l4">
                  <img src="../images/phpLogo.png" alt="PHP Logo" width="100">
                </div>
                <div class="col s12 l4" style="margin-top: -2rem;">
                  <img src="../images/mySQLLogo.png" alt="mySQL Logo" width="120">
                </div>
                <div class="col s12 l4">
                  <img src="../images/herokuLogo.png" alt="Heroku Logo" width="40">
                </div>
              </div>
            </div>
            <div class="card-action aGithub">
              <a class="waves-effect waves-light btn light-blue darken-4" href="https://github.com/MRU-CSIS-3512-202201-001/asg-2-teamwork-team-a2-03" target="_blank">View GitHub Repository</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col s12 l6 cardStyleInd">
      <div class="row">
        <div class="col s12">
          <div class="card  orange darken-1">
            <div class="card-content white-text">
              <span class="card-title" style="font-weight: 500; font-size: 2rem">Meet the team</span>
              <div class="row" style="padding: 2rem;">

                <div class="col s12 l6">
                  <div id='sahir'>
                    <div class="row">
                      <h5>Sahir Muhammad Tariq</h5>
                    </div>
                    <div class="row center">
                      <img src="https://chingizpro.github.io/portfolio/img/person.png" width=89 alt='icon' />
                    </div>
                    <div class="row">
                      <a class="waves-effect waves-light btn light-blue darken-4" href="https://github.com/smuha538" target="_blank">Sahir's GitHub</a>
                    </div>
                  </div>
                </div>

                <div class="col s12 l6">
                  <div id='sam'>
                    <div class="row">
                      <h5>Sam Tang</h5>
                    </div>
                    <div class="row center">
                      <img src="https://chingizpro.github.io/portfolio/img/person.png" width=89 alt='icon' />
                    </div>
                    <div class="row">
                      <a class="waves-effect waves-light btn light-blue darken-4" href="https://github.com/tsangkafu" target="_blank">Sam's GitHub</a>
                    </div>
                  </div>
                </div>
              </div>

              <div id='Ramin'>
                <div class="row">
                  <h5>Ramin Radmand</h5>
                </div>
                <div class="row center">
                  <img src="https://chingizpro.github.io/portfolio/img/person.png" width=89 alt='icon' />
                </div>
                <div class="row">
                  <a class="waves-effect waves-light btn light-blue darken-4" href="https://github.com/imraminradmand" target="_blank">Ramin's GitHub</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../logoutpage/logout.js"></script>
</body>

</html>
