<?php
session_start();
if (isset($_POST['planifier-1']) || isset($_POST['planifier-2']) || isset($_POST['planifier-3'])) {
  if (!isset($_SESSION["email"])) {
    header("location: register.php");
    exit();
  } else {
    if (isset($_POST['planifier-1'])) {
      $_SESSION["service"] = 1;
      header("location: planifier.php");
    } else if (isset($_POST['planifier-2'])) {
      $_SESSION["service"] = 2;
      header("location: planifier.php");
    } else if (isset($_POST['planifier-3'])) {
      $_SESSION["service"] = 3;
      header("location: planifier.php");
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
  <title>Services</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- bootstrap css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <!-- style css -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- Responsive-->
  <link rel="stylesheet" href="css/responsive.css">
  <!-- fevicon -->
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
  <!-- Tweaks for older IEs-->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <!-- owl stylesheets -->
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style type="text/css">
    .price-innerdetail h5 {
      font-weight: 400;
      letter-spacing: 2px;
      font-size: 15px;
    }

    .price-innerdetail p {
      font-size: 50px;
    }

    .detail-pricing {
      border-bottom: 1px solid;
      padding: 30px 0 30px 0;
    }

    .detail-pricing .float-left {
      padding: 0 0 0 40px;
    }

    .detail-pricing .float-left i {
      position: absolute;
      left: 0;
      font-size: 20px;
    }

    .detail-pricing span {
      display: inline-block;
      position: relative;
      font-weight: 400;
    }

    .wrap-price {
      background: rgba(32, 33, 36, 0.1);
      padding: 50px 20px 50px;
      border-radius: 10px;
      height: 50vh;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .center-wrap {
      background: #7FFFD4;
    }

    .service-section {
      margin-top: 6%;
    }
  </style>
</head>

<body>
  <!--header section start -->
  <div class="header_section background_bg">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="logo"><a href="index.php"><img src="images/logo.png"></a></div>
        </div>
        <div class="col-md-9">
          <div class="menu_text">
            <ul>
              <div id="myNav" class="overlay">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <div class="overlay-content">
                  <a href="index.php">Home</a>
                  <a href="about.php">About</a>
                  <a href="services.php">Services</a>
                  <a href="client.php">Client</a>
                  <a href="register.php">signup</a>
                </div>
              </div>
              <span class="navbar-toggler-icon"></span>
              <span onclick="openNav()"><img src="images/toogle-icon.png" class="toggle_menu"></span>
          </div>
          </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- header section end -->
  <!-- pricing section start -->
  <section id="price-section" class="service-section">
    <div class="container">
      <div class="row justify-content-center gapsectionsecond">
        <div class="col-lg-7 text-center">
          <div class="title-big pb-3 mb-3">
            <h3>Tarifs de nos Services</h3>
          </div>
          <h5 class="description-p text-muted pe-0 pe-lg-0">
            Nous proposons une gamme de services adaptés à vos besoins. Nos tarifs de base commencent à partir de :
          </h5>
        </div>
      </div>
      <!-- Consultation juridique -->
      <div class="row pt-5">
        <div class="col-lg-4 pb-5 pb-lg-0">
          <div class="wrap-price">
            <div class="price-innerdetail text-center">
              <h5>Consultation juridique</h5>
              <p class="prices">50.00$</p>
              <div class="detail-pricing">
                <span class="float-left">
                  <i class="bi bi-check2-circle"></i>
                  Consultation Duration
                </span>
                <span class="float-right">2 Heures</span>
              </div>
              <div class="detail-pricing">
                <span class="float-left">
                  <i class="bi bi-check2-circle"></i> Conseils et orientations juridiques</span>

              </div>
              <div class="detail-pricing">
                <span class="float-left">
                  <i class="bi bi-check2-circle"></i> examen de la documentation</span>
              </div>
            </div>
            <form class="w-100" method="POST">
              <input type="submit" name="planifier-1" value="Planifier" class="btn w-75 btn-secondary mx-5" />
            </form>
          </div>
        </div>
        <!-- Conseil en affaires -->
        <div class="col-lg-4 pb-5 pb-lg-0">
          <div class="wrap-price center-wrap">
            <div class="price-innerdetail text-center">
              <h5>Conseil en affaires</h5>
              <p class="prices">80.00$</p>
              <div class="detail-pricing">
                <span class="float-left">
                  <i class="bi bi-check2-circle"></i>
                  Consultation Duration
                </span>
                <span class="float-right">2 Heures</span>
              </div>
              <div class="detail-pricing">
                <span class="float-left">
                  <i class="bi bi-check2-circle"></i> Développement de stratégie commerciale
              </div>
              <div class="detail-pricing">
                <span class="float-left">
                  <i class="bi bi-check2-circle"></i> Analyse financière
              </div>
            </div>
            <form method="POST" class="w-100">
              <input type="submit" name="planifier-2" value="Planifier" class="btn w-75 btn-secondary mx-5" />
            </form>
          </div>
        </div>
        <!-- Consultation financière -->
        <div class="col-lg-4 pb-5 pb-lg-0">
          <div class="wrap-price">
            <div class="price-innerdetail text-center">
              <h5>Consultation financière</h5>
              <p class="prices">65.00$</p>
              <div class="detail-pricing">
                <span class="float-left">
                  <i class="bi bi-check2-circle"></i>
                  Consultation Duration
                </span>
                <span class="float-right">2 Heures</span>
              </div>
              <div class="detail-pricing">
                <span class="float-left">
                  <i class="bi bi-check2-circle"></i> Planification des finances personnelles
              </div>
              <div class="detail-pricing">
                <span class="float-left">
                  <i class="bi bi-check2-circle"></i> Conseils d'investissement
              </div>
            </div>
            <form method="POST" class="w-100">
              <input type="submit" name="planifier-3" value="Planifier" class="btn btn-secondary w-75 mx-5" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Javascript files-->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-3.0.0.min.js"></script>
  <script src="js/plugin.js"></script>
  <!-- sidebar -->
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="js/custom.js"></script>
  <!-- javascript -->
  <script src="js/owl.carousel.js"></script>
  <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
      });

      $(".zoom").hover(function() {

        $(this).addClass('transition');
      }, function() {

        $(this).removeClass('transition');
      });
    });
  </script>
  <script>
    function openNav() {
      document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
      document.getElementById("myNav").style.width = "0%";
    }
  </script>
</body>

</html>