<?php
session_start() ; 
include_once 'config.php' ;
include_once 'config1.php' ;
require_once 'model/produit.php' ; 
require_once 'controller/produitC.php' ;
include 'connect.php' ;
$max_total = 0 ; 
$produitC = new produitC() ; 
$produits = $produitC->afficherProduitsID($_GET["id_prod"]) ;

foreach ($produits as $produit) {
    $id_prod = $produit["id_prod"] ; 
    $nom_prod = $produit["nom_prod"] ;
    $prixbout_prod = $produit["prixbout_prod"] ; 
    $total_prod = $produit["total_prod"] ; 
    $participation_prod = $produit["participation_prod"] ; 
    $category_prod = $produit["category_prod"] ; 
    $photo_prod = $produit["photo_prod"];
    $desc_prod = $produit["desc_prod"] ; 
    $bid_prod = $produit["bid_prod"] ; 
    $depart_prod = $produit["depart_prod"] ;
    $finish_prod = $produit["finish_prod"] ; 
    /*$temps_prod = $produit["temps_prod"] ; */ 

    $_SESSION["bid_prod"] = $bid_prod ;   
    $_SESSION["id_prod"] = $produit["id_prod"] ; 
    $_SESSION['finish_prod'] = $produit['finish_prod'] ; 
}

$part = $total_prod/100 ; 
if (isset($_SESSION["id_user"])) {
    $id_user = $_SESSION['id_user'] ; 
}

if (isset($_POST["submit"])) {
    header("location:index.php") ; 
    echo "<script>window.top.location='ajouter_participant.php?id_user=$id_user&id_prod=$id_prod&participation=$part&details=1'</script>" ;
}



$req = "select * from salle where id_prod='$id_prod' ORDER BY total_ench DESC limit 1" ; 
$result = $con->query($req) ; 

if ($result->num_rows>0) {
    if ($participation_prod==$total_prod) {
        $salle_ench = 1 ; 
        while ($row = $result->fetch_assoc()) {
            $max_user = $row["id_user"] ; 
            $max_total = $row["total_ench"] ; 
            $max_date = $row["date_ench"] ; 

        }

        $req = "select * from user where id_user='$max_user'" ; 
        $result = $con->query($req) ; 
        if ($result->num_rows>0) {
            while ($row = $result->fetch_assoc()) {
            $max_user = $row["nom_user"]." ".$row["prenom_user"] ;   

            }
        }
    } else {
        $salle_ench = 0 ;
    }
    

} else {
    $salle_ench = 0 ; 
}





