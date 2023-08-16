<?php
session_start() ; 
if (!isset($_SESSION["username"])) {
    echo "<script>window.top.location='sign-in.php'</script>" ; 
}

include_once 'config.php' ;
require_once 'model/user.php' ; 
require_once 'controller/userC.php' ;
include 'connect.php' ;

$_SESSION["header_profile"] = "configuration" ; 

$userC = new userC() ; 
$users = $userC->afficherUser($_SESSION["id_user"]) ;
foreach ($users as $row) {
    $_SESSION["username"] = $row["nom_user"]." ".$row["prenom_user"] ;
    $_SESSION["nom"] = $row["nom_user"] ; 
    $_SESSION["prenom"] = $row["prenom_user"] ; 
    $_SESSION["telephone"] = $row["telephone_user"] ; 
    $_SESSION["email"] = $row["email_user"] ; 
    $_SESSION["budget"] = $row["budget_user"] ; 
    $_SESSION["adresse"] = $row["adresse_user"] ;   
    $_SESSION["id_user"] = $row["id_user"] ;
    $_SESSION["code_user"] = $row["code_user"] ; 
    $_SESSION["verif_user"] = $row["verif_user"] ; 
    $_SESSION["refcode_user"] = $row["refcode_user"] ; 
}

if (isset($_POST["pdp_save"])) {
    echo "<script>window.top.location='modifier.php?pdp_user=1'</script>" ;
}

