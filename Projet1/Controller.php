<?php
	session_start();
	include('Reservation.class.php');
	include('Detail.class.php');
	// En 1er lieu, on va lancer la page(la vue) de réservation : il s'agit d'un formulaire à remplir 
	include('View_Reservation.php');
	
	// Quand on appuye sur "Etape suivante" (page réservation)
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
	}
	
	// On rassemble ces infos dans les classes
	$Info = new InfoReservation($_SESSION['destination'], $_SESSION['nb_traveler'], $_SESSION['insurance']);
	
	// Autre cas : si on appuye sur "annuler réservation"	



	
	//Pour savoir quelle page ouvrir
	// GET -> Les données sont transmises dans l'URL
	if (isset($_GET['page']))
	{
		$page = $_GET['page'];
	}
	else
	{
		$page = 'homepage';
	}
	
	// On regarde quelle valeur de page nous est renvoiée
	// Afin de savoir sur quelle page on doit aller
	switch($page)
	{	
		case 'homepage':
			include ('Controller.php'); 
			break;
			
		case 'details':
			include ('View_DetailReservation.php');
			// Quand on appuye sur "Etape suivante"
			if (isset($_POST["nextDetails"]))
			{
				for ($i=0 ; $i < $Info->GetNb_traveler; $i++)
				{
					$_SESSION['nom[i]'] = $_POST['name[i]'];
			   		$_SESSION['age[i]'] = $_POST['age[i]'];
			   		// avec AddTraveler, on ajoute un passager à la liste des passagers
			   		$Info->AddTraveler($_SESSION['nom[i]'], $_SESSION['age[i]']);
   					$Passager[i] = new Traveler($_SESSION['nom[i]'], $_SESSION['age[i]'])
				}
			}
			$Passager[i] = new Traveler($_SESSION['nom'], $_SESSION['age'])
			break;
		
		case 'validation':
			include ('View_ValidationReservation.php');
			break;
		
		case 'confirmation':
			include ('View_Confirmation.php');
			break;
			
		case 'cancel':
			session_destroy();
			include('Controller.php');
			break;
	}
			
?>
