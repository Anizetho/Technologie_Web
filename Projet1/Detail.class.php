<!-- Detail.class.php --> 
<!-- Author : Thomas Anizet --> 

<?php
	class Traveler
	{
		// attributs --> ATTENTION private
		private $name;
		private $age;
		
		// Création constructeur 
		public function __construct($nom, $age) 
		{ 
		   $this->name = $nom; 
		   $this->age = $age;
		}
		
		// Création des différentes méthodes 
		public function GetName()  
		{  
			// "$this" permet d'accéder aux attributs de la classe			
		   return $this->name;  
		}
		
		public function GetAge()  
		{  
		   return $this->age;  
		}
	}
?>