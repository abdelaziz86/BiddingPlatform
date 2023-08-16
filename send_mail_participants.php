<?php
  session_start() ; 
  $id_prod = $_SESSION['product_bid'] ; 
  include_once 'config.php' ;
  include_once 'config1.php' ; 
  require_once 'model/produit.php' ; 
  require_once 'controller/produitC.php' ;
  require_once 'model/participant.php' ; 
  require_once 'controller/participantC.php' ;
  require_once 'model/user.php' ; 
  require_once 'controller/userC.php' ;

  $produitC = new produitC() ;
  $produits = $produitC->afficherProduitsID($id_prod) ;  

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

  $participantC = new participantC() ;
  $participants = $participantC->afficherParticipants_produit($id_prod) ; 
  $email_user ="" ;  
  $heads = "To : " ; 
  foreach ($participants as $participant) {
      $userC = new userC() ;
      $users = $userC->afficherUser($participant['id_user']) ;
      foreach ($users as $user) {

        if ($email_user=="") {
          $email_user = $user['email_user'] ; 
        } else {
          $email_user = ' ,'.$email_user ;
        }

        if ($heads=="To : ") {
          $heads = $heads.$user['prenom_user'].' <'.$user['email_user'].'>' ;
        } else {
          $heads = $heads.', '.$user['prenom_user'].' <'.$user['email_user'].'>' ; 
        }
        
      }
  }


  $email_user = $_SESSION['email'] ; 

     // Plusieurs destinataires
     $to  = $email_user; // notez la virgule

     // Sujet
     $subject = $nom_prod." : La salle d 'enchères est finalement ouverte ! " ;

     // message
     $message = "
     <!DOCTYPE html>
      <html>
      <head>
        <title></title>
      </head>
      <body style='font-size : 18px ; color : black ; '>
          <div style='color : black'>Bonjour <span style='color : green'> Cher Participant</span>, </div>
          <div style='color : black'>La salle d'enchères du produit : ".$nom_prod." est ouverte et sera fermée après 24h. </div>
          <div style='color : black'>Pour pouvoir ganger ce produit, veuillez vous rendre à notre <a href='https://aquario.tn/bid2/product-details.php?id_prod=".$id_prod."'> site officiel </a> et soumettre une offre. </div>
           
            <img src='".$photo_prod."' style='width:auto; height:280px ; margin-top : 15px ; '>
           

      </body>
      </html>
      ";

     // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headers[] = 'MIME-Version: 1.0';
     $headers[] = 'Content-type: text/html; charset=iso-8859-1';

     // En-têtes additionnels
     $headers[] = $heads;
     $headers[] = 'From: Bid <salle_enchères@aquario.tn>';
     $headers[] = 'Cc: salle_enchères@aquario.tn';
     $headers[] = 'Bcc: salle_enchères@aquario.tn';

     // Envoi
     mail($to, $subject, $message, implode("\r\n", $headers));

     //$_SESSION["email_sent"] = 1 ; 
     echo "<script>window.top.location='product-details.php?id_prod=".$id_prod."#photo'</script>" ;
?>