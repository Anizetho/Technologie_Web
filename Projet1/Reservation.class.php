<!-- Reservation.class.php --> 
<!-- Author : Thomas Anizet --> 

<?php
	class InfoReservation
	{
		// attributs --> ATTENTION private
		private $destination;
		private $nb_traveler;
		private $insurance;
		
		// Création constructeur 
		public function __construct($destination, $nbrePlaces, $assurance) 
		{ 
		   $this->destination = $destination;  
		   $this->nb_traveler = $nbrePlaces;
		   $this->insurance = $assurance;
		}
		
		// Création des différentes méthodes 
		public function GetDestination()  
		{  
			// "$this" permet d'accéder aux attributs de la classe
		   return $this->destination ;  
		} 
	
		public function GetNb_traveler()  
		{  
		   return $this->nb_traveler;  
		}
		
		public function GetInsurance()
		{
			return $this->insurance;
		}
	}
?>