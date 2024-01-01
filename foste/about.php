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
<title>About</title>
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
    <!-- about section start -->
    <div class="about_section layout_padding">
    	<div class="container">
    		<div class="row">
    			<div class="col-sm-6">
    				<div><img src="images/img-8.png" class="image_8"></div>
    			</div>
    			<div class="col-sm-6">
    				<h1 class="about_taital">About Us</h1>
    				<div class="more_bt"><a href="#">En savoir plus</a></div>
    			</div>
    		</div>
    	</div>
    </div>
    <!-- about section end -->
    <!-- footer section start -->
    <div class="footer_section layout_padding margin_top">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-3 col-sm-6">
    				<h4 class="address_text">ADDRESS</h4>
    				<p class="simply_text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been  </p>
    			</div>
    			<div class="col-lg-3 col-sm-6">
    				<h4 class="address_text">QUICK LINKS</h4>
    				<div class="footer_menu_main">
    				    <div class="footer_menu">
    				    	<ul>
    				    		<li><a href="index.html.html">Home</a></li>
    				    		<li><a href="blog.html">Blog</a></li>
    				    		<li><a href="about.html">About</a></li>
    				    		<li><a href="services.html">Services</a></li>
    				    		<li><a href="contact.html">Contact Us</a></li>
    				    	</ul>
    				    </div>
    				</div>
    			</div>
    			<div class="col-lg-6 col-sm-12">
    				<div class="newsletter_section">
    					<div class="newsletter_left">
    						<h4 class="address_text">Newsletter</h4>
    					</div>
    					<div class="newsletter_right">
    						<div class="social_icon">
    				    	    <ul>
    				    	    	<li><a href="#"><img src="images/fb-icon.png"></a></li>
    				    	    	<li><a href="#"><img src="images/twitter-icon.png"></a></li>
    				    	    	<li><a href="#"><img src="images/instagram-icon.png"></a></li>
    				    	    </ul>
    				        </div>
    					</div>
    				</div>
    				<input type="text" class="mail_bt" placeholder="Enter Your Email" name="Enter Your Email">
    				<input type="text" class="mail_bt" placeholder="Phone" name="Phone">
    				<div class="subscribe_bt"><a href="#">Subscribe</a></div>
    			</div>
    		</div>
    	</div>
    </div>
    <!-- footer section end -->
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
    $(document).ready(function(){
    $(".fancybox").fancybox({
    openEffect: "none",
    closeEffect: "none"
    });
         
    $(".zoom").hover(function(){
         
    $(this).addClass('transition');
    }, function(){
         
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