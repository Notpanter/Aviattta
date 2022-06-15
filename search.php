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
  <title><?php echo $_GET['initial'].' &#8594; '.$_GET['finish'];  ?></title>
  <link rel="shortcut icon" type="favicon.ico" href="AviaTrip-icon-1024x1024.ico">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="search-style.css">
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
  <div class="bas">
    <div class="content container">
      <form action="search.php" method="GET">
        <h1 style="text-align: center" id="tickets"> Where do you want to go? </h1>
        <br>
        <div class="input-group col-lg-12 mb-4">
            <input list="tur" type="" name="initial" placeholder="From" class="form-control bg-white border-md" value="<?php echo $_GET['initial'] ?>" style="border-radius: 8px;">
            <input list="tur" type="" name="finish" placeholder="To" class="form-control bg-white border-md" value="<?php echo $_GET['finish'] ?>" style="border-radius: 8px;">
            <datalist id="tur" class="main_form_list_drop">
              <option value="Almaty"></option>
              <option value="Nur_Sultan"></option>
              <option value="Aktau"></option>
              <option value="Taraz"></option>
              <option value="Shymkent"></option>
              <option value="Atyrau"></option>
              <option value="Uralsk"></option>
              <option value="Aktobe"></option>
              <option value="Ust_Kamenagorsk"></option>
              <option value="Kokshetau"></option>
              <option value="Karagandy"></option>
              <option value="Kostanay"></option>
              <option value="Kyzylorda"></option>
              <option value="Pavlodar"></option>
              <option value="Petropavlsk"></option>
            </datalist>
            <input id="date" type="date" name="date" placeholder="Date" class="form-control bg-white border-md" value="<?php echo $_GET['date'] ?>" style="border-radius: 8px;">
        </div>
        <div class="form-group col-lg-12 mx-auto mb-0">
            <button class="btn btn-primary btn-block py-2" name="search" type="submit">Search for tickets</button>
        </div>
      <h2 style="margin-top: 30px;"><?php echo $_GET['initial'];?> &#8594; <?php echo $_GET['finish'];?></h2>
      </form>
      <br>
        <?php 
        $input_date = $_GET['date'];
        $date=date("Y-m-d",strtotime($input_date));
        $initial = strtolower($_GET['initial']);
        $finish = strtolower($_GET['finish']);
        $order = 'initial_time';
        $sort = 'ASC';
        $sql = "SELECT * FROM $initial WHERE finish='$finish' ORDER BY rand()";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
          $day_month_in = date('d M', strtotime($input_date));
          $day_month_fi = date('d M', strtotime($input_date));
          if ($row['finish_date'] == '2021-06-03') {
            $day_month_fi = date('d M', strtotime('+1 day',strtotime($input_date)));
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
          ?>
          <form action="" method="POST">
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
                                <div class="col-12 col-sm-6 mb-3">
                                  <div class="form-group">
                                      <p>Departure time:</p>
                                    <p class="d" name="date_inn"><?php echo $day_month_in;?></p>
                                    <p class="t" name="time_inn"><?php echo $hour_min_in; ?></p>
                                  </div>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <p>Landing time:</p>
                                        <p class="d" name="date_fii"><?php echo $day_month_fi; ?></p>
                                        <p class="t" name="time_fii"><?php echo $hour_min_fi; ?></p>
                                      </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <p>Flight time:</p>
                                        <p name="interv"><?php echo intval($h)."h ".$m."m"?></p>
                                      </div>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <h3 name="baga"><?php echo $row['price']; ?>₸</h3>
                                        <a href="buyTicket.php?from=<?php echo $initial;?>&id=<?php echo$row['id']?>&datein=<?php echo $input_date ?>" title=""><button type="button" class="btn btn-primary">Buy now</button></a>
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
            </form>
            <?php
            }
            ?>
    </div>
  </div>
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
  <section class="fot" id="contact">
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