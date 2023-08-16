<?php

class userC {
	// ================== CRUD ===========================
		public function afficherUser($id_user) {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM user WHERE id_user=:id_user') ; 
				$query->execute([
					'id_user' => $id_user
				]) ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		} 
        
        public function afficherUser_refcode($refcode_user) {
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('SELECT * FROM user WHERE refcode_user=:refcode_user') ; 
                $query->execute([
                    'refcode_user' => $refcode_user
                ]) ; 
                return $query->fetchAll();

            } catch (PDOException $e) {
                $e->getMessage() ; 
            }
        } 

        public function afficher_MAXID() {
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('SELECT MAX(id_user) as max FROM user') ; 
                $query->execute() ; 
                return $query->fetchAll();

            } catch (PDOException $e) {
                $e->getMessage() ; 
            }
        }

		function ajouter_user($user){
			$sql="INSERT INTO user (nom_user,prenom_user,telephone_user,email_user,password_user,budget_user,adresse_user,pdp_user,refcode_user) 
				VALUES (:nom_user,:prenom_user,:telephone_user,:email_user,:password_user,:budget_user,:adresse_user,:pdp_user,:refcode_user)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
			
				$query->execute([
					'nom_user' => $user->getnom_user(),
					'prenom_user' => $user->getprenom_user(),
					'telephone_user' => $user->gettelephone_user(),
					'email_user' => $user->getemail_user() ,
					'password_user' => $user->getpassword_user(),
					'password_user' => $user->getpassword_user(),
					'budget_user' => $user->getbudget_user(),
					'adresse_user' => $user->getadresse_user(),
                    'pdp_user' => $user->getpdp_user(),
                    'refcode_user' => $user->getrefcode_user()

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
		}*/

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
        }


        public function modifier_user_budget($budget_user,$id_user){
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('UPDATE user SET 
                        budget_user = budget_user - :budget_user 

                    WHERE id_user = :id_user') ; 
                $query->execute([
                    'id_user' => $id_user,
                    'budget_user' =>  $budget_user 
 
                ]) ; 
                return $query->fetchAll();


                 
                //echo $query->rowCount() . "UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }

        

        public function modifier_code_confirmation($code_user,$id_user){
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('UPDATE user SET 
                        code_user = :code_user 

                    WHERE id_user = :id_user') ; 
                $query->execute([
                    'id_user' => $id_user,
                    'code_user' =>  $code_user 
 
                ]) ; 
                return $query->fetchAll();


                 
                //echo $query->rowCount() . "UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }        


        public function modifier_verified_user($id_user){
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('UPDATE user SET 
                        verif_user = 1 

                    WHERE id_user = :id_user') ; 
                $query->execute([
                    'id_user' => $id_user 
 
                ]) ; 
                return $query->fetchAll();


                 
                //echo $query->rowCount() . "UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }  
        public function recuperer_losers($budget_user,$id_user){
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('UPDATE user SET 
                        budget_user = budget_user + :budget_user 

                    WHERE id_user = :id_user') ; 
                $query->execute([
                    'id_user' => $id_user,
                    'budget_user' =>  $budget_user 
 
                ]) ; 
                return $query->fetchAll();


                 
                //echo $query->rowCount() . "UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }


        
}



?>