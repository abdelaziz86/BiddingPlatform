<?php

class referralsC {
	// ================== CRUD ===========================
		public function afficher_Referrals($id_user2) {
			try {

				$pdo = getConnexion() ; 
				$query = $pdo->prepare('SELECT * FROM referrals WHERE id_user2=:id_user2') ; 
				$query->execute([
					'id_user2' => $id_user2
				]) ; 
				return $query->fetchAll();

			} catch (PDOException $e) {
				$e->getMessage() ; 
			}
		} 


        public function afficher_Referrals_totalcount($id_user2) {
            try {

                $pdo = getConnexion() ; 
                $query = $pdo->prepare('SELECT COUNT(*) as total FROM referrals WHERE id_user2=:id_user2') ; 
                $query->execute([
                    'id_user2' => $id_user2
                ]) ; 
                return $query->fetchAll();

            } catch (PDOException $e) {
                $e->getMessage() ; 
            }
        } 

        function ajouter_referrals($referrals){
            $sql="INSERT INTO referrals (id_user1,id_user2) 
                VALUES (:id_user1,:id_user2)";
            $db = config::getConnexion();
            try{
                $query = $db->prepare($sql);
            
                $query->execute([
                    'id_user1' => $referrals->getid_user1(),
                    'id_user2' => $referrals->getid_user2() 

                ]);         
            }
            catch (Exception $e){
                echo 'Erreur: '.$e->getMessage();
            }           
        }

        

}



?>