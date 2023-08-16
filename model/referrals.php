<?PHP

	class referrals{
		private $id_ref  = null;
		private $id_user1 = null ;
		private $id_user2 = null ;

		function __construct($id_user1, $id_user2){
			$this->id_user1 = $id_user1 ;
			$this->id_user2 = $id_user2 ;  
		
		}
		//-------------------GETTERS-----------------
		function getid_ref(){
			return $this->id_ref;
		}
		function getid_user1(){
			return $this->id_user1;
		}
		function getid_user2(){
			return $this->id_user2;
		} 
		 
	}
?>