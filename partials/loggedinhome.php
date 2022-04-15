<?php
require "loggedinhomehelper.php";
$firstName = firstName();
$lastName = lastName();
$city = city();
$country = country();
$favourites = favouriteMovies();
$recommendations = recommendations();
echo " <div class='col s12 l2 indigo lighten-1 z-depth-2' style='margin-top: 3%; margin-left: 2%; padding-bottom: 15px; height: 260px; overflow: scroll' id='userInfo'>
<h5 class=' center-align white-text'>About you</h5>
<div class='row' style='padding: 10px'>
  <div class='col s12 center-align white' style='border: 0px solid white; border-radius: 10px; margin-top: -1.5rem; margin-bottom: .25rem;'>
    <h6>First Name </h6> <span class='purple-text'>$firstName</span>
  </div>
  <div class='col s12 center-align white' style='border: 0px solid white; border-radius: 10px;'>
    <h6>Last Name </h6> <span class='purple-text'>$lastName</span>
  </div>
  <div class='col s12 center-align white' style='border: 0px solid white; border-radius: 10px; margin-top: 1rem; margin-top: 5px'>
    <h6>Country </h6> <span class='purple-text'>$country</span>
  </div>
  <div class='col s12 center-align white' style='border: 0px solid white; border-radius: 10px; margin-top: 5px'>
    <h6>City </h6> <span class=' purple-text'>$city</span>
  </div>
</div>
</div>
<div class='col s12 l4 indigo z-depth-2' style='margin-top: 3%; margin-left: 3%' id='favouriteMovies'>
<div class='col s12'>
  <h5 class='center-align white-text'>Favourite Movies</h5>
</div>
$favourites
</div>
<div class='col s12 l6 indigo z-depth-2' style='margin-top: 3%; margin-left:3%' id='recommendations'>
<div class='col s12'>
  <h5 class='center-align white-text'>Movies You Might Like</h5>
</div>
$recommendations
</div>";
