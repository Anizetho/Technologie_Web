<!-- DonneeVoyage.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Titre</title>
		
	</head>

	<body>
		<?php
			class information
			{
				// attributs --> ATTENTION private
				private $destination;
				private $nb_traveler;
				private $insurance;
				public $listTravelers;
				
				// Création constructeur 
				public function __construct($dest, $nb_traveler, $insurance) 
				{ 
				   $this->destination = $dest;  
				   $this->nb_traveler = $nb_traveler;
				   $this->insurance = $insurance;
				   $this->listTravelers = array();
				}
				
				public function save()
				{
					$_SESSION['Reservation_model']=serialize($this);
				}
				// Création des différentes méthodes 
				public function getDestination()  
				{  
					// "$this" permet d'accéder aux attributs de la classe
				   return $this->destination ;  
				} 
			
				public function get_nb_traveler()  
				{  
				   return $this->nb_traveler;  
				}
				
				public function getInsurance()
				{
					return $this->insurance;
				}

				public function addTraveler($name, $age)
				{
					// On appelle la classe Traveler pour créer un objet passenger
					$passenger  = new Traveler($name, $age);
					// On ajoute à liste Traveler (ou tableau pour être correcte) l'objet créé.
					$listTravelers[] = passenger;
				}

				public function getList()
				{
					return $this->listTravelers;
				}

			}
			
				
				echo "les classe";
				echo "<br>";		
				
				// Création d'un objet avec "new"
				$test = new information("Belgium", 3, TRUE);
				// "->" permet d'accéder aux attributs et méthodes de l'objet créé.
				// Exemple pour accéder aux méthodes
				echo $test->getDestination(); // Rep : Belgium
				echo "<br>";
				echo $test->get_nb_traveler(); // Rep : 3
				echo "<br>";
				echo $test->getInsurance(); // Rep : 1 -> TRUE renvoie 1 MAIS FALSE ne renvoie RIEN (pas 0)
				echo "<br>";
				$test->addTraveler("Anizet", 20);
				echo $test->getList();
				//echo "<br>";
				//echo $test->addTraveler("Anizet", 20);
				//echo "<br>";
				//echo $Traveler->get_name();
				//echo "<br>";
				//echo $test->getList();
				//echo "<br>";
				
				// Remarque : 	- regarder comment on ajoute des éléments à un tableau
				//				- regarder la vidéo sur le POO
				//				- 
				
		?>
	</body>
</html>
		