<?php 
session_start() ; 
if (!isset($_SESSION["username"])) {
	echo "<script>window.top.location='sign-in.php'</script>" ;
}
$error ="" ; 

if (isset($_POST["submit"])) {
	include_once 'config.php' ;
	include_once 'config1.php' ;
    require_once 'model/user.php' ; 
    require_once 'controller/userC.php' ;
    $newemail = $_SESSION["email"] ; 
    $error ="" ; 
    $id_user = $_SESSION['id_user'] ; 



    if (isset($_POST["nom"])) {

    	if ((empty($_POST["nom"]))||(empty($_POST["prenom"]))||(empty($_POST["adresse"]))) {
    		$error = "Veuillez remplir tous les champs." ; 
    	} else {
	    	$_SESSION["nom"] = $_POST["nom"] ; 
	    	$_SESSION["prenom"] = $_POST["prenom"] ; 
	    	$_SESSION["adresse"] = $_POST["adresse"] ; 
    	}

    	
    } else if (isset($_POST["email"])) {
    	include 'connect.php' ; 
    	$email = $_POST["email"] ; 
    	$req = "select * from user where email_user='$email'" ; 
	    $result = $con->query($req) ; 

	    if (($result->num_rows!=0)||(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))) {
	    	$error = "Adresse mail invalide ou existante déjà. " ; 
	    } else {
	    	$newemail = $_POST["email"] ; 
	    }
    

    } else if (isset($_POST["telephone"])) {
    	if ((strlen($_POST["telephone"])!=8)||(!is_numeric($_POST["telephone"]))) {
    		$error = "Numéro de téléphone invalide " ; 
    	} else {
    		$_SESSION["telephone"] = $_POST["telephone"] ; 
    	}
    
    } else if ((isset($_POST["password"]))&&(isset($_POST["newpassword"]))) {
    	include 'connect.php' ; 
    	$password = $_POST["password"] ; 
    	$email = $_SESSION["email"] ;

    	$req = "select * from user where email_user='$email' and password_user='$password'" ; 
	    $result = $con->query($req) ;
	    if ($result->num_rows==0) {
	    	$error = "Mot de passe actuel incorrect." ;
	    } else {
	    	if (empty($_POST["newpassword"])) {
	    		$error = "Veuillez remplir tous les champs. " ;
	    	} else {
	    		$_SESSION["password"] = $_POST["newpassword"] ; 
	    	} 
	    }

    } else if (isset($_POST["tt"])) {
 
    	if(!empty($_FILES["image"]["name"])) {
	    	 // Get file info 
	        $fileName = basename($_FILES["image"]["name"]); 
	        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
	         
	        // Allow certain file formats 
	        $allowTypes = array('jpg','png','jpeg','gif'); 
			
			if(in_array($fileType, $allowTypes)){         
	            $image = $_FILES['image']['tmp_name']; 
	            $imgContent = addslashes(file_get_contents($image)); 
	             

	            include 'connect.php' ; 
	            $req = "UPDATE user SET pdp_user='$imgContent' where id_user='$id_user' " ; 
			    $result = $con->query($req) ;  
			     

			    $req = "SELECT * from user where id_user='$id_user' " ; 
			    $result = $con->query($req) ;  
			    if ($result->num_rows!=0) {
			    	while ($row = $result->fetch_assoc()) {
			    		$_SESSION["pdp_user"] = $row["pdp_user"] ; 
			    	}
			    }
	         }
	    } else {
	    	$error = "Veuillez entrer une image valide." ; 
	    }
    }





    	$user = new user($_SESSION["nom"], $_SESSION["prenom"],$_SESSION["telephone"],$newemail,$_SESSION["password"],0,$_SESSION["adresse"],"","") ; 
    	$userC = new userC() ; 
    	$users = $userC->modifier_user_details($user, $_SESSION["email"])  ;
    	$_SESSION["email"] = $newemail ;

    	if ($error=="") {
    		echo "<script>window.top.location='profile.php'</script>" ;
    	}  
    	

}



