<?php

include 'config.php';

session_start();

error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Reservation</title>
<link rel="shortcut icon" type="favicon.ico" href="AviaTrip-icon-1024x1024.ico">
<link href="http://netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link href="http://netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="buyTicket-style.css">
</head>
<body>
	<div class="wrapper">
        <header>
            <nav>
                <div class="menu-icon">
                    <i class="fa fa-bars fa-2x"></i>
                </div>
                <div class="logo">
                    AviaTravel
                    <img src="AviaTrip-icon-1024x1024.ico" alt="" width="50px" height="50px">
                </div>
                <div class="menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#tickets">Tickets</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <?php 
                        if ($_SESSION['usep']) { 
                            echo '<li><a href="profile.php">' .$_SESSION['usep']['fname'].'</a></li>';
                            echo '<li><a href="logout.php">Log out</a></li>';
                        }else if ($_SESSION['user']){
                            echo '<li><a href="profile.php">' .$_SESSION['user']['fname'].'</a></li>';
                            echo '<li><a href="logout.php">Log out</a></li>';
                        }else{
                            echo '<li><a href="pr.php">Log In</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </nav>
        </header>
    </div>
  <?php
  $id = $_GET['id'];
  $initial = $_GET['from'];
  $date = $_GET['date'];
  $sql = "SELECT * FROM $initial WHERE id='$id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $day_month_in = date('d M', strtotime($date));
  $day_month_fi = date('d M', strtotime($date));
  if ($row['finish_date'] == '2021-06-03') {
        $date_ket = date('Y-m-d',strtotime('+1 day',strtotime($date)));
        $day_month_fi = date('d M', strtotime('+1 day',strtotime($date)));
    }
  $time_in = $row['initial_time'];
  $hour_min_in = date('H:i', strtotime($time_in));
  $time_fi = $row['finish_time'];
  $hour_min_fi = date('H:i', strtotime($time_fi));
  $inter = (date("H", strtotime($time_fi))*60 + date("i", strtotime($time_fi))) - (date("H", strtotime($time_in))*60 + date("i", strtotime($time_in)));
  $h = $inter / 60;
    if ($h < 0) {
        $h = 24 + $h;
    }
    $m = $inter - intval($inter / 60) * 60;
    if ($m < 0) {
        $m = 60 + $m;
    }
  $price = $row['price'];
  ?>
  <form action="oplata.php" method="GET">
  	<div class="bas">
  		<div class="container">
        <input style="display: none;" type="text" name="initial" value="<?php echo 
        $row['initial'];?>">
        <input style="display: none;" type="text" name="finish" value="<?php echo 
        $row['finish'];?>">
        <input style="display: none;" type="date" name="date_in" value="<?php echo 
        $date;?>">
        <input style="display: none;" type="text" name="time_in" value="<?php echo 
        $row['initial_time'];?>">
        <input style="display: none;" type="date" name="date_fi" value="<?php if($row['finish_date'] == '2021-06-03'){ echo $date_ket;}else{echo $date;}?>">
        <input style="display: none;" type="text" name="time_fi" value="<?php echo 
        $row['finish_time'];?>">
        <input style="display: none;" type="text" name="company" value="<?php echo 
        $row['company'] ?>">
  			<div class="card" style="border-radius: 10px 10px; width: 80%; margin-left:auto; margin-right:auto">
              <div class="card-body">
                <div class="e-profile">
                  <div class="row">
                    <?php if ($row['company'] == 'AirAstana'){ echo'<img src="img/Air_Astana_logo.svg.png" width="200px" height="50px" >';} ?>
                    <?php if ($row['company'] == 'BekAir'){ echo'<img src="img/Bek_air.png" width="200px" height="50px" >';} ?>
                    <?php if ($row['company'] == 'FlyArystan'){ echo'<img src="img/FlyArystan_regular_logo.png" width="200px" height="50px" >';} ?>
                    <?php if ($row['company'] == 'ScatAirlines'){ echo'<img src="img/SCAT_Air_Company_Logo.svg.png" width="200px" height="50px" >';} ?>
                  </div>
                  <div class="tab-content pt-3">
                    <div class="tab-pane active">
                      <div class="row">
                        <div class="col">
                            <div class="row" style="border-top:solid; border-bottom:sold">
                                <div class="col">
                                  <div class="form-group">
                                    <h4 class="s">Departure time:</h4>
                                    <h4 class="d" name="date_inn"><?php echo $day_month_in;?></h4>
                                    <h4 class="t" name="time_inn"><?php echo $hour_min_in; ?></h4>
                                  </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <h4 class="s">Flight time:</p>
                                        <h4 class="s" name="interv"><?php echo intval($h)."h ".$m."m"?></h4>
                                      </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <h4 class="s">Landing time:</p>
                                        <h4 class="d" name="date_fii"><?php echo $day_month_fi; ?></h4>
                                        <h4 class="t" name="time_fii"><?php echo $hour_min_fi; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
  			<h3 style="color: #3A3737; margin: 10px;">Select a fare for flights</h3>
  			<div class="row container">
  			        <div class="col-md-4">
  			            <input type="radio" id="lite" checked="checked" name="tarif" value="Lite <?php echo intval($price); ?>" placeholder="">
          				<label for="lite" style="float:left">
          					<h3>Lite</h3>
          					<span>Hand luggage 1 bag (5 kg)</span><br>
          					<span style="color: green;">For an extra charge:</span><br>
          					<span>Baggage</span><br>
          					<span>Choosing a standard seat on board</span><br>
          					<span>Priority boarding (if available)</span><br>
          					<hr>
          					<h3 style="text-align: center;" name="pricelite"><?php echo intval($price); ?> ₸</h3>
          				</label>
  			        </div>
  			        <div class="col-md-4">
  			            <input type="radio" id="plus" name="tarif" value="Plus <?php echo intval($price*1.2); ?>" placeholder="">
          				<label for="plus" style="float:left">
          					<h3>Plus</h3>
          					<span>Hand luggage 1 bag (5 kg)</span><br>
          					<span>Checked baggage (20 kg)</span><br>
          					<span>Choosing a standard seat on board</span><br>
          					<span style="color: green;">For an extra charge:</span><br>
          					<span>Priority boarding (if available)</span><br>
          					<hr>
          					<h3 style="text-align: center;" name="priceplus"><?php echo intval($price*1.2); ?> ₸</h3>
          				</label>
  			        </div>
  			        <div class="col-md-4">
  			            <input type="radio" id="pro" name="tarif" value="Pro <?php echo intval($price*1.3); ?>" class="rad" placeholder="">
          				<label for="pro" style="float:left">
          					<h3>Pro</h3>
          					<span>Hand luggage 1 bag (10 kg)</span><br>
          					<span>Checked baggage (20 kg)</span><br>
          					<span>Free rebooking 1 time</span><br>
          					<span>Choice of any seat on board</span><br>
          					<span>Priority boarding (if available)</span><br>
          					<hr>
          					<h3 style="text-align: center; " name="pricepro"><?php echo intval($price*1.3); ?> ₸</h3>
          				</label>
  			        </div>
  			</div>
  			<h3>Personal Information</h3>
  			<div class="row">
  			    <div class="col">
  			        <label for="fname"><i class="fa fa-user"></i> First Name</label>
  					<input type="text" id="fname" name="fname" value="<?php if($_SESSION['usep']){ echo $_SESSION['usep']['fname'];}else if($_SESSION['user']){ echo $_SESSION['user']['fname'];} ?>" required>
  			    </div>
  			    <div class="col-12 col-sm-6 mb-3">
  			        <label for="lname"><i class="fa fa-user"></i> Last Name</label>
  					<input type="text" id="lname" name="lname" value="<?php if($_SESSION['usep']){ echo $_SESSION['usep']['lname'];}else if($_SESSION['user']){ echo $_SESSION['user']['lname'];} ?>" required>
  			    </div>
  			</div>
  			<div class="row">
  			    <div class="col">
  			        <label for="date"><i class="fa fa-calendar-o"></i> Date of Birth</label>
  					<input type="date" id="date" name="birthdate" required>
  			    </div>
  			    <div class="col-12 col-sm-6 mb-3">
  			        <label><i class="fa fa-venus-mars"></i> Gender</label>
  						<div class="row" style="margin-left: 5px; margin-bottom: 25px;">
  							<input type='radio' name="gender" id='male' checked='checked' value="male" required>
  							<label for='male' ><i class="fa fa-male"></i></label>
  							<input type='radio' name="gender" id='female' value="male">
  							<label for='female'><i class="fa fa-female"></i></label>
  						</div>
  			    </div>
  			</div>
  			<div class="row">
  			    <div class="col">
  			        <label for="godendo" ><i class="fa fa-calendar-check-o"></i> Passport expiration date</label>
  					<input type="date" id="godendo" name="godendo" required>
  			    </div>
  			    <div class="col-12 col-sm-6 mb-3">
  			        <label for="docnum"><i class="fa fa-id-card-o"></i> Document Number</label>
  					<input type="text" id="docnum" name="docnum" required>
  			    </div>
  			</div>
  			<div class="row">
  			    <div class="col">
  			        <label for="iin" ><i class="fa fa-id-card" n></i> ID</label>
  					<input type="text" id="iin" name="yyn" required>
  			    </div>
  			    <div class="col-12 col-sm-6 mb-3">
  			        <label for="country"><i class="fa fa-globe"></i> Citizenship</label>
  					<input list="tur" type="text" id="country" name="country" value="" required>
  			        <datalist id="tur">
                      <option value="AF">Afghanistan</option>
                      <option value="AX">Åland Islands</option>
                      <option value="AL">Albania</option>
                      <option value="DZ">Algeria</option>
                      <option value="AS">American Samoa</option>
                      <option value="AD">Andorra</option>
                      <option value="AO">Angola</option>
                      <option value="AI">Anguilla</option>
                      <option value="AQ">Antarctica</option>
                      <option value="AG">Antigua and Barbuda</option>
                      <option value="AR">Argentina</option>
                      <option value="AM">Armenia</option>
                      <option value="AW">Aruba</option>
                      <option value="AU">Australia</option>
                      <option value="AT">Austria</option>
                      <option value="AZ">Azerbaijan</option>
                      <option value="BS">Bahamas</option>
                      <option value="BH">Bahrain</option>
                      <option value="BD">Bangladesh</option>
                      <option value="BB">Barbados</option>
                      <option value="BY">Belarus</option>
                      <option value="BE">Belgium</option>
                      <option value="BZ">Belize</option>
                      <option value="BJ">Benin</option>
                      <option value="BM">Bermuda</option>
                      <option value="BT">Bhutan</option>
                      <option value="BO">Bolivia, Plurinational State of</option>
                      <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                      <option value="BA">Bosnia and Herzegovina</option>
                      <option value="BW">Botswana</option>
                      <option value="BV">Bouvet Island</option>
                      <option value="BR">Brazil</option>
                      <option value="IO">British Indian Ocean Territory</option>
                      <option value="BN">Brunei Darussalam</option>
                      <option value="BG">Bulgaria</option>
                      <option value="BF">Burkina Faso</option>
                      <option value="BI">Burundi</option>
                      <option value="KH">Cambodia</option>
                      <option value="CM">Cameroon</option>
                      <option value="CA">Canada</option>
                      <option value="CV">Cape Verde</option>
                      <option value="KY">Cayman Islands</option>
                      <option value="CF">Central African Republic</option>
                      <option value="TD">Chad</option>
                      <option value="CL">Chile</option>
                      <option value="CN">China</option>
                      <option value="CX">Christmas Island</option>
                      <option value="CC">Cocos (Keeling) Islands</option>
                      <option value="CO">Colombia</option>
                      <option value="KM">Comoros</option>
                      <option value="CG">Congo</option>
                      <option value="CD">Congo, the Democratic Republic of the</option>
                      <option value="CK">Cook Islands</option>
                      <option value="CR">Costa Rica</option>
                      <option value="CI">Côte d'Ivoire</option>
                      <option value="HR">Croatia</option>
                      <option value="CU">Cuba</option>
                      <option value="CW">Curaçao</option>
                      <option value="CY">Cyprus</option>
                      <option value="CZ">Czech Republic</option>
                      <option value="DK">Denmark</option>
                      <option value="DJ">Djibouti</option>
                      <option value="DM">Dominica</option>
                      <option value="DO">Dominican Republic</option>
                      <option value="EC">Ecuador</option>
                      <option value="EG">Egypt</option>
                      <option value="SV">El Salvador</option>
                      <option value="GQ">Equatorial Guinea</option>
                      <option value="ER">Eritrea</option>
                      <option value="EE">Estonia</option>
                      <option value="ET">Ethiopia</option>
                      <option value="FK">Falkland Islands (Malvinas)</option>
                      <option value="FO">Faroe Islands</option>
                      <option value="FJ">Fiji</option>
                      <option value="FI">Finland</option>
                      <option value="FR">France</option>
                      <option value="GF">French Guiana</option>
                      <option value="PF">French Polynesia</option>
                      <option value="TF">French Southern Territories</option>
                      <option value="GA">Gabon</option>
                      <option value="GM">Gambia</option>
                      <option value="GE">Georgia</option>
                      <option value="DE">Germany</option>
                      <option value="GH">Ghana</option>
                      <option value="GI">Gibraltar</option>
                      <option value="GR">Greece</option>
                      <option value="GL">Greenland</option>
                      <option value="GD">Grenada</option>
                      <option value="GP">Guadeloupe</option>
                      <option value="GU">Guam</option>
                      <option value="GT">Guatemala</option>
                      <option value="GG">Guernsey</option>
                      <option value="GN">Guinea</option>
                      <option value="GW">Guinea-Bissau</option>
                      <option value="GY">Guyana</option>
                      <option value="HT">Haiti</option>
                      <option value="HM">Heard Island and McDonald Islands</option>
                      <option value="VA">Holy See (Vatican City State)</option>
                      <option value="HN">Honduras</option>
                      <option value="HK">Hong Kong</option>
                      <option value="HU">Hungary</option>
                      <option value="IS">Iceland</option>
                      <option value="IN">India</option>
                      <option value="ID">Indonesia</option>
                      <option value="IR">Iran, Islamic Republic of</option>
                      <option value="IQ">Iraq</option>
                      <option value="IE">Ireland</option>
                      <option value="IM">Isle of Man</option>
                      <option value="IL">Israel</option>
                      <option value="IT">Italy</option>
                      <option value="JM">Jamaica</option>
                      <option value="JP">Japan</option>
                      <option value="JE">Jersey</option>
                      <option value="JO">Jordan</option>
                      <option value="KZ">Kazakhstan</option>
                      <option value="KE">Kenya</option>
                      <option value="KI">Kiribati</option>
                      <option value="KP">Korea, Democratic People's Republic of</option>
                      <option value="KR">Korea, Republic of</option>
                      <option value="KW">Kuwait</option>
                      <option value="KG">Kyrgyzstan</option>
                      <option value="LA">Lao People's Democratic Republic</option>
                      <option value="LV">Latvia</option>
                      <option value="LB">Lebanon</option>
                      <option value="LS">Lesotho</option>
                      <option value="LR">Liberia</option>
                      <option value="LY">Libya</option>
                      <option value="LI">Liechtenstein</option>
                      <option value="LT">Lithuania</option>
                      <option value="LU">Luxembourg</option>
                      <option value="MO">Macao</option>
                      <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                      <option value="MG">Madagascar</option>
                      <option value="MW">Malawi</option>
                      <option value="MY">Malaysia</option>
                      <option value="MV">Maldives</option>
                      <option value="ML">Mali</option>
                      <option value="MT">Malta</option>
                      <option value="MH">Marshall Islands</option>
                      <option value="MQ">Martinique</option>
                      <option value="MR">Mauritania</option>
                      <option value="MU">Mauritius</option>
                      <option value="YT">Mayotte</option>
                      <option value="MX">Mexico</option>
                      <option value="FM">Micronesia, Federated States of</option>
                      <option value="MD">Moldova, Republic of</option>
                      <option value="MC">Monaco</option>
                      <option value="MN">Mongolia</option>
                      <option value="ME">Montenegro</option>
                      <option value="MS">Montserrat</option>
                      <option value="MA">Morocco</option>
                      <option value="MZ">Mozambique</option>
                      <option value="MM">Myanmar</option>
                      <option value="NA">Namibia</option>
                      <option value="NR">Nauru</option>
                      <option value="NP">Nepal</option>
                      <option value="NL">Netherlands</option>
                      <option value="NC">New Caledonia</option>
                      <option value="NZ">New Zealand</option>
                      <option value="NI">Nicaragua</option>
                      <option value="NE">Niger</option>
                      <option value="NG">Nigeria</option>
                      <option value="NU">Niue</option>
                      <option value="NF">Norfolk Island</option>
                      <option value="MP">Northern Mariana Islands</option>
                      <option value="NO">Norway</option>
                      <option value="OM">Oman</option>
                      <option value="PK">Pakistan</option>
                      <option value="PW">Palau</option>
                      <option value="PS">Palestinian Territory, Occupied</option>
                      <option value="PA">Panama</option>
                      <option value="PG">Papua New Guinea</option>
                      <option value="PY">Paraguay</option>
                      <option value="PE">Peru</option>
                      <option value="PH">Philippines</option>
                      <option value="PN">Pitcairn</option>
                      <option value="PL">Poland</option>
                      <option value="PT">Portugal</option>
                      <option value="PR">Puerto Rico</option>
                      <option value="QA">Qatar</option>
                      <option value="RE">Réunion</option>
                      <option value="RO">Romania</option>
                      <option value="RU">Russian Federation</option>
                      <option value="RW">Rwanda</option>
                      <option value="BL">Saint Barthélemy</option>
                      <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                      <option value="KN">Saint Kitts and Nevis</option>
                      <option value="LC">Saint Lucia</option>
                      <option value="MF">Saint Martin (French part)</option>
                      <option value="PM">Saint Pierre and Miquelon</option>
                      <option value="VC">Saint Vincent and the Grenadines</option>
                      <option value="WS">Samoa</option>
                      <option value="SM">San Marino</option>
                      <option value="ST">Sao Tome and Principe</option>
                      <option value="SA">Saudi Arabia</option>
                      <option value="SN">Senegal</option>
                      <option value="RS">Serbia</option>
                      <option value="SC">Seychelles</option>
                      <option value="SL">Sierra Leone</option>
                      <option value="SG">Singapore</option>
                      <option value="SX">Sint Maarten (Dutch part)</option>
                      <option value="SK">Slovakia</option>
                      <option value="SI">Slovenia</option>
                      <option value="SB">Solomon Islands</option>
                      <option value="SO">Somalia</option>
                      <option value="ZA">South Africa</option>
                      <option value="GS">South Georgia and the South Sandwich Islands</option>
                      <option value="SS">South Sudan</option>
                      <option value="ES">Spain</option>
                      <option value="LK">Sri Lanka</option>
                      <option value="SD">Sudan</option>
                      <option value="SR">Suriname</option>
                      <option value="SJ">Svalbard and Jan Mayen</option>
                      <option value="SZ">Swaziland</option>
                      <option value="SE">Sweden</option>
                      <option value="CH">Switzerland</option>
                      <option value="SY">Syrian Arab Republic</option>
                      <option value="TW">Taiwan, Province of China</option>
                      <option value="TJ">Tajikistan</option>
                      <option value="TZ">Tanzania, United Republic of</option>
                      <option value="TH">Thailand</option>
                      <option value="TL">Timor-Leste</option>
                      <option value="TG">Togo</option>
                      <option value="TK">Tokelau</option>
                      <option value="TO">Tonga</option>
                      <option value="TT">Trinidad and Tobago</option>
                      <option value="TN">Tunisia</option>
                      <option value="TR">Turkey</option>
                      <option value="TM">Turkmenistan</option>
                      <option value="TC">Turks and Caicos Islands</option>
                      <option value="TV">Tuvalu</option>
                      <option value="UG">Uganda</option>
                      <option value="UA">Ukraine</option>
                      <option value="AE">United Arab Emirates</option>
                      <option value="GB">United Kingdom</option>
                      <option value="US">United States</option>
                      <option value="UM">United States Minor Outlying Islands</option>
                      <option value="UY">Uruguay</option>
                      <option value="UZ">Uzbekistan</option>
                      <option value="VU">Vanuatu</option>
                      <option value="VE">Venezuela, Bolivarian Republic of</option>
                      <option value="VN">Viet Nam</option>
                      <option value="VG">Virgin Islands, British</option>
                      <option value="VI">Virgin Islands, U.S.</option>
                      <option value="WF">Wallis and Futuna</option>
                      <option value="EH">Western Sahara</option>
                      <option value="YE">Yemen</option>
                      <option value="ZM">Zambia</option>
                      <option value="ZW">Zimbabwe</option>
                    </datalist>
  			    </div>
  			</div>
  			<h3>Contact Information</h3>
  			<div class="row">
  				<div class="col">
  					<label for="email"><i class="fa fa-envelope"></i> Email</label>
  					<input type="email" id="email" name="email" value="<?php if($_SESSION['usep']){ echo $_SESSION['usep']['email'];}else if($_SESSION['user']){ echo $_SESSION['user']['email'];} ?>" required>
  				</div>
  				<div class="col-12 col-sm-6 mb-3">
  					<label for="telnum"><i class="fa fa-phone" aria-hidden="true"></i> Phone Number</label>
  					<input type="phone" id="telnum" name="phone" value="<?php if($_SESSION['usep']){ echo $_SESSION['usep']['phone'];}else if($_SESSION['user']){ echo $_SESSION['user']['phone'];} ?>" required>
  				</div>
  			</div>
  			<button type="submit" class="btn btn-primary btn-block py-2" style="border-color: #8390E5; background-color:#8390E5; " name="book">Book now</button>
  		</div>
  	   </div>
  	</div>
  </form>
	<footer class="text-center text-lg-start bg-light text-muted">
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <div class="me-5 d-none d-lg-block">
          <span>Get connected with us on social networks:</span>
        </div>
       <div>
                 <a href="https://www.facebook.com" class="me-4 text-reset"><img class="foofot" width="25px" height="25px" src="img/facebook.png" alt=""></a>
                 <a href="https://www.instagram.com" class="me-4 text-reset"><img class="foofot" width="25px" height="25px" src="img/instagram.png" alt=""></a>
                 <a href="https://www.tiktok.com" class="me-4 text-reset"><img class="foofot" width="25px" height="25px" src="img/tik-tok.png" alt=""></a>
                 <a href="https://www.youtube.com" class="me-4 text-reset"><img class="foofot" width="25px" height="25px" src="img/youtube.png" alt=""></a>
              </div>
    </section>
    <section class="fot">
       <div class="container text-center text-md-start mt-5">
            <div class="row mt-3">
              <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                <p><img width="22px" height="22px" src="img/home-175.png" alt=""><a href="https://www.google.com/maps/place/Astana+IT+University/@51.0908492,71.4161342,17z/data=!3m1!4b1!4m5!3m4!1s0x424585a605525605:0x4dff4a1973f7567e!8m2!3d51.0908492!4d71.4183229" style="text-decoration: none; color: #7D7B7B;"> Turkistan st., Nur-Sultan, KZ </a></p>
                                   <p><img width="22px" height="22px" src="img/website-4945.png" alt=""><a href="https://astanait.edu.kz/" style="text-decoration: none; color: #7D7B7B;"> www.aviatravel.kz </a></p>
                                   <p><img width="22px" height="22px" src="img/phone-504.png" alt="" style="color: #7D7B7B;"> +7 747 627 03 47</p>
                               </div>
                           </div>
                       </div>
                   </section>
                   <div class="text-center p-4" style="background-color: black">
                        © 2022 Talgat|MaKo|Astan|Asylkhan SE2103</div>
  </footer>
  <script src="navbar.js" type="text/javascript" charset="utf-8" async defer></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>