if ((isset($_POST["soumettre"]))&&($finish_prod==0)) {
    require_once 'model/salle.php' ; 
    require_once 'controller/salleC.php' ;
    require_once 'model/user.php' ; 
    require_once 'controller/userC.php' ;
    // ============== CHECK IF USER HAS ENOUGH TOKEN DIFF ========================
        $req = "select * from salle where id_prod='$id_prod' and id_user='$id_user' and winner=1" ; 
        $result = $con->query($req) ; 

        if ($result->num_rows!=0) {
           
            while ($row = $result->fetch_assoc()) {
                $budget_final = $_SESSION["budget"] + $row["total_ench"] - $_POST["enchere"] ; 
                $ecart = $_POST["enchere"] - $row["total_ench"] ;  
                $winner = 1 ; 
            }
        } else {
            $budget_final = $_SESSION["budget"] - $_POST["enchere"] ; 
            $ecart = $_POST["enchere"] ; 
            $winner = 0 ; 
        }
         
    // =============== DECREASE TOKEN USER ==========================================
    if  ($budget_final>=0) {

        $userC = new userC() ; 
        $users = $userC->modifier_user_budget($_POST["enchere"],$id_user) ;
        $_SESSION["budget"] -= $_POST["enchere"] ; 

        // ===== RECUPERER LAST TOKEN ENCHERE IF EXISTS====================
        $req = "select * from salle where id_prod='$id_prod' and id_user='$id_user'" ; 
        $result = $con->query($req) ; 

        if ($result->num_rows!=0) {
           
            while ($row = $result->fetch_assoc()) {
                if ($winner==1) {
                    $loser = $userC->recuperer_losers($row["total_ench"],$id_user) ;   
                    $_SESSION["budget"] += $row["total_ench"] ; 
                }
            }
        }  

        // ========== RECUPERER OTHERS' TOKENS ==============================
 
        $salleC = new salleC() ; 
        $users = $salleC->find_losers($id_user,$id_prod) ;
        foreach ($users as $user) {
            $loser = $userC->recuperer_losers($user["total_ench"],$user["id_user"]) ;
        }

        // ================= SALLE ENCHERES ============================================
        $req = "select * from salle where id_prod='$id_prod' and id_user='$id_user'" ; 
        $result = $con->query($req) ; 

        $user_enchere = -1 ; 
        if ($result->num_rows!=0) {
            $user_enchere = 1 ; 
            while ($row = $result->fetch_assoc()) { 

            }
        } else {
            $user_enchere = 0 ; 
        }

         

        // ============== ALL LOSERS ======================
        $salleC = new salleC() ; 
        $salles = $salleC->change_losers($id_prod) ;


        if ($user_enchere==0) { // ========== USER FIRST TIME ENCHERE ================
            $date = date('Y-m-d H:i:s');
            $salle = new salle($_SESSION['id_user'],$id_prod,$_POST["enchere"],date('Y-m-d H:i:s')) ; 
            $salleC = new salleC() ; 
            $salles = $salleC->ajouter_salle($salle) ; 
        } else if ($user_enchere==1) { // ========= USER A ENCHERE AVANT ==============
             
            $salle = new salle($_SESSION['id_user'],$id_prod,$_POST["enchere"],date('Y-m-d H:i:s')) ; 
            $salleC = new salleC() ; 
            $salles = $salleC->delete_enchere($id_user,$id_prod) ;
            $salles = $salleC->ajouter_salle($salle) ; 
        }

        // ========== CHECK IF TIMER IS 30 SEC OR LESS ============

        $produitC = new produitC() ; 
        $produits = $produitC->afficherProduitsID($_SESSION["id_prod"]) ;

        foreach ($produits as $produit) {
            $defaultTimeZone='UCT'; 
            $new_time = date("Y-m-d H:i:s", strtotime('+1 hours')) ; 

            $date_debut = new DateTime($new_time) ;  

            $date_fin = new DateTime($produit['temps_fin']) ;  

            $diff = $date_debut->diff($date_fin) ;  
 
            if ($diff->format("%H:%I:%S")<="23:59:00") {
                $produit = new produit( "", "" ,"" ,"" , "", "",date("Y-m-d h:i:s", strtotime('+ 1 hour 30 seconds')));  
                $produits = $produitC->modifier_produit_tempsfin($id_prod,$produit) ; 
            }
            
        }
        // ========== END CHECKINGS ===============================

       echo "<script>window.top.location='product-details.php?id_prod=".$id_prod."'</script>" ;
    } else {
        $error_recharge = "Pas assez de Token, Veuillez recharger votre compte." ; 
    } 
    
    
} else if ((isset($_POST["soumettre"]))&&($finish_prod==1)) {
    echo "<script>window.top.location='product-details.php?id_prod=".$id_prod."'</script>" ;
}


?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php echo $nom_prod ;  ?></title>

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


<script>
function loadXMLDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("counter").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "counter.php", true);
  xhttp.send();
}
setInterval(function(){
    loadXMLDoc();
    // 1sec
},1000);

