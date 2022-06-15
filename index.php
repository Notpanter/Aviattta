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
    <title>Aviatravel</title>
    <link rel="shortcut icon" type="favicon.ico" href="AviaTrip-icon-1024x1024.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="index-style.css">
</head>
<body>
    <div class="wrapper">
        <header id="image-head">
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
                        <li><a href="#image-head">Home</a></li>
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
            <h1 class="title"> Travel. Live. See </h1>
        </header>
    </div>
<div class="content container">
    <form action="search.php" method="GET">
        <br>
        <h1 style="text-align: center;" id="tickets"> Where do you want to go? </h1>
        <br>
        <div class="row container" style="margin-left: auto; margin-right:auto" >
            <div class="input-group  mb-4" style="margin-left: auto; margin-right:auto">
                <input list="tur" type="" name="initial" placeholder="From" class="form-control bg-white border-md" required="">
                <input list="tur" type="" name="finish" placeholder="To" class="form-control bg-white border-md" required="">
                <datalist id="tur" class="main_form_list_drop">
                  <option value="Almaty"></option>
                  <option value="Nur_Sultan"></option>
                  <option value="Aktau"></option>
                  <option value="Taraz"></option>
                  <option value="Shymkent"></option>
                  <option value="Atyrau"></option>
                  <option value="Uralsk"></option>
                  <option value="Aktobe"></option>
                  <option value="Ust_Kamengorsk"></option>
                  <option value="Kokshetau"></option>
                  <option value="Karagandy"></option>
                  <option value="Kostanay"></option>
                  <option value="Kyzylorda"></option>
                  <option value="Pavlodar"></option>
                  <option value="Petropavlsk"></option>
                </datalist>
                <input id="date" type="date" name="date" placeholder="Date" class="form-control bg-white border-md" required="">
                <br>
                <br>
                <button class="btn btn-primary btn-block py-2" name="search" type="submit">Search for tickets</button>
            </div>
        </div>
    </form>
    <div class="row container" style="margin-left:auto; margin-right: auto; padding-right: 48px">
            <div class="card ml-5" style="width: 18rem;">
                <img class="card-img-top" src="https://www.expatica.com/app/uploads/sites/9/2017/07/cost-of-living-thun.jpg" alt="Card image cap">
                <div class="card-body">
                   <h5 class="card-title">Switzerland</h5>
                   <p class="card-text">Extending across the north and south side of the Alps in west-central Europe, Switzerland encompasses a great diversity of landscapes</p>
               </div>
           </div>
           <br>
        <div class="card ml-5" style="width: 18rem; ">
            <img class="card-img-top" src="https://www.iqconsultancy.ru/upload/iblock/660/MG_1_1_New_York_City-1.jpg" alt="Card image cap">
            <div class="card-body">
               <h5 class="card-title">United States</h5>
               <p class="card-text">The United States is a highly developed country, and continuously ranks high in measures of socioeconomic performance.</p>
           </div>
       </div>
       <br>
       <div class="card ml-5" style="width: 18rem;">
            <img class="card-img-top" src="https://www.enseignementsup-recherche.gouv.fr/sites/default/files/styles/full_width/public/imported_files/image/Fotolia_CARTE-EUROPE_1190748.jpg?itok=hWIKg1bc" alt="Card image cap">
            <div class="card-body">
               <h5 class="card-title">Europe</h5>
               <p class="card-text">Europe is a continent located entirely in the Northern Hemisphere and mostly in the Eastern Hemisphere.</p>
           </div>
       </div>
       <br>
</div>
<br>
<div class="row container" style="margin-left:auto; margin-right: auto; padding-right: 48px">
        <div class="card ml-5" style="width: 18rem;">
            <img class="card-img-top" src="https://www.worldlyadventurer.com/wp-content/uploads/2020/08/brazil-rio-de-janiero-bay-views-800x600.jpg" alt="Card image cap">
            <div class="card-body">
               <h5 class="card-title">South America</h5>
               <p class="card-text">The continent's cultural and ethnic outlook has its origin with the interaction of indigenous peoples with European conquerors and immigrants and, more locally, with African slaves.</p>
           </div>
       </div>
       <br>
        <div class="card ml-5" style="width: 18rem;">
            <img class="card-img-top" src="https://www.usnews.com/dims4/USNEWS/135e496/2147483647/thumbnail/640x420/quality/85/?url=http%3A%2F%2Fmedia.beam.usnews.com%2F45%2Fba%2Fa8172a8240ddbde1ab62a72ef8c8%2F160225-bali-stock.jpg" alt="Card image cap">
            <div class="card-body">
               <h5 class="card-title">Asia</h5>
               <p class="card-text">Given its size and diversity, the concept of Asia — a name dating back to classical antiquity — may actually have more to do with human geography than physical geography.Most Most</p>
           </div>
       </div>
       <br>
        <div class="card ml-5" style="width: 18rem;">
            <img class="card-img-top" src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MXx8YWZyaWNhfGVufDB8fDB8&ixlib=rb-1.2.1&w=1000&q=80" alt="Card image cap">
            <div class="card-body">
               <h5 class="card-title">Africa</h5>
               <p class="card-text">Africa straddles the Equator and encompasses numerous climate areas; it is the only continent to stretch from the northern temperate to southern temperate zones.</p>
           </div>
       </div>
       <br>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript" src="index.js"></script>
<script type="text/javascript" src="changebackground.js"></script>
</body>
</html>