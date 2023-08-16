<?php

class salleC {
	// ================== CRUD ===========================
		public function afficherSalle($id_prod) {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM salle WHERE id_prod=:id_prod ORDER BY date_ench DESC') ; 
				$query->execute([
					'id_prod' => $id_prod
				]) ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		} 

        public function afficherSalle_gagnant($id_prod) {
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('SELECT * FROM salle WHERE id_prod=:id_prod and winner=1') ; 
                $query->execute([
                    'id_prod' => $id_prod
                ]) ; 
                return $query->fetchAll();

            } catch (PDOException $e) {
                $e->getMessage() ; 
            }
        } 


        public function afficher_user_wins($id_user) {
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('SELECT * FROM salle WHERE id_user=:id_user and winner=1') ; 
                $query->execute([
                    'id_user' => $id_user
                ]) ; 
                return $query->fetchAll();

            } catch (PDOException $e) {
                $e->getMessage() ; 
            }
        }


        public function afficherCount_enchere($id_prod) {
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('SELECT COUNT(*) as total FROM salle WHERE id_prod=:id_prod') ; 
                $query->execute([
                    'id_prod' => $id_prod
                ]) ; 
                return $query->fetchAll();

            } catch (PDOException $e) {
                $e->getMessage() ; 
            }
        } 


        public function find_losers($id_user,$id_prod){
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('SELECT * from salle WHERE id_user <> :id_user AND winner=1 AND id_prod=:id_prod') ; 
                $query->execute([
                    'id_user' => $id_user,
                    'id_prod' => $id_prod
 
                ]) ; 
                return $query->fetchAll();


                 
                //echo $query->rowCount() . "UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
 

		function ajouter_salle($salle){
			$sql="INSERT INTO salle (id_user,id_prod,total_ench) 
				VALUES (:id_user,:id_prod,:total_ench)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
			
				$query->execute([
					'id_user' => $salle->getid_user(),
					'id_prod' => $salle->getid_prod(),
					'total_ench' => $salle->gettotal_ench() 

				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}


		 public function delete_enchere($id_user,$id_prod) {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('DELETE FROM salle WHERE id_user = :id_user and id_prod =:id_prod') ; 
				$query->execute([
                    'id_user' => $id_user,
                    'id_prod' => $id_prod
                ]);
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		} 
		 public function modifier_enchere_user($id_user,$id_prod,$salle){
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('UPDATE salle SET 
                        total_ench = :total_ench 

                    WHERE id_prod = :id_prod AND id_user = :id_user') ; 
                $query->execute([
                    'id_prod' => $id_prod,
                    'id_user' => $id_user, 
                    'total_ench' =>  $salle->gettotal_ench() 
 
                ]) ; 
                return $query->fetchAll(); 
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }


        

        public function change_losers($id_prod){
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('UPDATE salle SET 
                        winner = 0 

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

}



?>