<?php

session_start();

function createHeader2($loggedIn, $logoPath, $navColor = 'green darken-1')
{
  $completedNav = "";
  $completedNav .= "<nav class='$navColor' style='height: 60px'>";
  $completedNav .= "<div class='nav-wrapper'>";
  $completedNav .= "<a href='../index.php' class='brand-logo' style='margin-top: .5rem; margin-bottom: .5rem'><img src='$logoPath' alt='Movie Browser Logo' height=50 width=50></a>";
  $completedNav .= "<a href='#' data-target='mobile-demo' class='sidenav-trigger'><i class='material-icons'>menu</i></a>";
  $completedNav .= "<ul class='right hide-on-med-and-down'>";
  $completedNav .= createAllItems($loggedIn);
  $completedNav .= "</ul>";
  $completedNav .= "</div>";
  $completedNav .= "</nav>";

  $completedNav .= "<ul class='sidenav' id='mobile-demo'>";
  $completedNav .= createAllItems($loggedIn);
  $completedNav .= "</ul>";

  return $completedNav;
}

function createAllItems($loggedIn)
{
  $completedItem = "";
  if ($loggedIn) {
    $completedItem .= createNavItem('../index.php', 'Home');
    $completedItem .= createNavItem('../aboutus/aboutus.php', 'About');
    $completedItem .= createNavItem('../browsepage/browse-movies.php', 'Browse');
    $completedItem .= createNavItem('../favourtiespage/favorites.php', 'Favourites');
    // here i add the public to make the logout function works in local machine
    $completedItem .= createNavItem('../logoutpage/logout.php', 'Log out', 'logout');
  } else {
    $completedItem .= createNavItem('../index.php', 'Home');
    $completedItem .= createNavItem('../aboutus/aboutus.php', 'About');
    $completedItem .= createNavItem('../browsepage/browse-movies.php', 'Browse');
    $completedItem .= createNavItem('../loginpage/login.php', 'Login');
    $completedItem .= createNavItem('../registerpage/register.php', 'Register');
  }


  return $completedItem;
}
function createNavItem($address, $title, $class = "")
{
  return "<li><a href='$address' style='font-weight: bold; font-size: 18px' class='$class'>$title</a></li>";
}
