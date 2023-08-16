<?php
session_start() ; 
if (isset($_SESSION["username"])) {
    echo "<script>window.top.location='index.php'</script>" ;
}

if (isset($_POST["submit"])) {
    if ((empty($_POST["nom"]))||(empty($_POST["prenom"]))||(empty($_POST["adresse"]))) {
        $error = "Veuillez remplir tous les champs." ; 
    } else if (strlen($_POST["telephone"])!=8) {
        $error = "Veuillez entrer un numéro de téléphone valide." ; 
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error = "Adresse email invalide.";
    } else if ($_POST["password"] != $_POST["repassword"]) {
        $error = "Les 2 mots de passes ne sont pas identiques." ; 
    } else if (!isset($_POST["terms"])) {
        $error= "Vous devez accepter les termes et les conditions." ; 
    } else {
        include 'connect.php' ; 
        include_once 'config.php' ;
        include_once 'config1.php' ;
        require_once 'model/user.php' ; 
        require_once 'controller/userC.php' ; 
        require_once 'model/referrals.php' ; 
        require_once 'controller/referralsC.php' ; 

        $email=$_POST["email"] ; 
        $req = "select * from user where email_user='$email' " ; 
        $result = $con->query($req) ;  
        if ($result->num_rows!=0) { 
            $error = "Cet adresse email existe déjà.";
        } else {
             $image = "nouser.jpg"; 
                $imgContent = addslashes(file_get_contents($image)); 

            // ========= CREATE REF CODE =============
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 10; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $userC = new userC() ; 
            $users = $userC->afficher_MAXID() ; 
            foreach ($users as $user) {
                $max = $user['max'] ; 
            }

            $randomString = $max.$randomString ; 
            // ========== END REF CODE ===============
            $user = new user($_POST["nom"], $_POST["prenom"],$_POST["telephone"],$_POST["email"],$_POST["password"],10,$_POST["adresse"],$imgContent,$randomString) ; 
            $userC = new userC() ; 
            $users = $userC->ajouter_user($user) ; 
            $error = "" ; 
            $email= $_POST["email"] ; 
            $_SESSION["username"] = $_POST["nom"]." ".$_POST["prenom"] ;  
            $_SESSION["nom"] = $_POST["nom"] ; 
            $_SESSION["prenom"] = $_POST["prenom"] ; 
            $_SESSION["telephone"] = $_POST["telephone"] ; 
            $_SESSION["email"] = $_POST["email"] ; 
            $_SESSION["budget"] = 10 ; 
            $_SESSION["adresse"] = $_POST["adresse"] ;
            $_SESSION["password"] = $_POST["password"] ;
            $_SESSION["pdp_user"] = $imgContent ;
            $_SESSION["verif_user"] = 0 ; 


            $req = "select * from user where email_user='$email'" ; 
            $result = $con->query($req) ; 

            if ($result->num_rows!=0) {
                while ($row = $result->fetch_assoc()) {
                $_SESSION["id_user"] = $row["id_user"] ;
                } 
            }

            // ============= ADD REFERRAL ==========================
            if (isset($_GET['id_ref'])) {  


                $userC = new userC() ; 
                $users = $userC->afficherUser_refcode($_GET['id_ref']) ;
                if (!empty($users)) {
                foreach ($users as $row) {
                    $id_user2 = $row['id_user'] ; 
                    $id_user1 = $_SESSION['id_user'] ; 
                    $referrals = new referrals($id_user1,$id_user2) ; 
                    $referralsC = new referralsC() ; 
                    $refs = $referralsC->ajouter_referrals($referrals) ; 
                }
            }
            }

            // ============ END REFERRAL ===========================
            echo "<script>window.top.location='index.php'</script>" ;
        }


        
    }
        
    

    
}

?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from pixner.net/sbidu/main/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Jul 2021 17:06:30 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>S'inscrire</title>

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
                    <span>Sign Up</span>
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
                        <h2 class="title">S'inscrire</h2>
                        <?php
                            if (isset($_GET['id_ref'])) { 
                                include_once 'config.php' ;
                                require_once 'model/user.php' ; 
                                require_once 'controller/userC.php' ;


                                $userC = new userC() ; 
                                $users = $userC->afficherUser_refcode($_GET['id_ref']) ;
                                if (!empty($users)) {
                                foreach ($users as $row) {
                                    $username = $row["prenom_user"] . ' ' . $row["nom_user"] ;  ?>
                                    <div style="font-weight: bold ; color : black; ">Votre ami <span style="color : #07C941 ; "><?php echo $username ;  ?></span> vous offre 5 tokens gratuitement, inscrivez-vous maintenant. </div>

                                <?php
                                }
                            } else { ?>
                                <p>Bienvenue chez nous, veuillez entrer vos détails afin de créer votre compte.</p>

                      <?php }
                                

                               
                            } else {

                                echo "<p>Bienvenue chez nous, veuillez entrer vos détails afin de créer votre compte.</p>" ; 

                            }
                        ?>
                        
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
                            <label for="login-email"><i class="far fa-address-book"></i></label>
                            <input type="text" id="login-email" name="nom" placeholder="Nom">
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-email"><i class="far fa-address-book"></i></label>
                            <input type="text" id="login-email" name="prenom" placeholder="Prenom">
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-email"><i class="fas fa-phone-square"></i></label>
                            <input type="text" id="login-email" name="telephone" placeholder="Téléphone (+216)">
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-email"><i class="far fa-building"></i></i></label>
                            <input type="text" id="login-email" name="adresse" placeholder="Adresse">
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-email"><i class="far fa-envelope"></i></label>
                            <input type="text" id="login-email" name="email" placeholder="Adresse Email">
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-pass"><i class="fas fa-lock"></i></label>
                            <input type="password" id="login-pass" name="password" placeholder="Mot de passe">
                            <span class="pass-type"><i class="fas fa-eye"></i></span>
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-pass"><i class="fas fa-lock"></i></label>
                            <input type="password" id="login-pass" name="repassword" placeholder="Réentrez mot de passe">
                            <span class="pass-type"><i class="fas fa-eye"></i></span>
                        </div>


                        <div class="form-group checkgroup mb-30">
                            <input type="checkbox" name="terms" value="checked" id="check"><label for="check">J'accepte les termes et les conditions.</label>
                        </div>
                        <div class="form-group  mb-30" style="color : red ; ">
                            <?php 
                                if (isset($error)) {
                                    echo $error ; 
                                }
                             ?>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" name="submit" class="custom-button">S'inscrire</button>
                        </div>
                    </form>
                </div>
                <div class="right-side cl-white">
                    <div class="section-header mb-0">
                        <h3 class="title mt-0">Vous avez déjà un compte?</h3>
                        <p>Connectez vous.</p>
                        <a href="sign-in.php" class="custom-button transparent">Se Connecter</a>
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


<!-- Mirrored from pixner.net/sbidu/main/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Jul 2021 17:06:30 GMT -->
</html>