if (isset($_POST['verif_submit'])) {
    
    $users = $userC->afficherUser($_SESSION["id_user"]) ;
     
    foreach ($users as $row) {
        if (($_POST['verif_code']) == ($row['code_user'])) {
            echo "TEST2 " ; 
            $_SESSION["verif_user"] = 1 ; 
            $users = $userC->modifier_verified_user($_SESSION["id_user"]) ;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from pixner.net/sbidu/main/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Jul 2021 17:06:34 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Profil</title>

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
</head>

<body>
    <!-- ========== HEADER ============ -->
    <?php
        include 'includes/header.php' ; 
    ?>
    <!-- ========== END HEADER ============ -->

    <!-- ========== CART ============ -->
    <?php
        // include 'cart.php' ; 
    ?>
    <!-- ========== END CART ============ -->


    <!--============= Hero Section Starts Here =============-->
    <div class="hero-section style-2">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="index.php">Accueil</a>
                </li>
                <li>
                     Mon Compte 
                </li> 
            </ul>
        </div>
        <div class="bg_img hero-bg bottom_center" data-background="assets/images/banner/hero-bg.png"></div>
    </div>
    <!--============= Hero Section Ends Here =============-->


    <!--============= Dashboard Section Starts Here =============-->
    <section class="dashboard-section padding-bottom mt--240 mt-lg--440 pos-rel">
        <div class="container">
            <div class="row justify-content-center">



                <?php include 'header_profile.php' ;  ?>



                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="dash-pro-item mb-30 dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Details</h4>
                                    <span class="edit">
                                        <a href="modifier.php?details=1&nom=<?= $_SESSION['nom'] ?>&prenom=<?= $_SESSION['prenom'] ?>&adresse=<?= $_SESSION['adresse'] ?>"><i class="flaticon-edit"></i>&nbsp;Modifier</a>
                                        
                                    </span>
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">Nom</div>
                                        <div class="info-value"><?php echo $_SESSION["nom"] ;  ?></div>
                                    </li>
                                    <li>
                                        <div class="info-name">Prénom</div>
                                        <div class="info-value"><?php echo $_SESSION["prenom"] ;  ?></div>
                                    </li>
                                    <li>
                                        <div class="info-name">Address</div>
                                        <div class="info-value"><?php echo $_SESSION["adresse"] ;  ?></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="dash-pro-item mb-30 dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Paramètres</h4>
                                     
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">Budget</div>
                                        <div class="info-value"><?php echo $_SESSION["budget"] ; ?> Tokens</div>
                                    </li> 
                                    <li>
                                        <div class="info-name">Statut</div>
                                        <?php if ($_SESSION["verif_user"]==0) { 

                                            if (!isset($_SESSION['email_sent'])) {
                                            ?>
                                                <div class="info-value"><i class="flaticon-cross text-success"></i><span style="color:red">Non vérifié </span> 
                                                <a href="verifier_compte_mail.php"> Vérifier Compte</a></div>
                                        <?php }  else { ?>
                                                <div class="info-value"><span style="color:red">Non vérifié </span></div>
                                                <form action="" method="POST">
                                                    <div style="color : green ; margin-left: 10px ; margin-top: 10px ; ">Veuillez entrer le code de confirmation que vous avez reçu dans votre mail.</div>
                                                    <input style="height: 40px; margin : 10px; width: 100px ; border-color: black ;   " type="text" name="verif_code">
                                                    <input type="submit" style="height : 40px; margin : 10px; width: 100px ;  " name="verif_submit" value="Confirmer">
                                                </form> 

                                                <a href="verifier_compte_mail.php" style="margin-left:  10px ; ">Renvoyer le code.</a></div>
                                        <?php }

                                            } else { ?>
                                            <div class="info-value"><i class="flaticon-check text-success"></i> Vérifié
                                        <?php } ?>    
                                        
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="dash-pro-item mb-30 dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Email</h4>
                                    <span class="edit">
                                        <a href="modifier.php?email=<?= $_SESSION['email'] ?>"><i class="flaticon-edit"></i>&nbsp;Modifier</a>
                                    </span>
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">Email</div>
                                        <div class="info-value"><?php echo $_SESSION["email"] ; ?></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="dash-pro-item mb-30 dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Téléphone</h4>
                                    <span class="edit">
                                        <a href="modifier.php?telephone=<?= $_SESSION['telephone'] ?>"><i class="flaticon-edit"></i>&nbsp;Modifier</a>
                                    </span>
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">Numéro</div>
                                        <div class="info-value"><?php echo "+216 - ".$_SESSION["telephone"] ; ?></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="dash-pro-item dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Sécurité</h4>
                                    <span class="edit">
                                        <a href="modifier.php?mdp=1"><i class="flaticon-edit"></i>&nbsp;Modifier</a>
                                    </span>
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">Mot de passe</div>
                                        <div class="info-value">xxxxxxxxxxxxxxxx</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= Dashboard Section Ends Here =============-->


    <!--============= Footer Section Starts Here =============-->
    <footer class="bg_img padding-top oh" data-background="assets/images/footer/footer-bg.jpg">
        <div class="footer-top-shape">
            <img src="assets/css/img/footer-top-shape.png" alt="css">
        </div>
        <div class="anime-wrapper">
            <div class="anime-1 plus-anime">
                <img src="assets/images/footer/p1.png" alt="footer">
            </div>
            <div class="anime-2 plus-anime">
                <img src="assets/images/footer/p2.png" alt="footer">
            </div>
            <div class="anime-3 plus-anime">
                <img src="assets/images/footer/p3.png" alt="footer">
            </div>
            <div class="anime-5 zigzag">
                <img src="assets/images/footer/c2.png" alt="footer">
            </div>
            <div class="anime-6 zigzag">
                <img src="assets/images/footer/c3.png" alt="footer">
            </div>
            <div class="anime-7 zigzag">
                <img src="assets/images/footer/c4.png" alt="footer">
            </div>
        </div>
        <div class="newslater-wrapper">
            <div class="container">
                <div class="newslater-area">
                    <div class="newslater-thumb">
                        <img src="assets/images/footer/newslater.png" alt="footer">
                    </div>
                    <div class="newslater-content">
                        <div class="section-header left-style mb-low">
                            <h5 class="cate">Subscribe to Sbidu</h5>
                            <h3 class="title">To Get Exclusive Benefits</h3>
                        </div>
                        <form class="subscribe-form">
                            <input type="text" placeholder="Enter Your Email" name="email">
                            <button type="submit" class="custom-button">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-top padding-bottom padding-top">
            <div class="container">
                <div class="row mb--60">
                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-widget widget-links">
                            <h5 class="title">Auction Categories</h5>
                            <ul class="links-list">
                                <li>
                                    <a href="#0">Ending Now</a>
                                </li>
                                <li>
                                    <a href="#0">Vehicles</a>
                                </li>
                                <li>
                                    <a href="#0">Watches</a>
                                </li>
                                <li>
                                    <a href="#0">Electronics</a>
                                </li>
                                <li>
                                    <a href="#0">Real Estate</a>
                                </li>
                                <li>
                                    <a href="#0">Jewelry</a>
                                </li>
                                <li>
                                    <a href="#0">Art</a>
                                </li>
                                <li>
                                    <a href="#0">Sports & Outdoor</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-widget widget-links">
                            <h5 class="title">About Us</h5>
                            <ul class="links-list">
                                <li>
                                    <a href="#0">About Sbidu</a>
                                </li>
                                <li>
                                    <a href="#0">Help</a>
                                </li>
                                <li>
                                    <a href="#0">Affiliates</a>
                                </li>
                                <li>
                                    <a href="#0">Jobs</a>
                                </li>
                                <li>
                                    <a href="#0">Press</a>
                                </li>
                                <li>
                                    <a href="#0">Our blog</a>
                                </li>
                                <li>
                                    <a href="#0">Collectors' portal</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-widget widget-links">
                            <h5 class="title">We're Here to Help</h5>
                            <ul class="links-list">
                                <li>
                                    <a href="#0">Your Account</a>
                                </li>
                                <li>
                                    <a href="#0">Safe and Secure</a>
                                </li>
                                <li>
                                    <a href="#0">Shipping Information</a>
                                </li>
                                <li>
                                    <a href="#0">Contact Us</a>
                                </li>
                                <li>
                                    <a href="#0">Help & FAQ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-widget widget-follow">
                            <h5 class="title">Follow Us</h5>
                            <ul class="links-list">
                                <li>
                                    <a href="#0"><i class="fas fa-phone-alt"></i>(646) 663-4575</a>
                                </li>
                                <li>
                                    <a href="#0"><i class="fas fa-blender-phone"></i>(646) 968-0608</a>
                                </li>
                                <li>
                                    <a href="#0"><i class="fas fa-envelope-open-text"></i><span class="__cf_email__" data-cfemail="b6ded3dac6f6d3d8d1d9c2ded3dbd398d5d9db">[email&#160;protected]</span></a>
                                </li>
                                <li>
                                    <a href="#0"><i class="fas fa-location-arrow"></i>1201 Broadway Suite</a>
                                </li>
                            </ul>
                            <ul class="social-icons">
                                <li>
                                    <a href="#0" class="active"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="#0"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#0"><i class="fab fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#0"><i class="fab fa-linkedin-in"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="copyright-area">
                    <div class="footer-bottom-wrapper">
                        <div class="logo">
                            <a href="index.html"><img src="assets/images/logo/footer-logo.png" alt="logo"></a>
                        </div>
                        <ul class="gateway-area">
                            <li>
                                <a href="#0"><img src="assets/images/footer/paypal.png" alt="footer"></a>
                            </li>
                            <li>
                                <a href="#0"><img src="assets/images/footer/visa.png" alt="footer"></a>
                            </li>
                            <li>
                                <a href="#0"><img src="assets/images/footer/discover.png" alt="footer"></a>
                            </li>
                            <li>
                                <a href="#0"><img src="assets/images/footer/mastercard.png" alt="footer"></a>
                            </li>
                        </ul>
                        <div class="copyright"><p>&copy; Copyright 2021 | <a href="#0">Sbidu</a> By <a href="#0">Uiaxis</a></p></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--============= Footer Section Ends Here =============-->



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


<!-- Mirrored from pixner.net/sbidu/main/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Jul 2021 17:06:34 GMT -->
</html>