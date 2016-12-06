<?php
	session_start();
	include('Reservation.class.php');
	include('Detail.class.php');
	include('Confirmation.class.php');

	// En 1er lieu, on va lancer la page(la vue) de réservation : il s'agit d'un formulaire à remplir 
	
	// Premièrement, on connecte notre base de données (bdd)
	try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=Reservation;charset=utf8', 'root', 'root');
        }
    catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }


	// Quand on appuye sur "Etape suivante" depuis la page réservation (pour aller vers détail)
	if (isset($_POST["nextReservation"]))
	{
		$_SESSION['destination'] = $_POST['destination'];
	    $_SESSION['nb_traveler'] = $_POST['nb_traveler'];
	    // Si on a coché la case assurance
	    if(isset($_POST['insurance']))
			{
				$_SESSION['insurance'] = 'OUI';
			}
		// Si on ne l'a pas cochée
		else
			{
				$_SESSION['insurance'] = 'NON';
			}
		
		// On rassemble ces infos dans les classes
		$InfoVoyage = new InfoReservation($_SESSION['destination'], $_SESSION['nb_traveler'], $_SESSION['insurance']);

		// On enregistre ces infos dans la bdd (base de donnée)
		$reqInfoVoyage = $bdd->prepare('INSERT INTO Info_Voyage(destination, assurance, nombre_voyageurs) VALUES(:destination, :assurance, :nombre_voyageurs)');
		$reqInfoVoyage->execute(array(
			'destination' => $InfoVoyage->GetDestination(),
		    'assurance' => $InfoVoyage->GetInsurance(),
		    'nombre_voyageurs' => $InfoVoyage->GetNb_traveler()
	    ));
	}
	
	// On rassemble ces infos dans les classes
	$InfoVoyage = new InfoReservation($_SESSION['destination'], $_SESSION['nb_traveler'], $_SESSION['insurance']);

	



	// Quand on appuye sur "Etape suivante" depuis la page détail (pour aller vers validation)
	if (isset($_POST["nextDetails"]))
	{
		// On enregistre le nom et l'age dans la bdd
		for($i=0; $i<$InfoVoyage->GetNb_traveler(); $i++)
		{
			$ListNom = $_POST['nom'];
			$ListAge = $_POST['age'];
		    $reqInfoVoyageur = $bdd->prepare('INSERT INTO Info_Voyageur(nom, age) VALUES(:nom, :age)');
			$reqInfoVoyageur->execute(array(
				'nom' => $ListNom[$i],
				'age' => $ListAge[$i]
			    ));
			//print_r($ListNom[$i]) ;
		}

		// On rassemble ces infos dans les classes
		$AgeInf = 0;
		$AgeSupp = 0;
		for($i=0; $i<$InfoVoyage->GetNb_traveler(); $i++)
		{
			$p=$i+1;
			$ListNom = $_POST['nom'];
			$ListAge = $_POST['age'];

			$_SESSION['nom'.$i] = $ListNom[$i];
			$_SESSION['age'.$i] = $ListAge[$i];
			
			// Pour teste l'utilité de ce for 
			//echo $p . ") " . $_SESSION['nom'.$i] . "</br>";
			//echo $p . ") " . $_SESSION['age'.$i] . "</br>";

			// On rassemble le nom et l'age dans une classe 
			// Remarque : cette info porte le n° du passager (on commence à 1, pas 0)
		    $InfoVoyageur[$p] = new Traveler($_SESSION['nom'.$i], $_SESSION['age'.$i]);

		    if($_SESSION['age'.$i]<13)
			{
				$AgeInf+=1;
			}
			else
			{
				$AgeSupp+=1;
			}
			

		}
		$_SESSION['AgeInf']=$AgeInf;
		$_SESSION['AgeSupp']=$AgeSupp;
		$SauvegardeAges = new SaveAge($_SESSION['AgeInf'], $_SESSION['AgeSupp']);
		
		//echo "testons si globale : " . $InfoVoyageur[1]->GetAge() . "</br>";
		//echo "En-dessous de 12 ans : " . $AgeInf . "</br>";
		//echo "Au-dessus de 12 ans : " . $AgeSupp . "</br>";

	}

	//On sauvegarde les ages
	$SauvegardeAges = new SaveAge($_SESSION['AgeInf'], $_SESSION['AgeSupp']);


	// Quand on appuye sur "Confirmer" depuis la page Validation (pour aller vers confirmation)
	if (isset($_POST["nextValidation"]))
	{
		if ($InfoVoyage->GetInsurance() == "OUI")
		{
			$priceAssurance = 20;
		}
		if($InfoVoyage->GetInsurance() == "NON")
		{
			$priceAssurance = 0;
		}
		$AgeInfGet = $SauvegardeAges->GetAgeInf();
		$AgeSuppGet = $SauvegardeAges->GetAgeSupp();
		
		$priceInf = $AgeInfGet *10;
		$priceSupp = $AgeSuppGet*15;

		// En conclusion : 
		$price = $priceInf+$priceSupp+$priceAssurance;
		$_SESSION['TotalPrice']=$price;
	}

	// Autre cas : si on appuye sur "annuler réservation"	

	

	
	//Pour savoir quelle page ouvrir
	// GET -> Les données sont transmises dans l'URL
	if (isset($_GET['page']))
	{
		$page = $_GET['page'];
	}
	else
	{
		$page = 'reservation';
	}
	
	// On regarde quelle valeur de page nous est renvoiée
	// Afin de savoir sur quelle page on doit aller
	switch($page)
	{	
		case 'homepage':
			include ('Controller.php'); 
			break;


		case 'reservation':
			include ('View_Reservation.php');
			break;
			

		case 'details':
			include ('View_DetailReservation.php');
			break;
		
		case 'validation':
			include ('View_ValidationReservation.php');
			break;
		
		case 'confirmation':
			include ('View_ConfirmationReservation.php');
			break;
			
		case 'cancel':
			session_destroy();
			include('Controller.php');
			break;
	}
			
?>

<!-- To Do : 
- Quand on rafraîchit une page, cela enregistre des données dans la bdd -> Y remédier !
- pas oublier le required pour les entrées!
- 
- 
-->
