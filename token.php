<?php 
session_start() ;  
include_once 'config.php' ;
include_once 'config1.php' ;
require_once 'model/produit.php' ; 
require_once 'controller/produitC.php' ;  

$produitC = new produitC() ; 
$tokens = $produitC->afficher_TOKENS() ;

?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from pixner.net/sbidu/main/product.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Jul 2021 17:04:16 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Acheter Token</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/owl.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <style>
    .card{
        transition: all 0.3s ;  
    }
    .card:hover{
          
        transform: scale(1.04);
    }

    .custom-button {
        transition: all 0.3s ; 
    }
    .custom-button:hover {
        color : black ; 
        background: -webkit-linear-gradient(90deg, #E2BE48 0%, #FF6141 100%);
    }
</style>
</head>


<body>
     <!-- ========== HEADER ============ -->
    <?php
        include 'includes/header.php' ; 
    ?>
    <!-- ========== END HEADER ============ -->

     


    <!--============= Hero Section Starts Here =============-->
    <div class="hero-section style-2">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="index.php">Accueil</a>
                </li>
                <li>
                    <span>Achat Token</span>
                </li> 
            </ul>
        </div>
        <div class="bg_img hero-bg bottom_center" data-background="assets/images/banner/hero-bg.png"></div>
    </div>
    <!--============= Hero Section Ends Here =============-->


    <!--============= Featured Auction Section Starts Here =============-->
    <section class="featured-auction-section padding-bottom mt--240 mt-lg--440 pos-rel">
        <div class="container">
            <div class="section-header cl-white mw-100 left-style">
                <h3 class="title">Recharger des Tokens pour participer aux Enchères</h3>
                <div>Paiement possible avec une carte bancaire nationale, carte e-dinar ou par poste</div>
            </div>
            <div class="row justify-content-center mb-30-none" >


                <?php foreach ($tokens as $token) { ?>
                <div class="col-sm-10 col-md-6 col-lg-4  "  >
                    <div class="auction-item-2 card" >
                        <div class="auction-thumb">
                             
                        </div>
                        <div class="auction-content">
                            <h6 class="title text-center" style="margin-top: 20px ; font-weight: ">
                                 
                                <div style="margin-bottom: 10px ;   font-weight: bold ; ">PACK <?php echo $token['quantite_token']." TOKEN" ;  ?><div>
                                    <br>
                                <div>PRIX : <?php echo $token['price_token']." DT" ;  ?><div>
                            </h6>
                             
                             
                            <div class="text-center" style="margin-top: 20px; ">
                                <a href="#0" class="custom-button">Acheter</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>


                 
            </div>
        </div>
    </section>
    <!--============= Featured Auction Section Ends Here =============-->


     

     <!-- ===================== FOOTER ======================= -->
    <?php include 'includes/footer.php' ; ?>
    <!-- ==================== END FOOTER ==================== -->



    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/waypoints.js"></script>
    <script src="assets/js/nice-select.js"></script>
    <script src="assets/js/counterup.min.js"></script>
    <script src="assets/js/owl.min.js"></script>
    <script src="assets/js/magnific-popup.min.js"></script>
    <script src="assets/js/yscountdown.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>


<!-- Mirrored from pixner.net/sbidu/main/product.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Jul 2021 17:04:45 GMT -->
</html>