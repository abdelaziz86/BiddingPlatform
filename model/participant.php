<?PHP

	class participant{
		private $id_user  = null;
		private $id_prod = null ;  

		function __construct($id_user, $id_prod){
			$this->id_user = $id_user ;	
			$this->id_prod = $id_prod ;		 
		
		}
		//-------------------GETTERS-----------------
		function getid_user(){
			return $this->id_user;
		}
		function getid_prod(){
			return $this->id_prod;
		} 
		//---------------SETTERS-------------------
		function setid_user($id_user){
			$this->id_user = $id_user;
		}

		function setid_prod($id_prod){
			$this->id_prod = $id_prod;
		} 
	}
?>