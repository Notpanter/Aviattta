<?php

include 'config.php';

error_reporting(0);

session_start();

if ($_SESSION['usep']) {
  header('Location: index.php');
}else if ($_SESSION['user']){
  header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Log in</title>
  <link rel="shortcut icon" type="favicon.ico" href="AviaTrip-icon-1024x1024.ico">
  <meta name="robots" content="noindex">
  <link rel="canonical" href="https://codepen.io/shayanea/pen/eVMMgO">
  <link rel="stylesheet" type="text/css" href="pr.css">
  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeConsoleRunner-d8236034cc3508e70b0763f2575a8bb5850f9aea541206ce56704c013047d712.js"></script>
  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRefreshCSS-4793b73c6332f7f14a9b6bba5d5e62748e9d1bd0b5c52d7af6376f3d1c625d7e.js"></script>
  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRuntimeErrors-4f205f2c14e769b448bcf477de2938c681660d5038bc464e3700256713ebe261.js"></script>
</head>
<body>
    <div class="form-structor">
    <form action="register.php" method="GET">
      <div class="signup">
        <h2 class="form-title" id="signup" style="margin-bottom: -40px;"><span>or</span>Sign up</h2>
        <div class="form-holder">
          <input type="text" class="input" name="fname" placeholder="First Name" required>
          <input type="text" class="input" name="lname" placeholder="Last Name" required>
          <input type="email" class="input" name="email" placeholder="Email" required>
          <input type="phone" class="input" name="phone" placeholder="Phone" required>
          <input type="password" class="input" name="password" placeholder="Password" required>
          <input type="password" class="input" name="cpassword" placeholder="Confirm Password" required>
        </div>
        <p class="msg" style="color: #29C60A; margin-bottom: -5px;">
            <?php if ($_SESSION['msgcomp']) { echo $_SESSION['msgcomp'];}
            unset($_SESSION['msgcomp']);
            ?>
        </p>
        <p class="msg" style="color: #AB444E; margin-bottom: -5px;">
            <?php if ($_SESSION['msgemail']) {echo $_SESSION['msgemail'];}
            unset($_SESSION['msgemail']);
            ?>
        </p>
        <p class="msg" style="color: #AB444E; margin-bottom: -5px;">
            <?php if ($_SESSION['msg']) { echo $_SESSION['msg'];}
            unset($_SESSION['msg']);
            ?>
        </p>
        <button class="submit-btn" name="sign">Sign up</button>
      </div>
    </form>
    <form action="login.php" method="GET">
      <div class="login slide-up">
        <div class="center">
          <h2 class="form-title" id="login"><span>or</span>Log in</h2>
          <div class="form-holder">
            <input type="email" class="input" name="username" placeholder="Email">
            <input type="password" class="input" name="lpassword" placeholder="Password">
          </div>
          <p style="color: red;">
              <?php if ($_SESSION['messagepas']) { echo $_SESSION['messagepas'];}
              unset($_SESSION['messagepas']);
              ?>
            </p>
          <button class="submit-btn" name="log">Log in</button>
        </div>
      </div>
    </form>
  </div>
  <script src="pr.js"></script>
  <script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
  <script  src="https://cdpn.io/cp/internal/boomboom/pen.js?key=pen.js-489b19b3-0541-7d7f-7483-5aa43ac8e6bb" crossorigin></script>
</body>
</html>