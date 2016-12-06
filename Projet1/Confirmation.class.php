<!-- Reservation.class.php --> 
<!-- Author : Thomas Anizet --> 
<?php
	class SaveAge
	{
	// attributs --> ATTENTION private
	private $AgeInf;
	private $AgeSupp;
	
	// Création constructeur 
	public function __construct($AgeInférieur, $AgeSuppérieur) 
	{ 
	   $this->AgeInf = $AgeInférieur;
	   $this->AgeSupp = $AgeSuppérieur;
	}
	
	// Création des différentes méthodes 
	public function GetAgeInf()  
	{  
		
		// "$this" permet d'accéder aux attributs de la classe
	   return $this->AgeInf ;  
	}

	public function GetAgeSupp()  
	{  
		
		// "$this" permet d'accéder aux attributs de la classe
	   return $this->AgeSupp ;  
	}
	}
?>