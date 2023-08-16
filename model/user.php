<?PHP

	class user{
		private $id_user  = null;
		private $nom_user = null ;
		private $prenom_user = null ;
		private $telephone_user = null ;
		private $email_user = null ;
		private $password_user = null ;
		private $budget_user = null ;
		private $adresse_user = null ;
		private $pdp_user = null ;
		private $refcode_user = null ;

		function __construct($nom_user, $prenom_user,$telephone_user,$email_user,$password_user,$budget_user,$adresse_user,$pdp_user, $refcode_user ){
			$this->nom_user = $nom_user ;	
			$this->prenom_user = $prenom_user ;		 
			$this->telephone_user = $telephone_user ;
			$this->email_user = $email_user ;
			$this->password_user = $password_user ;
			$this->budget_user = $budget_user ;
			$this->adresse_user = $adresse_user ;
			$this->pdp_user = $pdp_user ;
			$this->refcode_user = $refcode_user ; 
		
		}
		//-------------------GETTERS-----------------
		function getid_user(){
			return $this->id_user;
		}
		function getnom_user(){
			return $this->nom_user;
		}
		function getprenom_user(){
			return $this->prenom_user;
		}
		function gettelephone_user(){
			return $this->telephone_user;
		}
		function getemail_user(){
			return $this->email_user;
		}
		function getpassword_user(){
			return $this->password_user;
		}
		function getbudget_user(){
			return $this->budget_user;
		}
		function getadresse_user(){
			return $this->adresse_user;
		}

		function getpdp_user(){
			return $this->pdp_user;
		}
		function getrefcode_user(){
			return $this->refcode_user;
		}
		//---------------SETTERS-------------------
		function setnom_user($nom_user){
			$this->nom_user = $nom_user;
		}

		function setprenom_user($prenom_user){
			$this->prenom_user = $prenom_user;
		}
		function settelephone_user($telephone_user){
			$this->telephone_user = $telephone_user;
		}
		function setemail_user($email_user){
			$this->email_user = $email_user;
		}
		function setpassword_user($password_user){
			$this->password_user = $password_user;
		}
		function setbudget_user($budget_user){
			$this->budget_user = $budget_user;
		}
		function setadresse_user($adresse_user){
			$this->adresse_user = $adresse_user;
		}
	}
?>