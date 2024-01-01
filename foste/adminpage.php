<?php
session_start();
include("classes/bd.php");
include("classes/demmand_contact.php");
include("classes/service.php");
$connection = new Connection();
$conn = $connection->conn;
if ($conn == null) {
  echo "échec de connexion de base de données";
  exit();
} else {
  if (!isset($_SESSION["admin"])) {
    header("location: admin-signin.php");
    exit();
  }
  $inquiries = Demmand_contact::getAllContactInquiries($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />

  <title>Admin Page</title>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
  <title>Foste</title>
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
  <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <style type="text/css">

  </style>
</head>

<body>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
  <!--header section start -->
  <div class="header_section">
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
                  <a href="register.php">Sign up</a>
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
  <div class="container mt-5">
    <h2>Admin Page</h2>
    <div class="container mt-5">
      <h2>Demandes de contact</h2>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Prenom</th>
              <th>Nom</th>
              <th>Email</th>
              <th>Date de la demande</th>
              <th>Service</th>
              <th>Message</th>
              <th>Action</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Assuming $inquiries is an array of Demmand_contact objects fetched from the database
            foreach ($inquiries as $inquiry) {
              $numeroService = $inquiry->getServiceId();
              $result = Services::selectServiceById($conn, $numeroService);
              $service_name = $result["service_name"];

              $dateTime = new DateTime($inquiry->getDateDemmand());
              $date = $dateTime->format('Y-m-d');
              echo "<tr>";
              echo "<td>" . $inquiry->getIdDemmand() . "</td>";
              echo "<td>" . $inquiry->getFirstName() . "</td>";
              echo "<td>" . $inquiry->getLastName() . "</td>";
              echo "<td>" . $inquiry->getEmail() . "</td>";
              echo "<td>" . $date . "</td>";
              echo "<td>" . $service_name . "</td>";
              echo "<td>" . $inquiry->getMessage() . "</td>";
              echo "<td><a href='update_inquiry.php?id=" . $inquiry->getIdDemmand() . "' class='btn btn-success btn-sm'>Update</a></td>";
              echo "<td><a href='delete_inquiry.php?id=" . $inquiry->getIdDemmand() . "' class='btn btn-danger btn-sm'>Delete</a></td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Javascript files-->
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.min.js"></script>
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