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
    if (isset($_GET["id"])) {
        $id_demmand = $_GET["id"];
        $inquiry = Demmand_contact::getContantInquiryById($conn, $id_demmand);
        $first_name = $inquiry["first_name"];
        $last_name = $inquiry["last_name"];
        $email = $inquiry["email"];
        $phone = $inquiry["phonenumber"];
        $date_inquiry = $inquiry["inquiry_date"];
        $message = $inquiry["message"];
        $clientId = $inquiry["client_id"];
        $serviceId = $inquiry["service_id"];
        $demmand = new Demmand_contact($first_name, $last_name, $email, $phone, $date_inquiry, $message, $clientId, $serviceId);
        $dateTime = new DateTime($demmand->getDateDemmand());
        $date = $dateTime->format('Y-m-d');

        $message_erreur = "";
        if (isset($_POST["submit"])) {
            $first_name = $_POST["first-name"];
            $last_name = $_POST["last-name"];
            $email = $_POST["email"];
            $numero_telephone = $_POST["phone"];
            $date_demmande = $_POST["date"];
            $numero_Service = $_POST["numero-service"];
            $message = $_POST["message"];
            // echo $first_name, "<br>",  $last_name,"<br>", $email,"<br>", $numero_telephone,"<br>",  $date_demmande,"<br>", $numero_Service,"<br>", $message; 
            if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($numero_telephone) && !empty($date_demmande) && !empty($numero_Service) && !empty($message)) {
                if ($demmand->updateDemmand($conn, $id_demmand, $first_name, $last_name, $email, $numero_telephone, $date_demmande, $numero_Service, $message)) {
                    header("location: adminpage.php");
                }
            } else {
                $message_erreur = "tous les champs sont obligatoires";
            }
        }
        if (isset($_POST["cancel"])) {
            header("location: adminpage.php");
        }
    } else {
        header("location: adminpage.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Planifier pour </title>
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
    <!-- form here -->
    <div class="container w-100 h-100 d-flex align-items-center justify-content-center">
        <div class="contact__wrapper shadow-lg mt-n9">
            <div class="row no-gutters">
                <div class="col-lg-5 contact-info__wrapper gradient-brand-color p-5 order-lg-2">
                    <h3 class="color--white mb-5">modifier la demande de contact</h3>

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
                    <form action="" method="POST" class="contact-form form-validate" novalidate="novalidate">
                        <?php echo isset($_POST['submit']) && !empty($message_erreur) ?
                            "<div class='alert alert-danger' role='alert'>" . $message_erreur . "</div>" : ""
                        ?>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label class="required-field" for="firstName">Nom</label>
                                    <input type="text" class="form-control" id="lastname" name="last-name" value="<?php echo $demmand->getLastName() ?>" required />
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="lastName">Prenom</label>
                                    <input type="text" class="form-control" id="firstname" name="first-name" value="<?php echo $demmand->getFirstName() ?>" required />
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label class="required-field" for="email">Adresse e-mail</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $demmand->getEmail() ?>" required />
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="phone">Numéro de contact</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $demmand->getPhonenumber() ?>" required />
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="phone">Date de la demande</label>
                                    <input type="date" class="form-control" id="date" name="date" value="<?php echo $date ?>" required />
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-group w-100">
                                    <label for="service">Service requis</label>
                                    <select class="form-control" name="numero-service" aria-label="Default select example">
                                        <?php
                                        $services = Services::getAllService($conn);
                                        if ($services != null) {
                                            foreach ($services as $service) {
                                                echo "<option value='" . $service["service_id"] . "'>" . $service["service_name"] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="required-field" for="message">Message?</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Hi there, I would like to.....">
                                        <?php echo $demmand->getMessage() ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <input type="submit" name="submit" value="Modifier" class="btn btn-success" />
                                <input type="submit" name="cancel" value="Annuler" class="btn btn-secondary" />
                            </div>
                        </div>
                    </form>
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