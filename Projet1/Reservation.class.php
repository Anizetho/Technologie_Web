<!-- Reservation.class.php --> 
<!-- Author : Thomas Anizet --> 

<?php
	class InfoReservation
	{
		private $destination;
		private $nb_traveler;
		private $insurance;
		
		public function __construct($destination, $nbrePlaces, $assurance) 
		{ 
		   $this->destination = $destination;  
		   $this->nb_traveler = $nbrePlaces;
		   $this->insurance = $assurance;
		}
		
		public function GetDestination()  
		{  
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