<?php
  session_start() ; 
  include_once 'config.php' ;
  require_once 'model/user.php' ; 
  require_once 'controller/userC.php' ;

  $email_user = $_SESSION['email'] ;
  $username = $_SESSION['username'] ;
  $id_user = $_SESSION['id_user'] ; 

  
  $userC = new userC() ; 
  $users = $userC->modifier_code_confirmation($code_user,$id_user) ;

  $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < 10; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
   $users = $userC->modifier_code_confirmation($randomString,$id_user) ;
   

     // Plusieurs destinataires
     $to  = $email_user; // notez la virgule

     // Sujet
     $subject = 'Vérification Compte Utilisateur' ;

     // message
     $message = '
     <html>
      <head>
       <title>Bonjour Mr,'.$username.'</title>
      </head>
      <body>
       <p>Voici votre code de confirmation mail : '.$randomString.'</p>
       <div>Bonne journée. </div> 
      </body>
     </html>
     ';

     // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headers[] = 'MIME-Version: 1.0';
     $headers[] = 'Content-type: text/html; charset=iso-8859-1';

     // En-têtes additionnels
     $headers[] = 'To: Mary <'.$email_user.'>';
     $headers[] = 'From: Bid <confirm_mail@aquario.tn>';
     $headers[] = 'Cc: confirm_mail@aquario.tn';
     $headers[] = 'Bcc: confirm_mail@aquario.tn';

     // Envoi
     mail($to, $subject, $message, implode("\r\n", $headers));

     $_SESSION["email_sent"] = 1 ; 
     echo "<script>window.top.location='profile.php'</script>" ; 
?>