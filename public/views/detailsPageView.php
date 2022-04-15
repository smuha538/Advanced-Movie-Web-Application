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
  <script src="../header/sidenav.js"></script>
  <script src="../singlemovie/tabs.js"></script>
  <link rel="stylesheet" href="../CSSFolder/detailsPage.css">
  <title>Single Movie</title>
</head>

<body>
  <?= createHeader2(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1, '../header/logo.png', 'black') ?>

  <div class="mywrapper" id="detailsPage">
    <div class="row"></div>
    <div class="row main-details-holder">
      <div class="col s12 m4 left-section">
        <div class="center poster-images-dynamic">
          <?= createPoster(342, 'image-details') ?>
          <?= createPoster(185, 'imagesmall-details') ?>
        </div>
        <div id='movietitleBox'>
          <?= createMovieTitle() ?>
        </div>
        <div id="right-section-bottom">
          <div class="col s12"></div>
          <div class="col s12 m12 info2-details center bottom-left-outter">
            <div class="row box-details test-details genres-dynamic">
              <h6 class="info-content-headers-details">Genres</h6>
              <?= createBoxContent($genres) ?>
            </div>
          </div>
        </div>
      </div>

      <!-- MIDDLE SECTION FOR GENERAL INFORMATION -->
      <div class="col s12 m4 middle">
        <div class="info-content info-content-mobile-details movieinfo-details">
          <div class="row">
            <div class="col s4">
              <div class="release-date center release-date-dynamic">
                <h6 class="info-content-headers-details">Release Date</h6>
                <?= createMidSectionContent($release_date) ?>
              </div>
            </div>
            <div class="col s4">
              <div class="revenue center" id="dynamic-revenue">
                <h6 class="info-content-headers-details">Revenue</h6>
                <?= createMidSectionContent(number_format($revenue), true) ?>
              </div>
            </div>
            <div class="col s4">
              <div class="runtime center" id="dynamic-runtime">
                <h6 class="info-content-headers-details">Runtime</h6>
                <?= convertToHoursMins($runtime) ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col s4">
              <div class="tagline center" id="tagline">
                <h6 class="info-content-headers-details">Tagline</h6>
                <?= createMidSectionContent($tagline) ?>
              </div>
            </div>
            <div class="col s4">
              <div class="imdb center">
                <h6 class="info-content-headers-details">Visit IMDB</h6>
                <p>
                  <?= createAnchorTag("imdb") ?>
                </p>
              </div>
            </div>
            <div class="col s4">
              <div class="tmdb center">
                <h6 class="info-content-headers-details">Visit TMDB</h6>
                <p>
                  <?= createAnchorTag("tmdb") ?>
                </p>
              </div>
            </div>
          </div>
          <div class="overview">
            <h6 class="info-content-headers-details">Overview</h6>
            <?= createMidSectionContent($overview) ?>
          </div>
          <div class="ratings">
            <h6 class="info-content-headers-details">Ratings</h6>
            <p>
              <span class="inner-rating" id="popularity">
                <i class="fas fa-fire padright"></i>
              </span> <?= $popularity ?>
            </p>
            <p>
              <span class="inner-rating" id="average">
                <i class="fas fa-star-half-alt padright"></i>
              </span> <?= $vote_average ?>
            </p>
            <p>
              <span class="inner-rating" id="count">
                <i class="fas fa-calculator padright"></i>
              </span> <?= $vote_count ?>
            </p>
          </div>
        </div>
        <div class="row center" style="margin-top: 2rem; padding: 1rem">
          <div class="row box-details test-details keyword-dynamic">
            <h6 class="info-content-headers-details">Keywords</h6>
            <?= createBoxContent($keywords) ?>
          </div>
        </div>
      </div>

      <!-- CREW/CAST SECTION -->
      <div class="col s12 m4 castright">
        <div class="cast-list long">
          <div class="card body-color card-details">
            <div class="card-tabs">
              <ul class="tabs tabs-fixed-width tab-color">
                <li class="tab"><a class="active" href="#cast">Cast</a></li>
                <li class="tab"><a href="#crew">Crew</a></li>
              </ul>
            </div>
            <div class="card-content default-card-content-details">
              <div id="cast">
                <div class="headers">
                  <div class="col s6">
                    <h6 class="header-name">Name</h6>
                  </div>
                  <div class="col s6">
                    <h6 class="header-character">Character</h6>
                  </div>
                </div>
                <div class="crew long" id="castBox">
                  <!-- <span></span> -->
                  <?= createCast() ?>
                </div>
              </div>
              <div id="crew">
                <div class="headers">
                  <div class="col s5">
                    <h6 class="header-name">Name</h6>
                  </div>

                  <div class="col s7">
                    <h6 class="header-character">Department - Job</h6>
                  </div>
                </div>
                <div class="crew long" id="crewBox">
                  <!-- <span></span> -->
                  <?= createCrew() ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row center" style="margin-top: 1rem; padding: 2rem">
          <div class="row box-details test-details comp-details">
            <h6 class="info-content-headers-details">Companies</h6>
            <?= createBoxContent($companies) ?>
          </div>

          <div class="row box-details test-details country-details">
            <h6 class="info-content-headers-details">Countries</h6>
            <?= createBoxContent($countries) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../logoutpage/logout.js"></script>
</body>

</html>
