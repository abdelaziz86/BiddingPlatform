<?php

class produitC {
	// ================= TOKENS =========================
	public function afficher_TOKENS() {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM token') ; 
				$query->execute() ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		}
	// ================== CRUD ===========================
		 public function afficherProduits() {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM produit WHERE finish_prod=0 and bid_prod=0 limit 6') ; 
				$query->execute() ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		}

		public function afficherProduits_category($category_prod) {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM produit WHERE category_prod=:category_prod and finish_prod=0 and bid_prod=0 limit 6') ; 
				$query->execute([
						'category_prod' => $category_prod
				]) ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		}

		// ======== VIEW ALL ======================================
		public function afficherProduits_ALL() {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM produit WHERE finish_prod=0 and bid_prod=0') ; 
				$query->execute() ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		}

		public function afficherProduits_category_ALL($category_prod) {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM produit WHERE category_prod=:category_prod and finish_prod=0 and bid_prod=0 ') ; 
				$query->execute([
						'category_prod' => $category_prod
				]) ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		}
		// ============ END VIEW ALL ========================



		public function afficherProduits_bidding() {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM produit WHERE bid_prod=1 and finish_prod=0') ; 
				$query->execute() ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		}


		public function afficherProduits_finished() {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM produit where finish_prod=1') ; 
				$query->execute() ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		}

		public function check_produit_finished($id_prod) {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM produit where finish_prod=1 and id_prod=:id_prod') ; 
				$query->execute([
					'id_prod' => $id_prod
				]) ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		}

		

		public function afficherProduitsID($id_prod) {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM produit WHERE id_prod=:id_prod') ; 
				$query->execute([
					'id_prod' => $id_prod
				]) ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		} 


 

		/*
		function ajouter_user($user){
			$sql="INSERT INTO user (nom_user,prenom_user,telephone_user,email_user,password_user,budget_user) 
				VALUES (:nom_user,:prenom_user,:telephone_user,:email_user,:password_user,:budget_user)";
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
					'budget_user' => $user->getbudget_user()

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
		} */
	
		 public function modifier_produit_totalparticipation($produit,$id_prod){
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('UPDATE produit SET 
                        participation_prod = participation_prod + :participation_prod

                    WHERE id_prod = :id_prod') ; 
                $query->execute([
                    'id_prod' => $id_prod,
                    'participation_prod' =>  $produit->getparticipation_prod() 
 
                ]) ; 
                return $query->fetchAll();


                 
                //echo $query->rowCount() . "UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        } 

        public function modifier_produit_bid($id_prod){
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('UPDATE produit SET 
                        bid_prod=1

                    WHERE id_prod = :id_prod') ; 
                $query->execute([
                    'id_prod' => $id_prod 
 
                ]) ; 
                return $query->fetchAll();


                 
                //echo $query->rowCount() . "UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        } 


        public function modifier_produit_finish($id_prod){
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('UPDATE produit SET 
                        finish_prod=1

                    WHERE id_prod = :id_prod') ; 
                $query->execute([
                    'id_prod' => $id_prod 
 
                ]) ; 
                return $query->fetchAll();


                 
                //echo $query->rowCount() . "UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }

        public function modifier_produit_close_bidding($id_prod){
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('UPDATE produit SET 
                        bid_prod=2

                    WHERE id_prod = :id_prod') ; 
                $query->execute([
                    'id_prod' => $id_prod 
 
                ]) ; 
                return $query->fetchAll();


                 
                //echo $query->rowCount() . "UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        } 

        public function modifier_produit_tempsfin($id_prod,$produit){
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('UPDATE produit SET 
                        temps_fin=:temps_fin

                    WHERE id_prod = :id_prod') ; 
                $query->execute([
                    'id_prod' => $id_prod,
                    'temps_fin' => $produit->gettemps_fin()
 
                ]) ; 
                return $query->fetchAll();

            } catch (PDOException $e) {
                $e->getMessage();
            }
        } 

}



?>