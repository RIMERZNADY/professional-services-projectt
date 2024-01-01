<?php
session_start();
session_unset();
session_destroy();
include("classes/bd.php");
include("classes/Client.php");
$connection = new Connection();
$conn = $connection->conn;
if ($conn == null) {
    echo "échec de connexion de base de données";
    exit();
} else {
    Client::$email_error = "";
    Client::$password_error = "";

    if (isset($_POST['sign-in'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email)) {
            Client::$email_error = "please fill the email input!";
        } else if (empty($password)) {
            Client::$password_error = "please fill the password input!";
        } else {
            Client::authentifierClient($conn, $email, $password);
        }

        if (empty(Client::$email_error) && empty(Client::$password_error)) {
            session_start();
            $_SESSION["email"] = $email;
            header("location: services.php");

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to your account</title>
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
</head>

<body class="vh-100 overflow-hidden">
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
        <!-- Section: Design Block -->
        <section class="vh-100">
            <!-- Jumbotron -->
            <div class="px-4 py-5 px-md-5 text-center text-lg-start h-100 d-flex align-items-center" style="background-color: hsl(0, 0%, 96%)">
                <div class="container">
                    <div class="row gx-lg-5 align-items-center">
                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <h1 class="my-5 display-3 fw-bold ls-tight">
                                La meilleure offre
                                <span class="text-success">pour votre entreprise</span>
                            </h1>
                            <p style="color: hsl(217, 10%, 50.8%)">Bienvenue dans notre communauté ! Bénéficiez d'avantages exclusifs et propulsez votre entreprise vers de nouveaux sommets grâce à nos services sur mesure. Inscrivez-vous maintenant et rejoignez un réseau de professionnels axés sur le succès.
                            </p>
                        </div>

                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <div class="card">
                                <div class="card-body py-5 px-md-5">
                                    <form method="POST" action="">
                                        <!-- Email input -->
                                        <div class="form-outline mb-4">
                                            <input type="email" name="email" id="form3Example3" class="form-control" value="<?php echo isset($_POST['sign-in']) ? $email : '' ?>" />
                                            <label class="form-label" for="form3Example3">adresse Email</label>
                                        </div>
                                        <?php echo isset($_POST['sign-in']) && !empty(Client::$email_error) ?
                                            "<div class='alert alert-danger' role='alert'>" . Client::$email_error . "</div>" : ""
                                        ?>
                                        <!-- Password input -->
                                        <div class="form-outline mb-4">
                                            <input type="password" name="password" id="form3Example4" class="form-control" />
                                            <label class="form-label" for="form3Example4">Password</label>
                                        </div>
                                        <?php echo isset($_POST['sign-in']) && !empty(Client::$password_error) ?
                                            "<div class='alert alert-danger' role='alert'>" . Client::$password_error . "</div>" : ""
                                        ?>
                                        <!-- Checkbox -->
                                        <div class="form-check d-flex justify-content-center mb-4">
                                            <input class="form-check-input bg-success me-2" type="checkbox" value="" id="form2Example33" checked />
                                            <label class="form-check-label" for="form2Example33">
                                                Agree to our term and conditions
                                            </label>
                                        </div>

                                        <!-- Submit button -->
                                        <input type="submit" name="sign-in" value="Se connecter" class="btn btn-success btn-block mb-4" />

                                        <!-- Register buttons -->
                                        <div class="text-center">
                                            <p>Don't have an account?</p>
                                            <a href="register.php" class="text-success">Create account</a>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Jumbotron -->
        </section>
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