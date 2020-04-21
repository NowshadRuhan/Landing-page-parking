
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Parkingkoi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Bangladesh parking,number parking,iot based parking" />
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link href="<?php echo base_url('resoures/landing_css/css/bootstrap.css');?>" rel='stylesheet' type='text/css' />
    <link href="<?php echo base_url('resoures/landing_css/css/zoomslider.css');?>" rel='stylesheet' type='text/css' />
    <link href="<?php echo base_url('resoures/landing_css/css/style6.css');?>" rel='stylesheet' type='text/css' />
    <link href="<?php echo base_url('resoures/landing_css/css/style.css');?>" rel='stylesheet' type='text/css' />
    <link href="<?php echo base_url('resoures/landing_css/css/fontawesome-all.css');?>" rel="stylesheet">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- banner-inner -->
    <div id="demo-1" data-zs-src='["resoures/landing_css/images/1.jpg", "resoures/landing_css/images/2.jpg","resoures/landing_css/images/3.jpg", "resoures/landing_css/images/1.jpg"]' data-zs-overlay="dots">
        <div class="demo-inner-content">
            <div class="header-top">
                <header>
                   
                    <div class="clearfix"></div>
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="logo">
                            <h1>
                                <a class="navbar-brand" href="#">
                                    <div id="logo">
                            <img src="<?php echo base_url()?>resoures/landing_css/images/ll.png" class="responsive-img" style="max-width: 150px; max-height: 150px;" width="20" alt="logo" title="logo">
                                </div></a>
                            </h1>
                        </div>
                        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon">
                                <i class="fas fa-bars"></i>
                            </span>

                        </button> -->

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- <ul class="navbar-nav ml-lg-auto text-center">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.html">Home
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="how.html">Our solution</a>
                                </li>
                                
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Find Parking</a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="contact.html">List Your Parking</a>
                                </li>
                            </ul> -->

                        </div>
                    </nav>
                </header>
            </div>
            <!--/banner-info-w3layouts-->
            <div class="banner-info-w3layouts text-center">

                <h3>
                    <span>Select your country</span> .
                    <span>Right Now.</span>
                </h3>
                

                <form action="<?php echo base_url('First/country_selection');?>" method="post" class="ban-form row">
                   
                    <div class="col-md-6 banf">
                        <select id="country13" name="selcetion" class="form-control">
                            <option value="https://parkingkoi.com/home-page">Bangladesh</option>
                            <option value="https://parkingkoiusa.xyz/">United State</option>
                           
                        </select>

                    </div>
                    <div class="col-md-6 banf">
                        <button class="btn1" type="submit">Select Country
                            <!-- <i class="fas fa-search"></i> -->
                        </button>
                    </div>
                </form>
            </div>
            <!--//banner-info-w3layouts-->
        </div>
    </div>
    <!-- banner-text -->
    <!-- banner-bottom-wthree -->
    <section class="banner-bottom-wthree  py-lg-5 py-3" style="background-color: #ffcc00;">
        <div class="container">
            <div class="inner-sec-w3ls py-lg-5  py-3">
                <h3 class="tittle cen text-center mb-lg-5 mb-3" style="color: black;">
                    <span >Some Info</span> Our Stats</h3>
                <div class="stats row mt-5">
                    <div class="col-md-3 stats_left counter_grid text-center">

                        <p class="counter" style="color: black;">44225</p>
                        <h4 style="color: black;">Active Users</h4>
                    </div>
                    <div class="col-md-3 stats_left counter_grid1 text-center">

                        <p class="counter" style="color: black;">750+</p>
                        <h4 style="color: black;">Monthly Subscription</h4>
                    </div>
                    <div class="col-md-3 stats_left counter_grid2 text-center">

                        <p class="counter" style="color: black;">403</p>
                        <h4 style="color: black;">Corporate client</h4>
                    </div>
                    <div class="col-md-3 stats_left counter_grid3 text-center">

                        <p class="counter" style="color: black;">^650000+</p>
                        <h4 style="color: black;">place</h4>
                    </div>

                </div>
            </div>
        </div>
    </section>
     <section class="banner_bottom mobile-app">
        <div class="dotts py-lg-5 py-3">
            <div class="container">
                <!--/mobile-app -->
                <div class="inner-sec-w3ls py-lg-5  py-3">
                    <div class="row">
                        <div class="col-md-7 app-info">
                            <h3 class="header" style="color: black;">Download &amp; Enjoy</h3>
                            <p class="para_vl" style="color: black;">IoT - based full - stack platform designed to solve Smart Cities parking problems. Disruptive management of parking & discovery for urban commuters, parking lot operators & owners, urban planners & managers..</p>
                            <ul class="app-devices mt-5">
                                <li>
                                    <a id="download_google" href="https://play.google.com/store/apps/details?id=com.parkingkoi.pk" class="" target="_blank"><img src="<?php echo base_url() ?>assets/images/play.png"></a>
                                </li>
                                <li>
                                    <a id="download_apple" href="https://itunes.apple.com/us/app/parkingkoi/id1458095395?mt=8&ign-mpt=uo%3D4&fbclid=IwAR2M9V1fGgceudeFUfUXiF_2JajjB-ydKtLIlwWJ3OYNWgh0gACKh8URyGs" class="" target="_blank"><img src="<?php echo base_url() ?>assets/images/app.png"></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                           
                        </div>
                        <div class="col-md-5 app-img" style=" padding-top: 80px;">
                            <img src="<?php echo base_url('resoures/landing_css/images/2.png');?>" alt=" " class="img-fluid" style="max-width: 500px;">
                        </div>
                    </div>
                    <!--//mobile-app -->
                </div>
            </div>
        </div>
    </section>
    <!-- //banner-bottom-wthree -->
    <!--/process-->
    
   <footer class="footer-emp-w3layouts bg-dark dotts " align="center">
        <div class="container-fluid px-lg-12 " align="center">
          
           <ul class="footer-social  mt-lg-4 mt-3" align="center" style="margin-top: 100px;">

                            <li class="mx-2" style="padding-top:70px;">
                                <a href="https://www.facebook.com/parkingkoi/?eid=ARB0DEDZTF1LSxNhoUC81LjOBUeCAKHDJ4OegqkuIYqfI3YiIuV5Co2RQLj-tq7_txm2Jtc9Dg_C_GWZ&timeline_context_item_type=intro_card_work&timeline_context_item_source=100011082794279&fref=tag">
                                    <i class="fa fa-facebook" style="font-size:24px"></i>
                                </a>
                            </li>
                            <li class="mx-2" style="padding-top:70px;">
                                <a href="https://www.linkedin.com/company/parkingkoi-thelargestparkingsharingplatforminbangladesh">
                                    <i class="fa fa-linkedin" style="font-size:24px"></i>
                                </a>
                            </li>
                            <li class="mx-2" style="padding-top:70px;">
                                 <a href="http://parkingkoi.net/policy/"><i class="fa fa-product-hunt" style="font-size:24px"></i></a>
                            </li>
                            <li class="mx-2" style="padding-top:70px;">
                               <a href="https://parkingkoiusa.xyz/User/contact"><i class="fa fa-codiepie" style="font-size:24px"></i></a>
                            </li>
                           
                        </ul>
            <p class="copy-right text-center" style="margin-top: 50px;">&copy; Parkingkoi
            </p>
            
        </div>
    </footer>
 
    <!--//model-form-->
    
                        
    <!-- js -->
    <!--/slider-->
    <script src="<?php echo base_url('resoures/landing_css/js/jquery-1.11.1.min.js');?>"></script>
    <script src="<?php echo base_url('resoures/landing_css/js/modernizr-2.6.2.min.js');?>"></script>
    <script src="<?php echo base_url('resoures/landing_css/js/jquery.zoomslider.min.js');?>"></script>
    <!--//slider-->
    <!--search jQuery-->
    <script src="<?php echo base_url('resoures/landing_css/js/classie-search.js');?>"></script>
    <script src="<?php echo base_url('resoures/landing_css/js/demo1-search.js');?>"></script>
    <!--//search jQuery-->

    <script>
        $(document).ready(function() {
            $(".dropdown").hover(
                function() {
                    $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                    $(this).toggleClass('open');
                },
                function() {
                    $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                    $(this).toggleClass('open');
                }
            );
        });
    </script>
    <!-- //dropdown nav -->
    <!-- password-script -->
    <script>
        window.onload = function() {
            document.getElementById("password1").onchange = validatePassword;
            document.getElementById("password2").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("password2").value;
            var pass1 = document.getElementById("password1").value;
            if (pass1 != pass2)
                document.getElementById("password2").setCustomValidity("Passwords Don't Match");
            else
                document.getElementById("password2").setCustomValidity('');
            //empty string means no validation error
        }
    </script>
    <!-- //password-script -->

    <!-- stats -->
    <script src="<?php echo base_url('resoures/landing_css/js/jquery.waypoints.min.js');?>"></script>
    <script src="<?php echo base_url('resoures/landing_css/js/jquery.countup.js');?>"></script>
    <script>
        $('.counter').countUp();
    </script>
    <!-- //stats -->

    <!-- //js -->
    <script src="<?php echo base_url('resoures/landing_css/js/bootstrap.js');?>"></script>
    <!--/ start-smoth-scrolling -->
    <script src="<?php echo base_url('resoures/landing_css/js/move-top.js');?>"></script>
    <script src="<?php echo base_url('resoures/landing_css/js/easing.js');?>"></script>
    <script>
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 900);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            /*
            						var defaults = {
            							  containerID: 'toTop', // fading element id
            							containerHoverID: 'toTopHover', // fading element hover id
            							scrollSpeed: 1200,
            							easingType: 'linear' 
            						 };
            						*/

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <!--// end-smoth-scrolling -->
</body>

</html>