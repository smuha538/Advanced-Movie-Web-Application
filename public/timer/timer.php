<?php

/**
 * References from: https://www.w3schools.com/php/php_date.asp
 */
function albertaTimeDate()
{
  date_default_timezone_set("America/Edmonton");
  $result = "<div>Current Time and Date: ";
  $result .= date("Y/m/d h:i a");
  $result .= "</div>";
  return $result;
}

function milestoneDeadline()
{
  $result = "<div>Time Remaining Until Milestone 5 is Due: ";
  $result .= calculateInterval();
  $result .= "</div>";
  return $result;
}

/**
 * References from: https://stackoverflow.com/questions/5906686/php-time-remaining-until-specific-time-from-current-time-of-page-load
 */
function calculateInterval()
{
  $today = new DateTime();
  $milestone_deadline = new DateTime('2022-04-08 23:59:00');
  $interval = $milestone_deadline->diff($today);
  return $interval->format("%a days, %h hours, %i minutes");
}