?>
<!DOCTYPE html>
<html>
<head> 
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Modifier</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/owl.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body style="background-color: #5F33F0 ; ">
	 
		<div class="row" style="margin-top: 100px ; ">
			<div class="col-4">
			</div>
	        <div class="col-4">
	            <div class="dash-pro-item mb-30 dashboard-widget">
	            	<?php
	            	if (isset($_GET["details"])) {
	            		// ============================ DETAILS =====================================
	            	?>
		            	<form action="" method="POST">
		                <div class="header">
		                    <h4 class="title">Details</h4> 
		                </div>
		                <ul class="dash-pro-body">
		                    <li>
		                        <div class="info-name">Nom</div>
		                        <div class="info-value"><input value="<?= $_GET['nom']?>"  style="height: 30px !important ; width: 300px ;   " type="" name="nom"> </div>
		                    </li>
		                    <li>
		                        <div class="info-name">Prénom</div>
		                        <div class="info-value"><input value="<?= $_GET['prenom']?>" style="height: 30px !important ; width: 300px ;   " type="" name="prenom"> </div>
		                    </li>
		                    <li>
		                        <div class="info-name">Address</div>
		                        <div class="info-value"><input value="<?= $_GET['adresse']?>" style="height: 30px !important ; width: 300px ;   " type="" name="adresse"> </div>
		                    </li>
		                </ul>
		                <center>
		                	<input type="submit" style="margin-top: 20px ; width: 200px; height: 40px ;  " value="Enregistrer" name="submit">

		                	<div style="color : red; margin-top: 10px ;"><?php echo $error ;  ?></div>

		                </center>
		                
		            	</form>
	            	<?php
	            	} else if  (isset($_GET["email"])) {
	            		// ================================= PARAMETRES ===============================
	            	?>

		            	<form action="" method="POST">
		                <div class="header">
		                    <h4 class="title">Adresse Email</h4> 
		                </div>
		                <ul class="dash-pro-body">
		                    <li>
		                        <div class="info-name">Email</div>
		                        <div class="info-value"><input value="<?= $_GET['email']?>"  style="height: 30px !important ; width: 300px ;   " type="" name="email"> </div>
		                    </li> 
		                </ul>
		                <center>
		                	<input type="submit" style="margin-top: 20px ; width: 200px; height: 40px ;  " value="Enregistrer" name="submit">

		                	<div style="color : red; margin-top: 10px ;"><?php echo $error ;  ?></div>

		                </center>
		                
		            	</form>
	            	<?php
	            	} else if  (isset($_GET["telephone"])) { 
	            		// ================================= PARAMETRES ===============================
	            	?>

		            	<form action="" method="POST">
		                <div class="header">
		                    <h4 class="title">Téléphone</h4> 
		                </div>
		                <ul class="dash-pro-body">
		                    <li>
		                        <div class="info-name">Numéro</div>
		                        <div class="info-value"><input value="<?= $_GET['telephone']?>"  style="height: 30px !important ; width: 300px ;   " type="" name="telephone"> </div>
		                    </li> 
		                </ul>
		                <center>
		                	<input type="submit" style="margin-top: 20px ; width: 200px; height: 40px ;  " value="Enregistrer" name="submit">

		                	<div style="color : red; margin-top: 10px ;"><?php echo $error ;  ?></div>

		                </center>
		                
		            	</form>
	            	<?php
	            	} else if  (isset($_GET["mdp"])) { 
	            		// ================================= PARAMETRES ===============================
	            	?>
		            	<form action="" method="POST">
		                <div class="header">
		                    <h4 class="title">Mot de passe</h4> 
		                </div>
		                <ul class="dash-pro-body">
		                    <li>
		                        <div class="info-name">Mdp actuel</div>
		                        <div class="info-value"><input  style="height: 30px !important ; width: 300px ;   " type="" name="password"> </div>
		                    </li> 
		                    <li>
		                        <div class="info-name">Nouveau mdp</div>
		                        <div class="info-value"><input  style="height: 30px !important ; width: 300px ;   " type="" name="newpassword"> </div>
		                    </li> 
		                </ul>
		                <center>
		                	<input type="submit" style="margin-top: 20px ; width: 200px; height: 40px ;  " value="Enregistrer" name="submit">

		                	<div style="color : red; margin-top: 10px ;"><?php echo $error ;  ?></div>

		                </center>
		                
		            	</form>

	            	<?php 
	            	} else if (isset($_GET["pdp_user"])) { ?>

	            		<form action="" method="POST" enctype="multipart/form-data">
			                <div class="header">

			                    <h4 class="title">Photo de Profil</h4> 


			                </div>
			                
			                <center>
			                	<div class="user">
			                	<div class="thumb">
                                    <?php echo '<img style="border-radius : 50% ; margin-bottom : 20px;  " height=150px width=150px src="data:image;base64,'.base64_encode($_SESSION['pdp_user']).'" alt="Image" >'  ?>
                                </div>
                                </div>
                                    <input type="hidden" name="tt">
                                    <input type="file" name="image">
			                	<input type="submit" style="margin-top: 20px ; width: 200px; height: 40px ;  " value="Enregistrer" name="submit">

			                	<div style="color : red; margin-top: 10px ;"><?php echo $error ;  ?></div>

			                </center>
		                
		            	</form>






	            	<?php

	            	}
	            	?>

	            </div>
	        </div>
	</div>
	 




</body>
</html>