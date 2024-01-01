<?php
session_start();
if (!isset($_SESSION["email"])) {
  header("location: register.php");
  exit();
}
include("classes/bd.php");
include("classes/Client.php");
$connection = new Connection();
$conn = $connection->conn;
if ($conn == null) {
  echo "échec de connexion";
  exit();
}

// crées objet Client
$email = $_SESSION["email"];
$sql = "SELECT user_id FROM Users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
if ($result != null) {
  $row = mysqli_fetch_assoc($result);
  $id = $row['user_id'];
  $row = Client::selectClientById('users', $conn, $id);
  $client_id = $row["user_id"];
  $client_username = $row["username"];
  $client_fullname = $row["full_name"];
  $client_email = $row["email"];
  $client_password = $row["password"];
  $client_tel = $row["contact_number"];
  $client = new Client($client_username, $client_email, $client_password, $client_fullname, $client_tel);
  $client->setClientId($client_id);
  // CHAT-GPT diviser fullname en nom prenom
  $full_name = $client->getFullName(); // Récupérer le nom complet
  $name_parts = explode(' ', $full_name); // Diviser la chaîne en utilisant l'espace comme délimiteur

  if (count($name_parts) >= 2) {
    $nom = $name_parts[0]; // Le premier élément est le nom
    $prenom = implode(' ', array_slice($name_parts, 1)); // Les autres éléments sont le prénom
    // Si le prénom est composé de plusieurs mots, les reconstruire en une seule chaîne
  } else {
    $nom = $full_name; // Si le nom complet ne contient qu'un seul mot, considérez-le comme le nom
    $prenom = ''; // Pas de prénom disponible
  }
} else {
  echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
}

// handle update:
if(isset($_POST["submit"])){
  echo "executed";
  $nom = $_POST["firstName"];
  $prenom = $_POST["lastName"];
  $form_email = $_POST["email"];
  $username = $_POST["username"];
  $phone = $_POST["phone"];
  
    echo $nom, $prenom, $form_email, $username, $phone;
    
    if(isset($nom) && isset($prenom) && isset($form_email) && isset($username) && isset($phone)){
      $client->updateClient($conn, $id, $nom, $prenom, $username, $form_email, $phone);
      header("location: login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Profile Client</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style type="text/css">
    .gradient-brand-color {
      background-image: -webkit-linear-gradient(0deg, #2ecc71 0%, #27ae60 100%);
      background-image: -ms-linear-gradient(0deg, #2ecc71 0%, #27ae60 100%);
      color: #fff;
    }

    .contact-info__wrapper {
      overflow: hidden;
      border-radius: 0.625rem 0.625rem 0 0;
    }

    @media (min-width: 1024px) {
      .contact-info__wrapper {
        border-radius: 0 0.625rem 0.625rem 0;
        padding: 5rem !important;
      }
    }

    .contact-info__list span.position-absolute {
      left: 0;
    }

    .z-index-101 {
      z-index: 101;
    }

    .list-style--none {
      list-style: none;
    }

    .contact__wrapper {
      background-color: #fff;
      border-radius: 0 0 0.625rem 0.625rem;
    }

    @media (min-width: 1024px) {
      .contact__wrapper {
        border-radius: 0.625rem 0 0.625rem 0.625rem;
      }
    }

    @media (min-width: 1024px) {
      .contact-form__wrapper {
        padding: 5rem !important;
      }
    }

    .shadow-lg,
    .shadow-lg--on-hover:hover {
      box-shadow: 0 1rem 3rem rgba(132, 138, 163, 0.1) !important;
    }
  </style>
</head>

<body class="overflow-hidden vh-100">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet" />
  <div class="header_section vh-100">
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
    <!-- form here -->
    <div class="container w-100 h-100 d-flex align-items-center justify-content-center">
      <div class="contact__wrapper shadow-lg mt-n9">
        <div class="row no-gutters">
          <div class="col-lg-5 contact-info__wrapper gradient-brand-color p-5 order-lg-2">
            <h5 class="color--white mb-5">Modifier vos informations personnelles</h5>
           
            <figure class="figure position-absolute m-0 opacity-06 z-index-100" style="bottom: 0; right: 10px">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="444px" height="626px">
                <defs>
                  <linearGradient id="PSgrad_1" x1="0%" x2="81.915%" y1="57.358%" y2="0%">
                    <stop offset="0%" stop-color="rgb(255,255,255)" stop-opacity="1"></stop>
                    <stop offset="100%" stop-color="rgb(25, 100, 50)" stop-opacity="0"></stop>
                  </linearGradient>
                </defs>
                <path fill-rule="evenodd" opacity="0.302" fill="rgb(25, 100, 50)" d="M816.210,-41.714 L968.999,111.158 L-197.210,1277.998 L-349.998,1125.127 L816.210,-41.714 Z"></path>
                <path fill="url(#PSgrad_1)" d="M816.210,-41.714 L968.999,111.158 L-197.210,1277.998 L-349.998,1125.127 L816.210,-41.714 Z"></path>
              </svg>
            </figure>
          </div>
          <div class="col-lg-7 contact-form__wrapper p-5 order-lg-1">
            <form method="post" class="contact-form form-validate" novalidate="novalidate">
              <div class="row">
                <div class="col-sm-6 mb-3">
                  <div class="form-group">
                    <label class="required-field" for="firstName">Nom</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $nom ?>" required/>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="form-group">
                    <label for="lastName">Prenom</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $prenom ?>" required/>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="form-group">
                    <label class="required-field" for="email">Adresse e-mail</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $client->getEmail() ?>" required/>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="form-group">
                    <label for="phone">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $client->getUsername() ?>" required/>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="form-group">
                    <label for="phone">Numéro de contact</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $client->getContactNumber() ?>" required/>
                  </div>
                </div>
                <div class="col-sm-12 mb-3">
                <div class="d-flex justify-content-between">
                    <input type="submit" name="submit" value="Modifier compte" class="btn btn-success" />
                  </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
  <!-- Section: Design Block -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
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