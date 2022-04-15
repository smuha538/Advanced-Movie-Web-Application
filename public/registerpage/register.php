<?php
  include "../header/header.php";
  include "../../database/Connection.php";

  function populateDuplicateError(){
    if(isset($_GET["err"])){
      if($_GET["err"] == "duplicate"){
        echo "<div style='color:red' class='col s12 center-align'>Email already exists.</div>";
      }
      if($_GET["err"] == "notSamePw"){
        echo "<div style='color:red' class='col s12 center-align'>Please enter the exact same password.</div>";
      }
      if($_GET["err"] == "invalidEmail"){
        echo "<div style='color:red' class='col s12 center-align'>Please enter a valid email.</div>";
      }
    }
  }

  $countryList = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="register.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <link rel="stylesheet" href="../CSSFolder/register.css">
  <script src="../header/sidenav.js"></script>
  <title>Register</title>
</head>

<body class="blue">
  <?= createHeader2(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1, '../header/logo.png', 'black') ?>

  <div class="container white z-depth-2">
    <div class="row">
      <div class="col s12 l6 offset-l3">
        <h2 class="center-align">Create Account</h2>
      </div>

      <form class="col s12 l6 offset-l3" method="post" action="./registerHandler.php">
        <div class="row">
          <?= populateDuplicateError() ?>
          <div class="input-field col s6">
            <input id="first_name" type="text" class="validate" name="first_name" value="<?= $_SESSION["tempFirstName"] ?? "" ?>">
            <label for="first_name">First Name</label>
            <i class="material-icons prefix validateIcon" id="firstNameIcon"></i>
            <span class="helper-text shift" id="firstNameHelper"></span>
          </div>
          <div class="input-field col s6">
            <input id="last_name" type="text" class="validate" name="last_name" value="<?= $_SESSION["tempLastName"] ?? "" ?>">
            <label for="last_name">Last Name</label>
            <i class="material-icons prefix validateIcon" id="lastNameIcon"></i>
            <span class="helper-text shift" id="lastNameHelper"></span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <select class="browser-default" id="country" name="country">
              <option value="" disabled selected>Choose your Country</option>
              <?php
                foreach($countryList as $country){
                  $value = isset($_SESSION["tempCountry"]) && $country == $_SESSION["tempCountry"] ? "selected" : "";
                  echo "<option value='$country' $value" . ">" . $country . "</option>";
                }
              ?>
            </select>
            <label class="active">Country</label>
            <i class="material-icons prefix validateIcon" id="countryIcon"></i>
            <span class="helper-text shift" id="countryHelper"></span>
          </div>
          <div class="input-field col s6">
            <input id="city" type="text" class="validate" name="city" value="<?= $_SESSION["tempCity"] ?? "" ?>">
            <label for="city">City</label>
            <i class="material-icons prefix validateIcon" id="cityIcon"></i>
            <span class="helper-text shift" id="cityHelper"></span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 customFields" id="moveEmail">
            <i class="material-icons prefix">email</i>
            <input id="email" type="email" class="validate" name="email" value="<?= $_SESSION["tempEmail"] ?? "" ?>">
            <label for="email">Email</label>
            <i class="material-icons prefix validateIcon" id="emailIcon"></i>
            <span class="helper-text" id="emailHelper"></span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s11 customFields" id="movePassword">
            <i class="material-icons prefix">lock</i>
            <input id="password" type="password" class="validate" name="password"  value="<?= $_SESSION["tempPassword"] ?? "" ?>">
            <label for="password">Password</label>
            <i class="material-icons prefix visibleIcon" id="passwordVisibility">visibility</i>
            <i class="material-icons prefix validateIcon" id="passwordIcon"></i>
            <span class="helper-text" id="passwordHelper"></span>
          </div>
          <div class="input-field col s11 confirmPass" id="moveConfirm">
            <i class="material-icons prefix">lock</i>
            <input id="confirmPassword" type="password" class="validate" name="confirmPassword" value="<?= $_SESSION["tempConfirmPassword"] ?? "" ?>">
            <label for="confirmPassword">Confirm Password</label>
            <i class="material-icons prefix visibleIcon" id="confirmPasswordVisibility">visibility</i>
            <i class="material-icons prefix validateIcon" id="confirmPasswordIcon"></i>
            <span class="helper-text" id="confirmPasswordHelper"></span>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <button class="btn waves-effect waves-light disabled" type="submit" name="register" id="signUp">Submit
              <i class="material-icons right"></i>
            </button>
          </div>
        </div>
        <div class="row center-align">
          <div class="col s12">
            <span>Already Have an Account? <a href="../loginPage/login.php">Sign In</a></span>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="register.js"></script>
</body>

</html>
