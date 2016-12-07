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
		//include('Detail.class.php');
			
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
	
				echo "les classes (ici?)";
				echo "<br>";		
				
				/*// Création d'un objet avec "new"
				$test = new information("Belgium", 3, TRUE);
				// "->" permet d'accéder aux attributs et méthodes de l'objet créé.
				// Exemple pour accéder aux méthodes
				echo $test->getDestination(); // Rep : Belgium
				echo "<br>";
				echo $test->get_nb_traveler(); // Rep : 3
				echo "<br>";
				echo $test->getInsurance(); // Rep : 1 -> TRUE renvoie 1 MAIS FALSE ne renvoie RIEN (pas 0)
				echo "<br>";*/
				$test = new SaveAge(423998798789879879842, 0);

				echo $test->GetAgeInf() . "</br>";
				echo $test->GetAgeSupp(). "</br>";

				/*echo $test->setTraveler("Anizet Thomas", 20);
				echo "<br>";		
				echo $test->getList();
				echo "<br>";		
				echo $test->setTraveler("Dale", 21);
				echo "<br>";		
				echo $test->getList();*/


				
				// Remarque : 	- regarder comment on ajoute des éléments à un tableau
				//				- regarder la vidéo sur le POO
				//				- 
				
		?>
	</body>
</html>
		