window.onload = loadXMLDoc;
</script>


 
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
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <span>Details Produits</span>
                </li>
            </ul>
        </div>
        <div class="bg_img hero-bg bottom_center" data-background="assets/images/banner/hero-bg.png"></div>
    </div>
    <!--============= Hero Section Ends Here =============-->


    <!--============= Product Details Section Starts Here =============-->
    <section class="product-details padding-bottom mt--240 mt-lg--440">
        <div class="container">
            <div class="product-details-slider-top-wrapper">
                <div class="product-details-slider owl-theme owl-carousel" id="sync1">
                    <center>
                    <div class="slide-top-item" style="height:300px ; width:300px ;">
                        
                            <div class="slide-inner" style="height:400px ; width:300px ; vertical-align: middle; ">
                                <img  src="<?= $photo_prod ;  ?>" id="photo" alt="product">
                            </div>                        
                    </div>
                    </center>

                </div>
            </div>
            
            <div class="row mt-40-60-80" id="photo">
                <div class="col-lg-8">
                    <div class="product-details-content">
                        <div class="product-details-header">
                            <h2 class="title"><?php echo $nom_prod ;  ?></h2>
                            <ul>
                                <li>Category : <?php echo $category_prod ; ?></li>
                                <li>Item #: 7300-<?php echo $id_prod ;  ?></li>
                            </ul>
                        </div>
                        <ul class="price-table mb-30">
                            <li class="header">
                                <?php if (($salle_ench==0)||($bid_prod==0)) { ?>
                                <h5 class="current">Token nécessaires</h5>
                                <h3 class="price"><?php echo $total_prod ;  ?></h3>
                            <?php } else { ?>
                                <h5 class="current">Enchère max. atteinte</h5>
                                <h3 class="price"><?php echo $max_total." Token" ;  ?></h3>

                            <?php }  ?>
                            </li>

                            <?php if (($salle_ench==1)&&($bid_prod==1)) { ?>
                            <li>
                                <span class="details">Utilisateur avec max. enchères</span>
                                <h5 class="info" style="color : green"><?php echo $max_user ; ?></h5>
                            </li>

                            <?php }  ?> 
                            <li>
                                <span class="details">Prix boutique</span>
                                <h5 class="info"><?php echo $prixbout_prod." DT" ; ?></h5>
                            </li>
                            <li>
                                <span class="details">Prix départ</span>
                                <h5 class="info"><?php echo $depart_prod." Token" ;  ?></h5>
                            </li>
                            <?php
                            if ($bid_prod==1) { ?>
                            <li>
                                <span class="details" style="color : green">La salle d'enchères est ouverte. Veuillez soumettre une offre maintenant avant la fin du décompteur.</span>
                                <h5 class="info"> </h5>
                            </li>
                            <?php } ?>
                        </ul>





                        <div class="product-bid-area" id ="bidarea">
                            <?php if (($bid_prod==1)&&(isset($_SESSION["id_user"]))) {
                                    // =================== CHECK USER IS A PARTICIPANT ================================
                                    $user_participant = 0 ; 
                                     
                                        $user_participant = 1; 
                                        $req = "select * from participant where id_prod='$id_prod' and id_user='$id_user'" ; 
                                        $result = $con->query($req) ; 

                                        if ($result->num_rows!=0) {
                                             
                                            $user_participant = 1 ; 
                                        } else {
                                             
                                            $user_participant = 0 ; 
                                        }
                                      
                                    if ((isset($user_participant))&&($user_participant==1)) { // ====== PARTICIPANT=======
                                        if ($finish_prod==0) { //============ PRODUCT STILL BIDDING ===============
                            ?>          
                                        <form class="product-bid-form" action="" method="POST">
                                            <div class="search-icon">
                                                <img src="assets/images/product/search-icon.png" alt="product">
                                            </div>
                                            
                                            <input style="color : black ; font-weight: bold ;  " name="enchere" type="number" placeholder="Enter you bid amount" value="<?= $depart_prod+$max_total ?>" min="<?= $depart_prod+$max_total ?>">
                                            <div>
                                                Token
                                            </div>
                                            <button type="submit" name="soumettre" class="custom-button">Soumettre Une Offre</button>
                                        </form>
                                        <div style="color : red ; ">
                                            <?php if (isset($error_recharge)) {
                                                echo $error_recharge ; 
                                                $error_recharge="" ;
                                            }   ?>
                                        </div>

                            <?php
                                        } else if ($finish_prod==1) { // =============== PRODUCT FINISHED ========== ?>


                                        <span style="color : green ; font-size: 17px ; font-weight: bold ;  ">
                                            La salle d'enchères est fermée, cet article a été déjà remporté par Mr. <?php echo $max_user ;  ?>, Félicitations pour le gagnant.
                                             
                                        </span>




                            <?php
                                        }
                                    } else { // ============ NON PARTICIPANT ===================   

                                        ?>

                                        <span style="color : orange ; font-size: 17px ; ">
                                            Vous n'avez pas participé à la salle d'enchères de ce produit. Participez plus vite la prochaine fois.   
                                             
                                        </span>



                                <?php
                                    }
                                } else {
                                     
                                    if (isset($_SESSION['id_user'])) { // ========== CONNECTE ==============
                                    $req = "select * from participant where id_user='$id_user' and id_prod='$id_prod'" ; 
                                    $result = $con->query($req) ; 

                                     if ($result->num_rows!=0) { 
                                    ?>
                                    <span style="color : green ; font-size: 17px ; ">
                                        Vous avez déjà participé à la salle d'enchères de cet article.
                                         
                                    </span>
                                    <?php     
                                    } else if ($bid_prod==0) { ?>
                                        <form class="product-bid-form" action="" method="post">
                                             
                                            <span>Participer pour accéder à la salle d'enchères de cet article.</span>
                                            <a href="ajouter_participant.php?id_user=<?= $id_user ?>&id_prod=<?= $id_prod ?>&participation=<?= $part ?>&details=1" type="submit" id="submit" style="color:white ; " class="custom-button">Participer à <?php echo $total_prod/100 ;  ?> Token</a>
                                        </form>


                                    <?php
                                    }
                                    } else { // =================== NON CONNECTE ================= 
                                        if ($bid_prod==0) {
                                        ?>

                                        <form class="product-bid-form" action="" method="post">
                                             
                                            <span>Participer pour accéder à la salle d'enchères de cet article.</span>
                                            <a href="sign-in.php" type="submit" id="submit" style="color:white ; " class="custom-button">Participer à <?php echo $total_prod/100 ;  ?> Tokens</a>
                                        </form>


                                    <?php } else if ($bid_prod==1) { ?>

                                        <form class="product-bid-form" action="" method="post">
                                             
                                            <span>Participer pour accéder à la salle d'enchères de cet article.</span>
                                            <a href="sign-in.php" type="submit" id="submit" style="color:white ; " class="custom-button">Connectez-vous</a>
                                        </form>


                                    <?php }
                                    }
                                }
                            ?>
                        

                        </div>
                         



                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="product-sidebar-area">
                        <div class="product-single-sidebar mb-3">
                            <?php if  ($bid_prod==1)  { ?>
                                <h6 class="title">Temps restant : </h6>


                                    <div class="countdown" id="counter">
                                         
                                    </div>




                            <?php } else { ?>
                                <div style="color : orange ; ">
                                    La salle d'enchères s'ouvrira à 100%. 
                                </div>


                            <?php } ?>
                            <div class="side-counter-area">
                                <div class="side-counter-item">
                                    <div class="thumb">
                                        <img src="assets/images/product/icon1.png" alt="product">
                                    </div>
                                    <div class="content">
                                        <h3 class="count-title"><span class="counter"><?php echo $participation_prod ;    ?></span></h3>
                                        <p>Tokens dépensés pour participer</p>
                                    </div>
                                </div>
                                <div class="side-counter-item">
                                    <div class="thumb">
                                        <img src="assets/images/product/icon2.png" alt="product">
                                    </div>
                                    <div class="content">
                                        <h3 class="count-title"><span class="counter"><?php echo $participation_prod/($total_prod/100) ;    ?></span></h3>
                                        <p>Participants</p>
                                    </div>
                                </div>
                                <div class="side-counter-item">
                                    <div class="thumb">
                                        <img src="assets/images/product/icon3.png" alt="product">
                                    </div>
                                    <div class="content">
                                        <h3 class="count-title"><span class="counter"><?php echo $participation_prod*100/$total_prod ;   ?></span>%</h3>
                                        <p>Salle remplie</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#0" class="cart-link">View Shipping, Payment & Auction Policies</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-tab-menu-area mb-40-60 mt-70-100">
            <div class="container">
                <ul class="product-tab-menu nav nav-tabs">
                    <li>
                        <a href="#details" class="active" data-toggle="tab">
                            <div class="thumb">
                                <img src="assets/images/product/tab1.png" alt="product">
                            </div>
                            <div class="content">Description</div>
                        </a>
                    </li>
                    <li>
                        <a href="#delevery" data-toggle="tab">
                            <div class="thumb">
                                <img src="assets/images/product/tab2.png" alt="product">
                            </div>
                            <div class="content">Livraison</div>
                        </a>
                    </li>
                    <li>
                        <a href="#history" data-toggle="tab">
                            <div class="thumb">
                                <img src="assets/images/product/tab3.png" alt="product">
                            </div>
                            <div class="content">Historique des enchères</div>
                        </a>
                    </li>
                    <li>
                        <a href="#questions" data-toggle="tab">
                            <div class="thumb">
                                <img src="assets/images/product/tab4.png" alt="product">
                            </div>
                            <div class="content">Questions </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="details">
                    <div class="tab-details-content">
                        <div class="header-area">
                            <h3 class="title"><?php echo $nom_prod ;  ?></h3>
                            <!--div class="item">
                                <table class="product-info-table">
                                    <tbody>
                                        <tr>
                                            <th>Condition</th>
                                            <td>New</td>
                                        </tr>
                                        <tr>
                                            <th>Mileage</th>
                                            <td>15,000 miles</td>
                                        </tr>
                                        <tr>
                                            <th>Year</th>
                                            <td>09-2017</td>
                                        </tr>
                                        <tr>
                                            <th>Engine</th>
                                            <td>I-4 1,5 l</td>
                                        </tr>
                                        <tr>
                                            <th>Fuel</th>
                                            <td>Regular</td>
                                        </tr>
                                        <tr>
                                            <th>Transmission</th>
                                            <td>Automatic</td>
                                        </tr>
                                        <tr>
                                            <th>Color</th>
                                            <td>Blue</td>
                                        </tr>
                                        <tr>
                                            <th>Doors</th>
                                            <td>5</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div-->
                            <div class="item">
                                <h5 class="subtitle">Description</h5>
                                <ul>
                                    <li><?php echo $desc_prod ;  ?></li> 
                                </ul>
                            </div>
                              
                            <div class="item">
                                <h5 class="subtitle">Participation</h5>
                                <p>Les participants seront notifiés et vont recevoir un mail, une fois la salle d'enchères relative à cet article s'ouvre.</p>
                                 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="delevery">
                    <div class="shipping-wrapper">
                        <div class="item">
                            <h5 class="title">shipping</h5>
                            <div class="table-wrapper">
                                <table class="shipping-table">
                                    <thead>
                                        <tr>
                                            <th>Available delivery methods </th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Customer Pick-up (within 10 days)</td>
                                            <td>$0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Standard Shipping (5-7 business days)</td>
                                            <td>Not Applicable</td>
                                        </tr>
                                        <tr>
                                            <td>Expedited Shipping (2-4 business days)</td>
                                            <td>Not Applicable</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="item">
                            <h5 class="title">Notes</h5>
                            <p>Please carefully review our shipping and returns policy before committing to a bid.
                            From time to time, and at its sole discretion, Sbidu may change the prevailing fee structure for shipping and handling.</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="history">
                    <div class="history-wrapper">
                        <div class="item">
                            <h5 class="title">Historique des enchères</h5>
                            <div class="history-table-area">

                                <?php 
                                if ($bid_prod==1) {   ?>


                                <table class="history-table">
                                    <thead>
                                        <tr>
                                            <th>Participant</th>
                                            <th>Date</th>
                                            <th>Enchère</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once 'config.php' ;
                                        require_once 'model/salle.php' ; 
                                        require_once 'controller/salleC.php' ;
                                        require_once 'model/user.php' ; 
                                        require_once 'controller/userC.php' ;

                                        $salleC = new salleC() ; 
                                        $userC = new userC() ; 
                                        $salles = $salleC->afficherSalle($id_prod) ;

                                        foreach ($salles as $salle) {
                                            $users = $userC->afficherUser($salle["id_user"]) ;    
                                            foreach ($users as $user) { 
                                            ?>
                                            <tr>
                                                <td data-history="Participant">
                                                    <div class="user-info">
                                                        <!--div class="thumb">
                                                            <img src="assets/images/history/01.png" alt="history">
                                                        </div-->
                                                        <div class="content">
                                                            <span style="margin-top: 10px !important; ">
                                                            <?php 
                                                            if ($user["pdp_user"]=="") {
                                                                echo '<img style="border-radius : 50% ; margin-bottom : 20px;  " height=50px width=50px src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="Image" >' ;

                                                            } else {
                                                                echo '<img style="border-radius : 50% ; margin-bottom : 20px;  " height=50px width=50px src="data:image;base64,'.base64_encode($user['pdp_user']).'" alt="Image" >' ; 
                                                            } ?>
                                                            </span>
                                                            <span style="margin-top: -10px !important ; ">
                                                                &nbsp;&nbsp;
                                                                <?php echo $user["nom_user"].' '.$user["prenom_user"] ; ?> 
                                                            </span>
                                                              
                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-history="Date"><?php echo $salle["date_ench"] ;  ?></td> 
                                                <td data-history="Enchère"><?php echo $salle["total_ench"]." Token" ;  ?></td>
                                            </tr>
                                            <?php
                                            }
                                        }
                                        ?>
                                         
                                    </tbody>    
                                </table>

                            <?php } else { ?>

                                <dir>La salle d'enchères est encore fermée. Participer maintenant pour pouvoir la rejoindre dès qu'elle s'ouvre.</dir>

                                <?php
                                }
                                ?>

                                <!--div class="text-center mb-3 mt-4">
                                    <a href="#0" class="button-3">Load More</a>
                                </div-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="questions">
                        <h5 class="faq-head-title">Questions fréquemment posées</h5>
                        <div class="faq-wrapper">
                            <div class="faq-item">
                                <div class="faq-title">
                                    <img src="assets/css/img/faq.png" alt="css"><span class="title">Comment Rejoindre la salle d'enchères</span><span class="right-icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>Il suffit de cliquer sur le boutton de participation afin de réserver votre place dans la salle d'enchères.</p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-title">
                                    <img src="assets/css/img/faq.png" alt="css"><span class="title">Ce sont quoi les Tokens </span><span class="right-icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>Les Tokens sont une monnaie virtuelle utilisée pour participer aux différents articles dans notre site. Les Tokens peuvent être achetés ICI avec de l'argent réel (DT) mais ne peuvent pas être convertis en DT.</p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-title">
                                    <img src="assets/css/img/faq.png" alt="css"><span class="title">Comment Enchérir et gagner un article </span><span class="right-icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>Une fois la salle d'enchères d'un produit est remplie à 100%, cette salle s'ouvrira avec un décompteur de 24 heures, les participants auront la possibilité d'enchèrir avec des Tokens et chaque enchérissemnt va ajouter 20 secondes au décompteur. Le dernier qui enchèrit sans être interrompu par un autre enchérissemnt gagnera l'article. </p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-title">
                                    <img src="assets/css/img/faq.png" alt="css"><span class="title">Lorsque je gagne, Comment je fais pour recevoir mon article</span><span class="right-icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>Une fois vous êtes un gagnant, allez au bloc "Profile", cliquez sur "Mes Enchères Gagnantes", vous trouverez l'article que vous avez gagnés et vous aurez la possibilité de régler vos informations de livraison. </p>
                                </div>
                            </div>
                            <div class="faq-item open active">
                                <div class="faq-title">
                                    <img src="assets/css/img/faq.png" alt="css"><span class="title">Si je perd, Est-ce que je vais récupérer mes Tokens</span><span class="right-icon"></span>
                                </div>
                                <div class="faq-content">
                                    <p>Oui évidemment vous allez récupérer tout les Tokens que vous avez utilisés pour les enchèrissemnts (au cas où vous perdez), seuls les Token utilisés pour la participation à la salle d'enchères seront sanctionnés dans les deux cas.</p>
                                </div>
                            </div>
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= Product Details Section Ends Here =============-->


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


<!-- Mirrored from pixner.net/sbidu/main/product-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Jul 2021 17:06:29 GMT -->
</html>