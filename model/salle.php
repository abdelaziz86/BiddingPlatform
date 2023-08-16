<?PHP

	class salle{
		private $id_ench  = null;
		private $id_user = null ;
		private $id_prod = null ;
		private $total_ench = null ;
		private $date_ench = null ; 

		function __construct($id_user, $id_prod,$total_ench,$date_ench){
			$this->id_user = $id_user ;	
			$this->id_prod = $id_prod ;		 
			$this->total_ench = $total_ench ;
			$this->date_ench = $date_ench ; 
		
		}
		//-------------------GETTERS-----------------
		function getid_ench(){
			return $this->id_ench;
		}
		function getid_user(){
			return $this->id_user;
		}
		function getid_prod(){
			return $this->id_prod;
		}
		function gettotal_ench(){
			return $this->total_ench;
		}
		function getdate_ench(){
			return $this->date_ench;
		} 
		//---------------SETTERS-------------------
		function setid_user($id_user){
			$this->id_user = $id_user;
		}

		function setid_prod($id_prod){
			$this->id_prod = $id_prod;
		}
		function settotal_ench($total_ench){
			$this->total_ench = $total_ench;
		}
		function setdate_ench($date_ench){
			$this->date_ench = $date_ench;
		} 
	}
?>