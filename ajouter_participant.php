<?php
session_start() ; 
include_once 'config.php' ;
include_once 'config1.php' ;
require_once 'model/participant.php' ; 
require_once 'controller/participantC.php' ;
require_once 'model/produit.php' ; 
require_once 'controller/produitC.php' ;
require_once 'model/user.php' ; 
require_once 'controller/userC.php' ;

$id_prod = $_GET["id_prod"] ; 
$id_user = $_GET["id_user"] ; 
$produitC = new produitC() ; 
$produits = $produitC->afficherProduitsID($id_prod) ; 

foreach ($produits as $produit) {
	$part = $produit["total_prod"]/100 ; 
	$participation_prod = $produit["participation_prod"] ; 
	$total_prod = $produit["total_prod"] ; 
}

if ($_SESSION["budget"]<$part) {
	$_SESSION["error_notokens"] = 1 ; 
	echo "<script>window.top.location='index.php#error'</script>" ;
} else if ($participation_prod<$total_prod) {

	$userC = new userC() ; 
	$users = $userC->modifier_user_budget($part,$id_user) ; 
	$users = $userC->afficherUser($id_user) ; 

	$_SESSION["budget"] -= $part ; 

	$participant = new participant($_GET['id_user'], $_GET['id_prod']) ; 
	$participantC = new participantC() ; 
	$participants = $participantC->ajouter_participant($participant) ;

	$produit = new produit("", 0,0,$_GET["participation"],"","","") ; 
	$produitC = new produitC() ; 
	$produits = $produitC->modifier_produit_totalparticipation($produit,$_GET['id_prod']) ;
	

	if ($participation_prod + $part == $total_prod) {
		$produits = $produitC->modifier_produit_bid($_GET['id_prod']) ;
		$produit = new produit( "", "" ,"" ,"" , "", "",date("Y-m-d h:i:s", strtotime('+36 hours 59 minutes 59 seconds')));  
		$produits = $produitC->modifier_produit_tempsfin($_GET['id_prod'],$produit) ; 
		$_SESSION['product_bid'] = $id_prod ; 
		include 'send_mail_participants.php' ; 


 
	} 





	if (isset($_GET["details"])) {

		echo "<script>window.top.location='product-details.php?id_prod=".$id_prod."#photo'</script>" ;
	} else {
		echo "<script>window.top.location='index.php#error'</script>" ;
	}

}
?>