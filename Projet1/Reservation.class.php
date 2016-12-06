<!-- Reservation.class.php --> 
<!-- Author : Thomas Anizet --> 
<?php
			class InfoReservation
			{
				// attributs --> ATTENTION private
				private $destination;
				private $nb_traveler;
				private $insurance;
				public $listTravelers;
				
				// Création constructeur 
				public function __construct($destination, $nbrePlaces, $assurance) 
				{ 
				   $this->destination = $destination;  
				   $this->nb_traveler = $nbrePlaces;
				   $this->insurance = $assurance;
				   $this->listTravelers = array();
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

				public function AddTraveler($name, $age)
				{
					// On appelle la classe Traveler pour créer un objet passenger
					$passenger  = new Traveler($name, $age);
					// On ajoute à liste Traveler (ou tableau pour être correcte) l'objet créé.
					$listTravelers[] = $passenger;
				}

				public function GetList()
				{
					return $this->listTravelers;
				}

			}
?>