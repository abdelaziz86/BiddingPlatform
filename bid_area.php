<?php 
include_once 'config.php' ;
include_once 'config1.php' ;
require_once 'model/produit.php' ; 
require_once 'controller/produitC.php' ;
session_start() ; 
include 'connect.php' ; 
$produitC = new produitC() ; 
$produits = $produitC->afficherProduitsID($_SESSION["id_prod"]) ;

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
     
}

$part = $total_prod/100 ; 
if (isset($_SESSION["id_user"])) {
    $id_user = $_SESSION['id_user'] ; 
}

$id_user = $_SESSION['id_user'] ; 
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



/////////////////////////////////////////////////////////////////////////////////////////


    if (($bid_prod==1)&&(isset($_SESSION["id_user"]))) {
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