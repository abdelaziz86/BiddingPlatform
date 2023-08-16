<?php
session_start() ; 

include_once 'config.php' ;
include_once 'config1.php' ;
require_once 'model/produit.php' ; 
require_once 'controller/produitC.php' ;
require_once 'model/salle.php' ; 
require_once 'controller/salleC.php' ;
require_once 'model/user.php' ; 
require_once 'controller/userC.php' ;

include 'connect.php' ;

$produitC = new produitC() ; 
$produits = $produitC->afficherProduitsID($_SESSION["id_prod"]) ;

foreach ($produits as $produit) {
	$defaultTimeZone='UCT'; 
	$new_time = date("Y-m-d H:i:s", strtotime('+1 hours')) ; 

	$date_debut = new DateTime($new_time) ;  

	$date_fin = new DateTime($produit['temps_fin']) ;  

	$diff = $date_debut->diff($date_fin) ;  

	if ($date_debut->format("%H:%I:%S")>$date_fin->format("%H:%I:%S")) {
	 //echo $diff->format("%H:%I:%S") ;
		$produitC = new produitC() ; 
					$produits = $produitC->modifier_produit_finish($_SESSION["id_prod"]) ;
					$_SESSION['finish_prod'] = 1 ; 
	}
	// ================== CHECK IF TIME = 00:00:00 ==========================
	if (($_SESSION["bid_prod"]==1)&&($produit["finish_prod"]==0)) {
		if ($diff->format("%H:%I:%S")>="00:00:01") {
			echo $diff->format("%H:%I:%S") ; 
			} else {
				 
				// ============== ECHO WINNER ===============================
				$salleC = new salleC() ; 
				$salles = $salleC->afficherSalle_gagnant($_SESSION["id_prod"]) ;
				foreach ($salles as $salle) {

					$userC = new userC() ; 
					$users = $userC->afficherUser($salle['id_user']) ;

					foreach ($users as $user) {
						echo "Fin décompteur, " ;
						echo "Le gagnant est : <br> " ;
						echo $user["prenom_user"]. "\n ".$user["nom_user"] ; 
					}
				}

				if ($diff->format("%H:%I:%S")<="00:00:01") {
					$produitC = new produitC() ; 
					$produits = $produitC->modifier_produit_finish($_SESSION["id_prod"]) ;
					$_SESSION['finish_prod'] = 1 ; 
				}
				


				// ============== CLOSE BIDDING ==============================
				//$produits = $produitC->modifier_produit_close_bidding($_SESSION["id_prod"]) ;

			}
	  } else if (($produit['bid_prod']==1)&&($produit['finish_prod']==1)) {
	  		// ============== ECHO WINNER ===============================
				$salleC = new salleC() ; 
				$salles = $salleC->afficherSalle_gagnant($_SESSION["id_prod"]) ;
				foreach ($salles as $salle) {

					$userC = new userC() ; 
					$users = $userC->afficherUser($salle['id_user']) ;

					foreach ($users as $user) {
						echo "Fin décompteur, " ;
						echo "Le gagnant est : <br> " ;
						echo $user["prenom_user"]. "\n ".$user["nom_user"] ; 
					}
				}


	  }
}






?>