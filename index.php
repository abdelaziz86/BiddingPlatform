<?php 
    session_start() ; 
    include 'connect.php' ; 
?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Accueil</title>

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

    


    <!--============= Banner Section Starts Here =============-->
    <section class="banner-section bg_img" data-background="assets/images/banner/banner-bg-1.png">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 col-xl-6">
                    <div class="banner-content cl-white">
                        <h5 class="cate">Vente aux enchères</h5>
                        <h1 class="title"><span class="d-xl-block">
Trouver votre </span> Prochaine affaire !</h1>
                        <p>
                            La vente aux enchères en ligne est l'endroit où tout le monde participe et gagne des articles avec des remises exceptionnelles tout en découvrant la variété et l'abordabilité.
                        </p>
                        <a href="#scrollit" class="custom-button yellow btn-large">Commencer à gagner</a>
                    </div>
                </div>
                <div class="d-none d-lg-block col-lg-6">
                    <div class="banner-thumb-2">
                        <img src="assets/images/banner/banner-1.png" alt="banner">
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-shape d-none d-lg-block">
            <img src="assets/css/img/banner-shape.png" alt="css">
        </div>
    </section>
    <!--============= Banner Section Ends Here =============-->


    <div class="browse-section ash-bg" style="background-color: white ; margin-bottom: -20px ; ">
        <!--============= Hightlight Slider Section Starts Here =============-->
        <div class="browse-slider-section mt--140">
            <div class="container">
                <div class="section-header-2 cl-white mb-4">
                    <div class="left">
                        <h6 class="title pl-0 w-100">Choisir une catégorie</h6>
                    </div>
                    <div class="slider-nav">
                        <a href="#0" class="bro-prev"><i class="flaticon-left-arrow"></i></a>
                        <a href="#0" class="bro-next active"><i class="flaticon-right-arrow"></i></a>
                    </div>
                </div>
                <div class="m--15">
                    <div class="browse-slider owl-theme owl-carousel">
                        <a href="index.php?category=Electronique#scrollit" class="browse-item">
                            <img src="assets/images/auction/04.png" alt="auction">
                            <span class="info">Electronique</span>
                        </a>
                        <a href="index.php?category=Sport#scrollit" class="browse-item">
                            <img src="assets/images/auction/05.png" alt="auction">
                            <span class="info">Sport</span>
                        </a>

                        <a href="index.php?category=Vehicule#scrollit" class="browse-item">
                            <img src="assets/images/auction/01.png" alt="auction">
                            <span class="info">Vehicule</span> 
                        </a>
                        <a href="index.php?category=Bijoux#scrollit" class="browse-item">
                            <img src="assets/images/auction/02.png" alt="auction">
                            <span class="info">Bijoux</span>
                        </a>
                        <a href="index.php?category=Montre#scrollit" class="browse-item">
                            <img src="assets/images/auction/03.png" alt="auction">
                            <span class="info">Montre</span>
                        </a>
                        <a href="index.php?category=Immobilier#scrollit" class="browse-item">
                            <img src="assets/images/auction/06.png" alt="auction">
                            <span class="info">Immobilier</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--============= Hightlight Slider Section Ends Here =============-->
        
        <!--============= Car Auction Section Starts Here =============-->
        <section class="car-auction-section padding-bottom padding-top pos-rel oh">
            <div class="car-bg"><img src="assets/images/auction/featured/featured-bg-1.jpg" alt="car"></div>
            <div class="container">
                <div class="section-header-3" id="scrollit">
                    <div class="left">
                        <div class="thumb">
                            <img src="assets/images/auction/04.png" alt="header-icons">
                        </div>
                        <div class="title-area">
                            <h2 class="title" id="error">
                                <?php 
                                    if (isset($_GET["category"])) {
                                        echo $_GET["category"] ; 
                                    } else {
                                        echo "Toutes les catégories" ; 
                                    }
                                 ?>
                                 
                            </h2>
                            <p>Voici nos offres actuels, participer avec les Tokens nécessaires afin de pouvoir rejoindre la salle des enchéres</p>

                            <?php if ((isset($_SESSION["error_notokens"]))&&($_SESSION["error_notokens"]==1)) { ?>
                                <p style="color : red ; ">Vous n'avez pas assez de Tokens pour rejoindre la salle d'enchères de cet article. Veuillez acheter plus de Tokens ici.</p>
                            <?php 
                                $_SESSION["error_notokens"] = 0 ; 
                                } ?>

                        </div>
                    </div>
                    <?php 
                        if (isset($_GET['category'])) {
                            $category=$_GET['category'] ; 
                        } else {
                            $category="all" ; 
                        }
                    ?>
                    <a href="product.php?category=<?= $category ?>" class="normal-button">Voir tout</a>


                </div>
                <div class="row justify-content-center mb-30-none" >
                    <?php 
                    include_once 'config.php' ;
                    require_once 'model/produit.php' ; 
                    require_once 'controller/produitC.php' ;

                    $produitC = new produitC() ; 
                    if (!isset($_GET['category'])) {
                        $produits = $produitC->afficherProduits() ;
                    } else {
                        $produits = $produitC->afficherProduits_category($_GET['category']) ;
                          
                    }
                    if (empty($produits)) { ?>
                        
                        <span style="background-color: white; padding : 10px ; border-radius: 10px ; ">
                            Aucune offre n'est disponible à ce moment dans cette catégorie. Restez branchés, de nouvelles offres seront bientôt disponibles.
                        </span> 

                        <?php
                    } else {
                        foreach ($produits as $produit) {

                    ?>

                    <div class="col-sm-10 col-md-6 col-lg-4">
                        <div class="auction-item-2">
                            <div class="auction-thumb">
                                <a href="product-details.php?id_prod=<?= $produit['id_prod'] ; ?>"><img src="<?= $produit['photo_prod'] ;  ?>" alt="car"></a>
                                <!--a href="#0" class="rating"><i class="far fa-star"></i></a-->
                                <a href="product-details.php?id_prod=<?= $produit['id_prod'] ; ?>" class="bid"><i class="flaticon-auction"></i></a>
                            </div>
                            <div class="auction-content">
                                <h6 class="title">
                                    <a href="product-details.php?id_prod=<?= $produit['id_prod'] ; ?>"><?php echo $produit["nom_prod"] ;   ?></a>
                                </h6>
                                <div class="bid-area">
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Salle d'enchére remplie à</div>
                                            <div class="amount"><?php echo ($produit["participation_prod"]*100)/$produit["total_prod"] ."%" ;  ?></div>
                                        </div>
                                    </div>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-money"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Tokens Nécessaires</div>
                                            <div class="amount"><?php echo $produit["total_prod"] ; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="countdown-area">
                                    <div class="countdown">
                                        <?php 
                                        if ($produit["participation_prod"]<$produit["total_prod"]) {
                                        ?>
                                            <span style="font-size: 14px ; padding-right: -20px ;  ">
                                            Salle d'enchères s'ouvre à 100%.&nbsp;
                                            </span>
                                        <?php
                                        } else {   
                                        ?>
                                            <span style="font-size: 14px ; padding-right: -20px ; color : green !important ; ">
                                            Salle d'enchères OUVERTE.&nbsp;
                                            </span>

                                        <?php
                                        }
                                        ?>   
                                    </div>
                                    <span class="total-bids" style="font-size: 14px ;  "><?php echo ($produit['participation_prod']*100)/$produit['total_prod'] ;   ?> Partic.</span>
                                </div>
                                <div class="text-center">

                                    <?php
                                    if (isset($_SESSION["id_user"])) { // =========== CONNECTE ===========
                                        $id_user = $_SESSION["id_user"] ;
                                        $id_prod = $produit["id_prod"] ; 
                                        $req = "select * from participant where id_user='$id_user' and id_prod='$id_prod'" ; 
                                        $result = $con->query($req) ; 

                                         if ($result->num_rows!=0) { 
                                            if ($produit["participation_prod"]<$produit["total_prod"]) { // === SALLE FERMEE ===================
                                            ?>
                                                <span style="color : green ; font-size: 17px ; ">
                                                    Vous avez déjà participé à la salle d'enchères de cet article.
                                                </span>
                                        <?php   
                                            } else {// =========== SALLE OUVERTE ============= ?>

                                                <a href="product-details.php?id_prod=<?= $produit['id_prod'] ?>" class="custom-button" style="font-size: 16px ; ">Participer&nbsp;aux&nbsp;enchères</a>

                                        <?php        
                                            }  
                                        } else { 
                                            if ($produit["participation_prod"]<$produit["total_prod"]) { // === SALLE FERMEE ===================
                                            ?>
                                                <a href="ajouter_participant.php?id_user=<?= $_SESSION['id_user'] ?>&id_prod=<?= $produit['id_prod'] ?>&participation=<?= $produit['total_prod']/100 ?>" class="custom-button" style="font-size: 16px ; ">Participer&nbsp;à&nbsp;<?php echo $produit['total_prod']/100 ; ?>&nbsp;Tokens </a>
                                    <?php 
                                            } else { // =========== SALLE OUVERTE ============= ?>
                                                 
                                                <a href="product-details.php?id_prod=<?= $produit['id_prod'] ?>" class="custom-button" style="font-size: 16px ; ">Participer&nbsp;aux&nbsp;enchères</a>

                                        <?php
                                            }
                                        } 
                                    } else {   // ============= NON CONNECTE ============= 
                                        if ($produit["participation_prod"]<$produit["total_prod"]) { // === SALLE FERMEE ===================
                                            ?>

                                        <a href="sign-in.php" class="custom-button" style="font-size: 16px ; ">Participer à <?php echo $produit['total_prod']/100 ; ?> Tokens </a>

                                <?php
                                        } else { // =========== SALLE OUVERTE ============= ?>
                                            <a href="sign-in.php" class="custom-button" style="font-size: 16px ; ">Participer&nbsp;aux&nbsp;enchères</a>


                                <?php
                                        }
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php 
                    }
                }
                    ?>


                     
                     
                </div>
                <center>
                    <a style="margin-top: 70px" href="product.php?category=<?= $category ?>" class="normal-button">Voir Tout</a>
                </center>
            </div>

        </section>

        <!--============= Car Auction Section Ends Here =============-->
    </div>

    <div style="background-color: white  ; height: 50px ; width: 200px ; ">
        fg
    </div>


    <!--============= Upcoming Auction Section Starts Here =============-->
    <section class="upcoming-auction padding-bottom" style="margin-top: 80px ; ">
        <div class="container">
            <div class="section-header">
                <h2 class="title">Historique des enchères</h2>
                <p>Vous êtes invités à assister et à vous joindre à l'action à l'une de nos prochaines ventes aux enchères.</p>
            </div>
        </div>
        <div class="filter-wrapper">
            <div class="container">
                <ul class="filter">
                    <!--li class="active" data-check="*">
                        <span><i class="flaticon-right-arrow"></i>All</span>
                    </li-->
                    <li data-check=".live" class="active" data-check="*">
                        <span><i class="flaticon-auction"></i>Articles Remportés</span>
                    </li>
                    <li data-check=".time">
                        <span><i class="flaticon-time"></i>Enchères en Cours </span>
                    </li>
                    <!--li data-check=".buy">
                        <span><i class="flaticon-bag"></i>buy now</span>
                    </li-->
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="auction-wrapper-5 m--15">
                 <?php
                    include_once 'config.php' ;
                    require_once 'model/produit.php' ; 
                    require_once 'controller/produitC.php' ;
                    require_once 'model/salle.php' ; 
                    require_once 'controller/salleC.php' ;
                    require_once 'model/user.php' ; 
                    require_once 'controller/userC.php' ;

                    $salleC = new salleC() ; 
                    $userC = new userC() ; 
                    $produitC = new produitC() ; 
                    $produits = $produitC->afficherProduits_finished() ;
                    
                    foreach ($produits as $produit) {
                        $salles = $salleC->afficherCount_enchere($produit['id_prod']) ;
                        foreach ($salles as $salle) {
                            $count_ench = $salle['total'] ; 
                        }


                        $salles = $salleC->afficherSalle_gagnant($produit['id_prod']) ;
                        foreach ($salles as $salle) {
                            $users = $userC->afficherUser($salle['id_user']) ;
                            foreach ($users as $user) {
                                $winner = $user["nom_user"]."&nbsp;".$user["prenom_user"] ; 
                            }

                 ?>
                 
                <div class="auction-item-5 live">
                    <div class="auction-inner">
                        <div class="upcoming-badge" title="Upcoming Auction">
                            <i class="flaticon-auction"></i>
                        </div>
                        <div class="auction-thumb">
                            <a href="product-details.php?id_prod=<?= $produit['id_prod'] ?>"><img src="<?= $produit['photo_prod'] ?>" alt="upcoming"></a>
                            <!--a href="#0" class="rating"><i class="far fa-star"></i></a-->
                        </div>
                        <div class="auction-content">
                            <div class="title-area">
                                <h6 class="title">
                                    <a href="product-details.php?id_prod=<?= $produit['id_prod'] ?>"><?php echo $produit['nom_prod'] ;  ?></a>
                                </h6>
                                <div class="list-area">
                                    <span class="list-item">
                                        <span class="list-id">Catégorie</span><?php echo $produit['category_prod'] ;  ?>
                                    </span>
                                    <span class="list-item">
                                        <span class="list-id">Item #</span><?php echo $produit['id_prod'] ; ?>-027867
                                    </span>
                                </div>
                            </div>
                            <div class="bid-area">
                                <div class="bid-inner">
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Enchères Max.</div>
                                            <div class="amount"><?php echo $salle['total_ench']." Token" ; ?></div>
                                        </div>
                                    </div>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-money"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Tokens Nécessaires</div>
                                            <div class="amount"><?php echo $produit['total_prod'] ; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bid-count-area">
                                <span class="item">
                                    <span class="left">Total Enchères</span><?php echo $count_ench." Enchères" ; ?>
                                </span>
                                <!--span class="item">
                                    <span class="left">Gagnant </span><?php echo $winner ; ?>
                                </span-->
                            </div>
                        </div>
                        <div class="auction-bidding">
                            <span class="bid-title" style="font-weight: bold ; color: red ; ">Salle d'enchères fermée</span>
                            <div style="font-size: 16px ; margin-top: 10px; margin-bottom: 10px ;  " style="font-size: 18px ; padding-top: 10px ; ">
                                <span style="color : green ; font-weight: bold ; "><?php echo $winner ?></span> a remporté l'article avec <?php echo $salle['total_ench']." DT" ; ?>  .
                            </div>
                            <div class="bid-incr">
                                <span class="title">Prix Boutique</span>
                                <h4><strike><?php echo $produit['prixbout_prod']." DT" ;  ?></strike></h4>
                            </div>
                            <a href="product-details.php?id_prod=<?= $produit['id_prod'] ?>" class="custom-button">Voir Détails</a>
                        </div>
                    </div>
                </div>

            <?php }
        }
             ?>



             <!-- // ============= ENCHERES EN COURS ================= -->
             <?php
                    include_once 'config.php' ;
                    require_once 'model/produit.php' ; 
                    require_once 'controller/produitC.php' ;
                    require_once 'model/salle.php' ; 
                    require_once 'controller/salleC.php' ;
                    require_once 'model/user.php' ; 
                    require_once 'controller/userC.php' ;

                    $salleC = new salleC() ; 
                    $userC = new userC() ; 
                    $produitC = new produitC() ; 
                    $produits = $produitC->afficherProduits_bidding() ;
                    
                    foreach ($produits as $produit) {
                        $salles = $salleC->afficherCount_enchere($produit['id_prod']) ;
                        foreach ($salles as $salle) {
                            $count_ench = $salle['total'] ; 
                        }


                        $salles = $salleC->afficherSalle_gagnant($produit['id_prod']) ;
                        foreach ($salles as $salle) {
                            $users = $userC->afficherUser($salle['id_user']) ;
                            foreach ($users as $user) {
                                $winner = $user["nom_user"]."&nbsp;".$user["prenom_user"] ; 
                            }

                 ?>
                 
                <div class="auction-item-5 time">
                    <div class="auction-inner">
                        <div class="upcoming-badge" title="Upcoming Auction">
                            <i class="flaticon-auction"></i>
                        </div>
                        <div class="auction-thumb">
                            <a href="product-details.php?id_prod=<?= $produit['id_prod'] ?>"><img src="<?= $produit['photo_prod'] ?>" alt="upcoming"></a>
                            <!--a href="#0" class="rating"><i class="far fa-star"></i></a-->
                        </div>
                        <div class="auction-content">
                            <div class="title-area">
                                <h6 class="title">
                                    <a href="product-details.php?id_prod=<?= $produit['id_prod'] ?>"><?php echo $produit['nom_prod'] ;  ?></a>
                                </h6>
                                <div class="list-area">
                                    <span class="list-item">
                                        <span class="list-id">Catégorie</span><?php echo $produit['category_prod'] ;  ?>
                                    </span>
                                    <span class="list-item">
                                        <span class="list-id">Item #</span><?php echo $produit['id_prod'] ; ?>-027867
                                    </span>
                                </div>
                            </div>
                            <div class="bid-area">
                                <div class="bid-inner">
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Enchères Max.</div>
                                            <div class="amount"><?php echo $salle['total_ench']." Token" ; ?></div>
                                        </div>
                                    </div>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-money"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Tokens Nécessaires</div>
                                            <div class="amount"><?php echo $produit['total_prod'] ; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bid-count-area">
                                <span class="item">
                                    <span class="left">Total Enchères</span><?php echo $count_ench." Enchères" ; ?>
                                </span>
                                <!--span class="item">
                                    <span class="left">Gagnant </span><?php echo $winner ; ?>
                                </span-->
                            </div>
                        </div>
                        <div class="auction-bidding">
                            <span class="bid-title" style="color : green ; font-weight: bold ; ">Salle d'enchères ouverte</span>
                            <div   style="font-size: 16px ; padding-top: 10px ; color : black ; margin-bottom: 10px ; ">
                                Soumettez une offre maintenant avant la fin du décompteur.
                            </div>
                            <div class="bid-incr">
                                <span class="title">Prix Boutique</span>
                                <h4><strike><?php echo $produit['prixbout_prod']." DT" ;  ?></strike></h4>
                            </div>
                            <a href="product-details.php?id_prod=<?= $produit['id_prod'] ?>" class="custom-button">Soumettre une offre</a>
                        </div>
                    </div>
                </div>

            <?php }
        }
             ?>

            </div>
        </div>
    </section>
    <!--============= Upcoming Auction Section Ends Here =============-->


    


    <!--============= Call In Section Starts Here =============-->
    <?php if (!isset($_SESSION['id_user'])) { ?>
    <section class="call-in-section padding-top pt-max-xl-0"  >
        <div class="container">
            <div class="call-wrapper cl-white bg_img" data-background="assets/images/call-in/call-bg.png">
                <div class="section-header">
                    <h3 class="title">Register for Free & Start Bidding Now!</h3>
                    <p>From cars to diamonds to iPhones, we have it all.</p>
                </div>
                <a href="sign-up.php" class="custom-button white">Register</a>
            </div>
        </div>
    </section>
<?php } ?>
    <!--============= Call In Section Ends Here =============-->


     


    <!--============= Popular Auction Section Starts Here =============-->
    <!--section class="popular-auction padding-top pos-rel">
        <div class="popular-bg bg_img" data-background="assets/images/auction/popular/popular-bg.png"></div>
        <div class="container">
            <div class="section-header cl-white"> 
                <h2 class="title">Vente aux Enchères terminées</h2>
                <p>Enchérissez et gagnez des offres exceptionnelles. Notre processus d'enchères est simple, efficace et transparent.</p>
            </div>
            <div class="popular-auction-wrapper">
                <div class="row justify-content-center mb-30-none">

                    <?php 

                    require_once 'model/salle.php' ; 
                    require_once 'controller/salleC.php' ;
                    require_once 'model/user.php' ; 
                    require_once 'controller/userC.php' ;


                    $produitC = new produitC() ; 
                    $salleC = new salleC() ; 
                    $userC = new userC() ;

                    $produits = $produitC->afficherProduits_finished() ;

                    foreach ($produits as $produit) {
                        $salles = $salleC->afficherCount_enchere($produit['id_prod']) ;
                        foreach ($salles as $salle) {
                            $count_ench = $salle['total'] ; 
                        }


                        $salles = $salleC->afficherSalle_gagnant($produit['id_prod']) ;
                        foreach ($salles as $salle) {
                            $users = $userC->afficherUser($salle['id_user']) ;
                            foreach ($users as $user) {
                                $winner = $user["nom_user"]." ".$user["prenom_user"] ; 
                            }

                    ?>
                    <div class="col-lg-6">
                        <div class="auction-item-3">
                            <div class="auction-thumb">
                                <a href="product-details.php?id_prod=<?= $produit['id_prod'] ?>"><img src="<?= $produit['photo_prod']  ?>" alt="popular"></a>
                                <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                            </div>
                            <div class="auction-content">
                                <h6 class="title">
                                    <a href="product-details.php?id_prod=<?= $produit['id_prod'] ?>"><?php echo $produit['nom_prod'] ;  ?></a>
                                </h6>
                                <div class="bid-amount">
                                    <div class="icon">
                                        <i class="flaticon-auction"></i>
                                    </div>
                                    <div class="amount-content">
                                        <div class="current">Enchère Max. Atteinte </div>
                                        <div class="amount"><?php echo $salle['total_ench']." Token" ; ?></div>
                                    </div>
                                </div>
                                <div class="bids-area">
                                    Total Enchères : <span class="total-bids"><?php echo $count_ench." Enchères" ; ?></span>
                                </div>
                                <div class="bids-area">
                                    Gagnant : <span class="total-bids"><?php echo $winner ; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        }
                    }
                    ?>
                     
                     
                     
                     
                     
                </div>
            </div>
        </div>
    </section-->
    <!--============= Popular Auction Section Ends Here =============-->


    <!--============= Coins and Bullion Auction Section Starts Here =============-->
    <!--section class="coins-and-bullion-auction-section padding-bottom padding-top pos-rel pb-max-xl-0">
        <div class="jewelry-bg d-none d-xl-block"><img src="assets/images/auction/coins/coin-bg.png" alt="coin"></div>
        <div class="container">
            <div class="section-header-3">
                <div class="left">
                    <div class="thumb">
                        <img src="assets/images/header-icons/coin-1.png" alt="header-icons">
                    </div>
                    <div class="title-area">
                        <h2 class="title">Coins & Bullion</h2>
                        <p>Discover rare, foreign, & ancient coins that are worth collecting</p>
                    </div>
                </div>
                <a href="#0" class="normal-button">View All</a>
            </div>
            <div class="row justify-content-center mb-30-none">
                <div class="col-sm-10 col-md-6 col-lg-4">
                    <div class="auction-item-2">
                        <div class="auction-thumb">
                            <a href="product-details.html"><img src="assets/images/auction/coins/auction-1.jpg" alt="coins"></a>
                            <a href="#0" class="rating"><i class="far fa-star"></i></a>
                            <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                        </div>
                        <div class="auction-content">
                            <h6 class="title">
                                <a href="product-details.html">Ancient & World Coins</a>
                            </h6>
                            <div class="bid-area">
                                <div class="bid-amount">
                                    <div class="icon">
                                        <i class="flaticon-auction"></i>
                                    </div>
                                    <div class="amount-content">
                                        <div class="current">Current Bid</div>
                                        <div class="amount">$876.00</div>
                                    </div>
                                </div>
                                <div class="bid-amount">
                                    <div class="icon">
                                        <i class="flaticon-money"></i>
                                    </div>
                                    <div class="amount-content">
                                        <div class="current">Buy Now</div>
                                        <div class="amount">$5,00.00</div>
                                    </div>
                                </div>
                            </div>
                            <div class="countdown-area">
                                <div class="countdown">
                                    <div id="bid_counter17"></div>
                                </div>
                                <span class="total-bids">30 Bids</span>
                            </div>
                            <div class="text-center">
                                <a href="#0" class="custom-button">Submit a bid</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 col-md-6 col-lg-4">
                    <div class="auction-item-2">
                        <div class="auction-thumb">
                            <a href="product-details.html"><img src="assets/images/auction/coins/auction-2.jpg" alt="coins"></a>
                            <a href="#0" class="rating"><i class="far fa-star"></i></a>
                            <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                        </div>
                        <div class="auction-content">
                            <h6 class="title">
                                <a href="product-details.html">2018 Hyundai Sonata</a>
                            </h6>
                            <div class="bid-area">
                                <div class="bid-amount">
                                    <div class="icon">
                                        <i class="flaticon-auction"></i>
                                    </div>
                                    <div class="amount-content">
                                        <div class="current">Current Bid</div>
                                        <div class="amount">$876.00</div>
                                    </div>
                                </div>
                                <div class="bid-amount">
                                    <div class="icon">
                                        <i class="flaticon-money"></i>
                                    </div>
                                    <div class="amount-content">
                                        <div class="current">Buy Now</div>
                                        <div class="amount">$5,00.00</div>
                                    </div>
                                </div>
                            </div>
                            <div class="countdown-area">
                                <div class="countdown">
                                    <div id="bid_counter18"></div>
                                </div>
                                <span class="total-bids">30 Bids</span>
                            </div>
                            <div class="text-center">
                                <a href="#0" class="custom-button">Submit a bid</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 col-md-6 col-lg-4">
                    <div class="auction-item-2">
                        <div class="auction-thumb">
                            <a href="product-details.html"><img src="assets/images/auction/coins/auction-3.jpg" alt="coins"></a>
                            <a href="#0" class="rating"><i class="far fa-star"></i></a>
                            <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                        </div>
                        <div class="auction-content">
                            <h6 class="title">
                                <a href="product-details.html">2018 Hyundai Sonata</a>
                            </h6>
                            <div class="bid-area">
                                <div class="bid-amount">
                                    <div class="icon">
                                        <i class="flaticon-auction"></i>
                                    </div>
                                    <div class="amount-content">
                                        <div class="current">Current Bid</div>
                                        <div class="amount">$876.00</div>
                                    </div>
                                </div>
                                <div class="bid-amount">
                                    <div class="icon">
                                        <i class="flaticon-money"></i>
                                    </div>
                                    <div class="amount-content">
                                        <div class="current">Buy Now</div>
                                        <div class="amount">$5,00.00</div>
                                    </div>
                                </div>
                            </div>
                            <div class="countdown-area">
                                <div class="countdown">
                                    <div id="bid_counter19"></div>
                                </div>
                                <span class="total-bids">30 Bids</span>
                            </div>
                            <div class="text-center">
                                <a href="#0" class="custom-button">Submit a bid</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section-->
    <!--============= Coins and Bullion Auction Section Ends Here =============-->


    <!--============= Real Estate Section Starts Here =============-->
    <!--section class="real-estate-auction padding-top padding-bottom pos-rel oh">
        <div class="car-bg"><img src="assets/images/auction/realstate/real-bg.png" alt="realstate"></div>
        <div class="container">
            <div class="section-header-3">
                <div class="left">
                    <div class="thumb">
                        <img src="assets/images/header-icons/coin-1.png" alt="header-icons">
                    </div>
                    <div class="title-area">
                        <h2 class="title">Real Estate</h2>
                        <p>Find auctions for Homes, Condos, Residential & Commercial Properties.</p>
                    </div>
                </div>
                <a href="#0" class="normal-button">View All</a>
            </div>
            <div class="auction-slider-4 owl-theme owl-carousel">
                <div class="auction-item-4">
                    <div class="auction-thumb">
                        <a href="product-details.html"><img src="assets/images/auction/realstate/auction-1.png" alt="realstate"></a>
                        <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                    </div>
                    <div class="auction-content">
                        <h4 class="title">
                            <a href="product-details.html">Brand New Apartments In Esenyurt, Istanbul</a>
                        </h4>
                        <div class="bid-area">
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-auction"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Current Bid</div>
                                    <div class="amount">$876.00</div>
                                </div>
                            </div>
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-money"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Buy Now</div>
                                    <div class="amount">$5,00.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="countdown-area">
                            <div class="countdown">
                                <div id="bid_counter30"></div>
                            </div>
                            <span class="total-bids">30 Bids</span>
                        </div>
                        <div class="text-center">
                            <a href="#0" class="custom-button">Submit a bid</a>
                        </div>
                    </div>
                </div>
                <div class="auction-item-4">
                    <div class="auction-thumb">
                        <a href="product-details.html"><img src="assets/images/auction/realstate/auction-1.png" alt="realstate"></a>
                        <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                    </div>
                    <div class="auction-content">
                        <h4 class="title">
                            <a href="product-details.html">Brand New Apartments In Esenyurt, Istanbul</a>
                        </h4>
                        <div class="bid-area">
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-auction"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Current Bid</div>
                                    <div class="amount">$876.00</div>
                                </div>
                            </div>
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-money"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Buy Now</div>
                                    <div class="amount">$5,00.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="countdown-area">
                            <div class="countdown">
                                <div id="bid_counter31"></div>
                            </div>
                            <span class="total-bids">30 Bids</span>
                        </div>
                        <div class="text-center">
                            <a href="#0" class="custom-button">Submit a bid</a>
                        </div>
                    </div>
                </div>
                <div class="auction-item-4">
                    <div class="auction-thumb">
                        <a href="product-details.html"><img src="assets/images/auction/realstate/auction-1.png" alt="realstate"></a>
                        <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                    </div>
                    <div class="auction-content">
                        <h4 class="title">
                            <a href="product-details.html">Brand New Apartments In Esenyurt, Istanbul</a>
                        </h4>
                        <div class="bid-area">
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-auction"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Current Bid</div>
                                    <div class="amount">$876.00</div>
                                </div>
                            </div>
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-money"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Buy Now</div>
                                    <div class="amount">$5,00.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="countdown-area">
                            <div class="countdown">
                                <div id="bid_counter32"></div>
                            </div>
                            <span class="total-bids">30 Bids</span>
                        </div>
                        <div class="text-center">
                            <a href="#0" class="custom-button">Submit a bid</a>
                        </div>
                    </div>
                </div>
                <div class="auction-item-4">
                    <div class="auction-thumb">
                        <a href="product-details.html"><img src="assets/images/auction/realstate/auction-1.png" alt="realstate"></a>
                        <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                    </div>
                    <div class="auction-content">
                        <h4 class="title">
                            <a href="product-details.html">Brand New Apartments In Esenyurt, Istanbul</a>
                        </h4>
                        <div class="bid-area">
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-auction"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Current Bid</div>
                                    <div class="amount">$876.00</div>
                                </div>
                            </div>
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-money"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Buy Now</div>
                                    <div class="amount">$5,00.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="countdown-area">
                            <div class="countdown">
                                <div id="bid_counter33"></div>
                            </div>
                            <span class="total-bids">30 Bids</span>
                        </div>
                        <div class="text-center">
                            <a href="#0" class="custom-button">Submit a bid</a>
                        </div>
                    </div>
                </div>
                <div class="auction-item-4">
                    <div class="auction-thumb">
                        <a href="product-details.html"><img src="assets/images/auction/realstate/auction-1.png" alt="realstate"></a>
                        <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                    </div>
                    <div class="auction-content">
                        <h4 class="title">
                            <a href="product-details.html">Brand New Apartments In Esenyurt, Istanbul</a>
                        </h4>
                        <div class="bid-area">
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-auction"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Current Bid</div>
                                    <div class="amount">$876.00</div>
                                </div>
                            </div>
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-money"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Buy Now</div>
                                    <div class="amount">$5,00.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="countdown-area">
                            <div class="countdown">
                                <div id="bid_counter34"></div>
                            </div>
                            <span class="total-bids">30 Bids</span>
                        </div>
                        <div class="text-center">
                            <a href="#0" class="custom-button">Submit a bid</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-nav real-style ml-auto">
                <a href="#0" class="real-prev"><i class="flaticon-left-arrow"></i></a>
                <div class="pagination"></div>
                <a href="#0" class="real-next active"><i class="flaticon-right-arrow"></i></a>
            </div>
        </div>
    </section-->
    <!--============= Real Estate Section Starts Here =============-->


    <!--============= Art Auction Section Starts Here =============-->
    <!--section class="art-and-electronics-auction-section padding-top">
        <div class="container">
            <div class="row justify-content-center mb--50">
                <div class="col-xl-6 col-lg-8 mb-50">
                    <div class="section-header-2">
                        <div class="left">
                            <div class="thumb">
                                <img src="assets/images/header-icons/camera-1.png" alt="header-icons">
                            </div>
                            <h2 class="title">Electronics</h2>
                        </div>
                        <div class="slider-nav">
                            <a href="#0" class="electro-prev"><i class="flaticon-left-arrow"></i></a>
                            <a href="#0" class="electro-next active"><i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                    <div class="auction-slider-1 owl-carousel owl-theme  mb-30-none">
                        <div class="slide-item">
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/electronics/auction-1.jpg" alt="electronics"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">Magnifying Glasses, Jewelry Loupe odit qui corporis</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter1"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/electronics/auction-2.jpg" alt="electronics"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">Surveillance WiFi Exterieur, 1080P Camera</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter2"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/electronics/auction-3.jpg" alt="electronics"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">WiFi Doorbell Camera for Apartments</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter3"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/electronics/auction-4.jpg" alt="electronics"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">GPD Pocket 2 Ultrabook 7" inch</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter4"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slide-item">
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/electronics/auction-1.jpg" alt="electronics"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">Magnifying Glasses, Jewelry Loupe odit qui corporis</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter5"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/electronics/auction-2.jpg" alt="electronics"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">Surveillance WiFi Exterieur, 1080P Camera</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter6"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/electronics/auction-3.jpg" alt="electronics"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">WiFi Doorbell Camera for Apartments</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter7"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/electronics/auction-4.jpg" alt="electronics"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">GPD Pocket 2 Ultrabook 7" inch</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter8"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-8 mb-50">
                    <div class="section-header-2">
                        <div class="left">
                            <div class="thumb">
                                <img src="assets/images/header-icons/art-1.png" alt="header-icons">
                            </div>
                            <h2 class="title">Art</h2>
                        </div>
                        <div class="slider-nav">
                            <a href="#0" class="art-prev"><i class="flaticon-left-arrow"></i></a>
                            <a href="#0" class="art-next active"><i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                    <div class="auction-slider-2 owl-carousel owl-theme mb-30-none">
                        <div class="slide-item">
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/art/auction-1.jpg" alt="art"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">Magnifying Glasses, Jewelry Loupe odit qui corporis</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter9"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/art/auction-2.jpg" alt="art"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">Surveillance WiFi Exterieur, 1080P Camera</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter10"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/art/auction-3.jpg" alt="art"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">WiFi Doorbell Camera for Apartments</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter11"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/art/auction-4.jpg" alt="art"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">GPD Pocket 2 Ultrabook 7" inch</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter12"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slide-item">
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/art/auction-1.jpg" alt="art"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">Magnifying Glasses, Jewelry Loupe odit qui corporis</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter13"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/art/auction-2.jpg" alt="art"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">Surveillance WiFi Exterieur, 1080P Camera</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter14"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/art/auction-3.jpg" alt="art"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">WiFi Doorbell Camera for Apartments</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter15"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                            <div class="auction-item-1">
                                <div class="auction-thumb">
                                    <a href="product-details.html"><img src="assets/images/auction/art/auction-4.jpg" alt="art"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="product-details.html">GPD Pocket 2 Ultrabook 7" inch</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">$876.00</div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter16"></div>
                                        </div>
                                        <span class="total-bids">30 Bids</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section-->
    <!--============= Art Auction Section Ends Here =============-->


    <!--============= How Section Starts Here =============-->
    <section class="how-section padding-top">
        <div class="container">
            <div class="how-wrapper section-bg">
                <div class="section-header text-lg-left">
                    <h2 class="title">Comment ça marche</h2>
                    <p>3 Simples étapes pour gagner</p>
                </div>
                <div class="row justify-content-center mb--40">
                    <div class="col-md-6 col-lg-4">
                        <div class="how-item">
                            <div class="how-thumb">
                                <img src="assets/images/how/how1.png" alt="how">
                            </div>
                            <div class="how-content">
                                <h4 class="title">S'inscrire</h4>
                                <p>L'inscription est totalement gratuite</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="how-item">
                            <div class="how-thumb">
                                <img src="assets/images/how/how2.png" alt="how">
                            </div>
                            <div class="how-content">
                                <h4 class="title">Participer</h4>
                                <p>Rejoindre la salle d'enchères</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="how-item">
                            <div class="how-thumb">
                                <img src="assets/images/how/how3.png" alt="how">
                            </div>
                            <div class="how-content">
                                <h4 class="title">Enchèrir</h4>
                                <p>Soumettre des offres et gagner des articles</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= How Section Ends Here =============-->


    <!--============= Client Section Starts Here =============-->
    <section class="client-section padding-top padding-bottom">
        <div class="container">
            <div class="section-header">
                <h2 class="title">Don’t just take our word for it!</h2>
                <p>Our hard work is paying off. Great reviews from amazing customers.</p>
            </div>
            <div class="m--15">
                <div class="client-slider owl-theme owl-carousel">
                    <div class="client-item">
                        <div class="client-content">
                            <p>I can't stop bidding! It's a great way to spend some time and I want everything on Sbidu.</p>
                        </div>
                        <div class="client-author">
                            <div class="thumb">
                                <a href="#0">
                                    <img src="assets/images/client/client01.png" alt="client">
                                </a>
                            </div>
                            <div class="content">
                                <h6 class="title"><a href="#0">Alexis Moore</a></h6>
                                <div class="ratings">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="client-item">
                        <div class="client-content">
                            <p>I came I saw I won. Love what I have won, and will try to win something else.</p>
                        </div>
                        <div class="client-author">
                            <div class="thumb">
                                <a href="#0">
                                    <img src="assets/images/client/client02.png" alt="client">
                                </a>
                            </div>
                            <div class="content">
                                <h6 class="title"><a href="#0">Darin Griffin</a></h6>
                                <div class="ratings">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="client-item">
                        <div class="client-content">
                            <p>This was my first time, but it was exciting. I will try it again. Thank you so much.</p>
                        </div>
                        <div class="client-author">
                            <div class="thumb">
                                <a href="#0">
                                    <img src="assets/images/client/client03.png" alt="client">
                                </a>
                            </div>
                            <div class="content">
                                <h6 class="title"><a href="#0">Tom Powell</a></h6>
                                <div class="ratings">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= Client Section Ends Here =============-->


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


<!-- Mirrored from pixner.net/sbidu/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Jul 2021 17:00:15 GMT -->
</html>