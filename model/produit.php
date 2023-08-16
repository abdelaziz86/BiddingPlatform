<?PHP

	class produit{
		private $id_prod  = null;
		private $nom_prod = null ;
		private $prixbout_prod = null ;
		private $total_prod = null ;
		private $participation_prod = null ; 
		private $category_prod  = null ;
		private $photo_prod = null ; 
		private $temps_fin = null ; 

		function __construct($nom_prod, $prixbout_prod,$total_prod,$participation_prod,$category_prod,$photo_prod,$temps_fin){
			$this->nom_prod = $nom_prod ;	
			$this->prixbout_prod = $prixbout_prod ;		 
			$this->total_prod = $total_prod ;
			$this->participation_prod = $participation_prod ;
			$this->category_prod = $category_prod ;
			$this->photo_prod = $photo_prod ; 
			$this->temps_fin = $temps_fin ; 
		
		}
		//-------------------GETTERS-----------------
		function getid_prod(){
			return $this->id_prod;
		}
		function getnom_prod(){
			return $this->nom_prod;
		}
		function getprixbout_prod(){
			return $this->prixbout_prod;
		}
		function gettotal_prod(){
			return $this->total_prod;
		}
		function getparticipation_prod(){
			return $this->participation_prod;
		}
		function getcategory_prod(){
			return $this->category_prod;
		}
		function getphoto_prod(){
			return $this->photo_prod;
		} 
		function gettemps_fin(){
			return $this->temps_fin;
		}
		
		//---------------SETTERS-------------------
		function setnom_prod($nom_prod){
			$this->nom_prod = $nom_prod;
		}

		function setprixbout_prod($prixbout_prod){
			$this->prixbout_prod = $prixbout_prod;
		}
		function settotal_prod($total_prod){
			$this->total_prod = $total_prod;
		}
		function setparticipation_prod($participation_prod){
			$this->participation_prod = $participation_prod;
		}
		function setcategory_prod($category_prod){
			$this->category_prod = $category_prod;
		}
		function setphoto_prod($photo_prod){
			$this->photo_prod = $photo_prod;
		} 
	}
?>