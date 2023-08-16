<?php

class participantC {
	// ================== CRUD ===========================
		 public function afficherParticipants() {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM participant') ; 
				$query->execute() ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		} 

		public function afficherParticipants_produit($id_prod) {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM participant where id_prod=:id_prod') ; 
				$query->execute([
					'id_prod' => $id_prod
				]) ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		} 


		public function afficher_COUNT_Participation($id_user) {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT COUNT(*) as total FROM participant where id_user=:id_user') ; 
				$query->execute([
					'id_user' => $id_user
				]) ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		}
 		

 		public function afficherParticipation_user($id_user) {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM participant where id_user=:id_user') ; 
				$query->execute([
					'id_user' => $id_user 
				]) ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		} 

		 
		function ajouter_participant($participant){
			$sql="INSERT INTO participant (id_user,id_prod) 
				VALUES (:id_user,:id_prod)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
			
				$query->execute([
					'id_user' => $participant->getid_user(),
					'id_prod' => $participant->getid_prod() 

				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}


		/*public function deleteEmploye($id) {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('DELETE FROM employe WHERE id_employe = :id') ; 
				$query->execute([
                    'id' => $id
                ]);
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		}

		 public function modifier_user_details($user,$email_user){
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('UPDATE user SET 
                        nom_user = :nom_user,  
                        prenom_user = :prenom_user,
                        telephone_user = :telephone_user,
                        email_user = :email_user,
                        password_user = :password_user,
                        adresse_user = :adresse_user

                    WHERE email_user = :email') ; 
                $query->execute([
                    'email' => $email_user,
                    'nom_user' =>  $user->getnom_user(),
                     'prenom_user' => $user->getprenom_user(),
                     'telephone_user' => $user->gettelephone_user(),
                     'email_user' => $user->getemail_user(),
                     'password_user' => $user->getpassword_user(),
                     'adresse_user' => $user->getadresse_user()
 
                ]) ; 
                return $query->fetchAll();


                 
                //echo $query->rowCount() . "UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }*/

}



?>