<?php

include 'config.php';

session_start();

error_reporting(0);


if (isset($_POST['savechange'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $sql = "UPDATE users SET Fname = '$fname', Lname ='$lname', Phone = '$phone' WHERE Email = '$email'";
  $mysql = "SELECT * FROM users WHERE Email='$email'";
  $res = mysqli_query($conn, $sql);
  $pes = mysqli_query($conn, $mysql);
  if ($res) {
    $_SESSION['msgsv'] = 'Data changed successfully!';
    $row = mysqli_fetch_assoc($pes);
    $_SESSION['usep'] =[
      "fname" => $row['Fname'],
      "lname" => $row['Lname'],
      "phone" => $row['Phone']
    ];
  }
}

if (isset($_POST['changepass'])) {
  $email = $_POST['email'];
  $oldpass = md5($_POST['oldpass']);
  $newpass = md5($_POST['newpass']);
  $conpass = md5($_POST['conpass']);


  if ($oldpass == $_SESSION['user']['cpass']) {
    if ($newpass == $conpass) {
      $sql = "UPDATE users SET Password = '$newpass' WHERE Email = '$email'";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $_SESSION['msgcom'] = 'Password changed!';
      }
    }else{
      $_SESSION['msg'] = 'Password mismatch!';
    }
  }else{
    $_SESSION['message'] = 'Incorrect password!';
  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Profile</title>
  <link rel="shortcut icon" type="favicon.ico" href="AviaTrip-icon-1024x1024.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="profile-style.css">
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
                        <li><a href="contactus/index.php">Contact</a></li>
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
  <div class="container">
    <div class="row flex-lg-nowrap">
      <div class="col">
        <div class="row">
          <div class="col mb-3">
            <div class="card">
              <div class="card-body">
                <div class="e-profile">
                  <div class="row">
                    <div class="col-12 col-sm-auto mb-3">
                      <div class="mx-auto" style="width: 140px;">
                        <img width="140px" height="140px" src="img/person-295.png" alt="">
                      </div>
                    </div>
                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                      <h1 class="pt-sm-2 pb-1 mb-0 text-nowrap" style="margin-top: 40px">
                        <?php if($_SESSION['usep']){ echo $_SESSION['usep']['fname'];}else if($_SESSION['user']){ echo $_SESSION['user']['fname'];} ?>
                      </h1>
                    </div>
                  </div>
                  <form action="" method="POST">
                    <div class="tab-content pt-3">
                      <div class="tab-pane active">
                        <form class="form">
                          <div class="row">
                            <div class="col">
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" type="firstname" name="fname" placeholder="" value="<?php if($_SESSION['usep']){ echo $_SESSION['usep']['fname'];}else if($_SESSION['user']){ echo $_SESSION['user']['fname'];} ?>">
                                  </div>
                                  <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" type="lastname" name="lname" placeholder="" value="<?php if($_SESSION['usep']){ echo $_SESSION['usep']['lname'];}else if($_SESSION['user']){ echo $_SESSION['user']['lname'];} ?>">
                                  </div>
                                  <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" name="email" placeholder="" value="<?php if($_SESSION['user']){ echo $_SESSION['user']['email'];}else if($_SESSION['user']){ echo $_SESSION['user']['email'];} ?>" readonly>
                                  </div>
                                  <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" type="phone" name="phone" placeholder="" value="<?php if($_SESSION['usep']){ echo $_SESSION['usep']['phone'];}else if($_SESSION['user']){ echo $_SESSION['user']['phone'];} ?>">
                                    <p class="msg" style="color: green">
                                      <?php if ($_SESSION['msgsv']) { echo $_SESSION['msgsv'];} unset($_SESSION['msgsv']);?>
                                    </p>
                                  </div>
                                  <div class="row">
                                    <div class="col d-flex justify-content-end">
                                      <button class="btn btn-primary" name="savechange" style="margin-left: 395px">Save Changes</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Current Password</label>
                                    <input class="form-control" type="password" placeholder="••••••" name="oldpass">
                                    <p style="color: red"><?php if ($_SESSION['message']) { echo $_SESSION['message'];} unset($_SESSION['message']);?></p>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>New Password</label>
                                    <input class="form-control" type="password" placeholder="••••••" name="newpass">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                    <input class="form-control" type="password" placeholder="••••••" name="conpass">
                                    <p class="msg" style="color: red"><?php if ($_SESSION['msg']) { echo $_SESSION['msg'];} unset($_SESSION['msg']); ?></p>
                                    <p class="msg" style="color: green">
                                      <?php if ($_SESSION['msgcom']) { echo $_SESSION['msgcom'];} unset($_SESSION['msgcom']);?></p>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                <div class="col d-flex justify-content-end">
                                  <button class="btn btn-primary" name="changepass">Change Password</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <a href="index.php" style="text-decoration: none;"><button type="submit" class="btn btn-primary btn-block py-2" style="margin-top: 20px;">&#8592;Back to Main page</button></a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <h1 id="tick" style="text-align: center; color: white;">Tickets</h1>
    <?php
    if($_SESSION['user']){
      $em = $_SESSION['user']['email'];
    }else if($_SESSION['user']){
      $em = $_SESSION['user']['email'];
    }
    $sql1 = "SELECT * from reservation WHERE email='$em'";
    $res1 = mysqli_query($conn, $sql1);
    while($row = mysqli_fetch_assoc($res1)){
      $string = $row['tarif_and_price'];
      $price = (int) filter_var($string, FILTER_SANITIZE_NUMBER_INT);
      preg_match_all('!\D+!', $string, $matches);
      $tarif = implode(' ', $matches[0]);

      $date_in = $row['initial_date'];
      $day_month_in = date('d M Y', strtotime($date_in));
      $date_fi = $row['finish_date'];
      $day_month_fi = date('d M Y', strtotime($date_fi));
      $time_in = $row['initial_time'];
      $hour_min_in = date('H:i', strtotime($time_in));
      $time_fi = $row['finish_time'];
      $hour_min_fi = date('H:i', strtotime($time_fi));
      $inter = (date("H", strtotime($time_fi))*60 + date("i", strtotime($time_fi))) - (date("H", strtotime($time_in))*60 + date("i", strtotime($time_in)));
      $h = $inter / 60;
      $m = $inter - intval($h) * 60;
      ?>
    <div class="row flex-lg-nowrap" style="font-family: Courier New, monospace;">
      <div class="col">
        <div class="row">
          <div class="col mb-3">
            <div class="card">
              <div class="card-body">
                <h3>Reservation code: <?php echo $row['reservcode']; ?></h3>
                <div>
                  <div class="row">
                    <div class="col">
                      <p class="zagol">Passenger:</p>
                    </div>
                    <div class="col">
                      <p class="zagol">Passport:</p>
                    </div>
                    <div class="col">
                      <p class="zagol">Ticket Number:</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <p class=""><?php if ($row['gender'] == 'male') {echo 'MR ';}else{echo 'MRS ';} echo $row['fname']?> <?php echo $row['lname']?></p>
                    </div>
                    <div class="col">
                      <p class=""><?php echo $row['country']?> <?php echo $row['docnum']?></p>
                    </div>
                    <div class="col">
                      <p class=""><?php echo $row['ticknum']?></p>
                    </div>
                  </div>
                </div>
                <hr>
                <div>
                  <div class="row">
                    <div class="col">
                      <p class="zagol">Origin:</p>
                    </div>
                    <div class="col">
                      <p class="zagol">Destination:</p>
                    </div>
                    <div class="col">
                      <p class="zagol">Flight Time:</p>
                    </div>
                    <div class="col">
                      <p class="zagol">Company:</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <p class=""><?php echo $hour_min_in?> <?php echo $day_month_in?></p>
                      <p class=""><?php echo $row['initial']?></p>
                    </div>
                    <div class="col">
                      <p class=""><?php echo $hour_min_fi?> <?php echo $day_month_fi?> </p>
                      <p class=""><?php echo $row['finish']?></p>
                    </div>
                    <div class="col">
                      <p class=""><?php echo intval($h)."h ".$m."m"?></p>
                    </div>
                    <div class="col">
                      <p class=""><?php echo $row['company']?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <h4 class="zagol"><?php echo $tarif ?></h4>
                    </div>
                  </div>
                  <?php if ($tarif == 'Lite ') { ?>
                  <div class="row">
                    <div class="col">
                      <span style="font-weight: bold;">Contains:</span><br>
                      <span>Hand luggage 1 bag (5 kg)</span><br>
                    </div>
                    <div class="col">
                      <span style="font-weight: bold;">For an extra charge:</span><br>
                      <span>Baggage</span><br>
                      <span>Choosing a standard seat on board</span><br>
                      <span>Priority boarding (if available)</span><br>
                    </div>
                  </div>
                  <?php };
                  if ($tarif == 'Plus '){?>
                  <div class="row">
                    <div class="col">
                      <span style="font-weight: bold;">Contains:</span><br>
                      <span>Hand luggage 1 bag (5 kg)</span><br>
                      <span>Checked baggage (20 kg)</span><br>
                      <span>Choice of any seat on board</span><br>
                    </div>
                    <div class="col">
                      <span style="font-weight: bold;">For an extra charge:</span><br>
                      <span>Priority boarding (if available)</span><br>
                    </div>
                  </div>
                  <?php
                  };
                  if ($tarif == 'Pro '){?>
                  <div class="row">
                    <div class="col">
                      <span style="font-weight: bold;">Contains:</span><br>
                      <span>Hand luggage 1 bag (5 kg)</span><br>
                      <span>Checked baggage (20 kg)</span><br>
                      <span>Free rebooking 1 time</span><br>
                      <span>Choice of any seat on board</span><br>
                      <span>Priority boarding (if available)</span><br>
                    </div>
                    <div class="col">

                    </div>
                  </div>
                  <?php
                  }; ?>
                  <div class="row">
                    <div class="col">
                      <h4 style="margin-top: 10px;" class="zagol">Total price: <?php echo $price ?> KZT</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    }
    ?>
  </div>
  <script src="navbar.js" type="text/javascript" charset="utf-8" async defer></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>s
</body>
</html>