<?php

include 'config.php';

session_start();

error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Thanks</title>
  <link rel="shortcut icon" type="favicon.ico" href="AviaTrip-icon-1024x1024.ico">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="last.css">
</head>
<body>
    <div class="container">
        <div class="jumbotron text-center">
          <h1 class="display-3">Thank You!</h1><br>
          <i class="fa fa-check main-content__checkmark fa-5x" id="checkmark"></i><br>
          <p class="lead">Thank you for using our services.<br>We have sent a ticket to your email. <strong>Please check your email</strong></p>
          <hr>
          <p>
            Having trouble? <a href="contactus/index.php">Contact us</a>
          </p>
          <p class="lead">
            <a  class="btn btn-primary" href="index.php" role="button">Continue to homepage</a>
          </p>
        </div>
    </div>
</body>
</html>