<?php
include 'connect.php' ; 
    session_start() ; 
    $error = "" ; 
    if (isset($_SESSION["username"]))
    {
        echo "<script>window.top.location='index.php'</script>" ; 
    } 
    
    if (isset($_POST["submit"])) { 
    $email = $_POST["email"] ; 
    $password = $_POST["password"] ; 

    $req = "select * from user where email_user='$email' and password_user='$password'" ; 
    $result = $con->query($req) ; 

    if ($result->num_rows!=0) {
           
        echo "<script>window.top.location='index.php'</script>" ;
        while ($row = $result->fetch_assoc()) {
                $_SESSION["username"] = $row["nom_user"]." ".$row["prenom_user"] ;
                $_SESSION["nom"] = $row["nom_user"] ; 
                $_SESSION["prenom"] = $row["prenom_user"] ; 
                $_SESSION["telephone"] = $row["telephone_user"] ; 
                $_SESSION["email"] = $row["email_user"] ; 
                $_SESSION["budget"] = $row["budget_user"] ; 
                $_SESSION["adresse"] = $row["adresse_user"] ;  
                $_SESSION["password"] = $_POST["password"] ;
                $_SESSION["id_user"] = $row["id_user"] ;
                $_SESSION["pdp_user"] = $row["pdp_user"] ;
                $_SESSION["header_profile"] =  "" ; 
            }
        
    } else {
        $error = "Utilisateur non reconnu." ; 
    }

}

?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from pixner.net/sbidu/main/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Jul 2021 17:01:09 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Se Connecter</title>

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
    <div class="hero-section">
        <!--div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a href="#0">Pages</a>
                </li>
                <li>
                    <span>Sign In</span>
                </li>
            </ul>
        </div-->
        <div class="bg_img hero-bg bottom_center" data-background="assets/images/banner/hero-bg.png"></div>
    </div>
    <!--============= Hero Section Ends Here =============-->


    <!--============= Account Section Starts Here =============-->
    <section class="account-section padding-bottom">
        <div class="container">
            <div class="account-wrapper mt--100 mt-lg--440">
                <div class="left-side">
                    <div class="section-header">
                        <h2 class="title">Bienvenue</h2>
                        <p>Veuillez entrer vos détails pour vous connecter.</p>
                    </div>
                    <!--ul class="login-with">
                        <li>
                            <a href="#0"><i class="fab fa-facebook"></i>Log in with Facebook</a>
                        </li>
                        <li>
                            <a href="#0"><i class="fab fa-google-plus"></i>Log in with Google</a>
                        </li>
                    </ul>
                    <div class="or">
                        <span>Or</span>
                    </div-->
                    <form class="login-form" action="" method="POST">
                        <div class="form-group mb-30">
                            <label for="login-email"><i class="far fa-envelope"></i></label>
                            <input type="text" id="login-email" name="email" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <label for="login-pass"><i class="fas fa-lock"></i></label>
                            <input type="password" id="login-pass" name="password" placeholder="Password">
                            <span class="pass-type"><i class="fas fa-eye"></i></span>
                        </div>
                        <div class="form-group">
                            <div style="color : red ; "><?php echo $error ; $error ="" ;  ?></div>
                            <a href="#0">Mot de passe oublié?</a>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" name="submit" class="custom-button">Se Connecter</button>
                        </div>
                    </form>
                </div>
                <div class="right-side cl-white">
                    <div class="section-header mb-0">
                        <h3 class="title mt-0">Nouveau ici ?</h3>
                        <p>Créez votre compte et commencez vos enchéres.</p>
                        <a href="sign-up.php" class="custom-button transparent">S'inscrire</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= Account Section Ends Here =============-->


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


<!-- Mirrored from pixner.net/sbidu/main/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Jul 2021 17:01:09 GMT -->
</html>