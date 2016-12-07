<!-- Controller.php --> 
<!-- Author : Thomas Anizet --> 

<?php
	session_start();
	include('Reservation.class.php');
	include('Detail.class.php');
	include('Confirmation.class.php');

//**************************************************** Pour connecter la bdd ****************************************************
//******************************************************(utilisation de PDO)*****************************************************
	try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=Reservation;charset=utf8', 'root', 'root');
        }
    catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }


//**************************************************** Pour "avancer" ****************************************************
//********************************************("Etape suivante", "Confirmer")*********************************************

	// ************ Quand on appuye sur "Etape suivante" DEPUIS la page réservation (pour aller vers détail) *************
	if (isset($_POST["nextReservation"]))
	{
		// htmlspecialchars pour protéger contre la faille XSS
		$_SESSION['destination'] = htmlspecialchars($_POST['destination']);
	    $_SESSION['nb_traveler'] = htmlspecialchars($_POST['nb_traveler']);
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

		
	}
	
	// On rassemble ces infos dans les classes
	$InfoVoyage = new InfoReservation($_SESSION['destination'], $_SESSION['nb_traveler'], $_SESSION['insurance']);






	// ************* Quand on appuye sur "Etape suivante" DEPUIS la page détail (pour aller vers validation) *************
	if (isset($_POST["nextDetails"]))
	{
		// On enregistre le nom et l'age dans la bdd
		for($i=0; $i<$InfoVoyage->GetNb_traveler(); $i++)
		{
			$ListNom = htmlspecialchars($_POST['nom']);
			$ListAge = htmlspecialchars($_POST['age']);
		    $reqInfoVoyageur = $bdd->prepare('INSERT INTO Info_Voyageur(nom, age) VALUES(:nom, :age)');
			$reqInfoVoyageur->execute(array(
				'nom' => $ListNom[$i],
				'age' => $ListAge[$i]
			    ));
			//print_r($ListNom[$i]) ;
		}

		// On rassemble ces infos (nom et age) avec les classes
		$AgeInf = 0;
		$AgeSupp = 0;
		for($i=0; $i<$InfoVoyage->GetNb_traveler(); $i++)
		{
			$p=$i+1;

			$_SESSION['nom'.$i] = htmlspecialchars($_POST['nom'][$i]);
			$_SESSION['age'.$i] = htmlspecialchars($_POST['age'][$i]);
			
			// Pour teste l'utilité de ce for 
			//echo $p . ") " . $_SESSION['nom'.$i] . "</br>"; // Affiche par ex. : 1) Anizet
			//echo $p . ") " . $_SESSION['age'.$i] . "</br>"; // Affiche par ex. : 1) 20

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

		// On crée des variables de SESSION pour plus facilement transmettre plus facilement les informations
		$_SESSION['AgeInf']=$AgeInf;
		$_SESSION['AgeSupp']=$AgeSupp;
		$SauvegardeAges = new SaveAge($_SESSION['AgeInf'], $_SESSION['AgeSupp']);
	}

	// Test -> Test ok 
	echo "tester si nom et age sont bien des variables de session : </br>";
	//echo "1) " . $_SESSION['nom0'] . "</br>"; // Affiche : 1) ...nom...
	//echo "1) " . $_SESSION['age0'] . "</br>"; // Affiche : 1) ...nom...
	//echo "1) " . $InfoVoyageur[2]->GetName() . "</br>"; // Affiche : 1) ...nom...
	//echo "1) " . $InfoVoyageur[2]->GetAge() . "</br>"; // Affiche : 1) ...nom...

	//On sauvegarde les ages
	$SauvegardeAges = new SaveAge($_SESSION['AgeInf'], $_SESSION['AgeSupp']);






	// ************* Quand on appuye sur "Confirmer" DEPUIS la page Validation (pour aller vers confirmation) *************
	if (isset($_POST["nextValidation"]))
	{
		// On va calculer le prix total du voyage
		// 1) On regarde si l'assurance est cochée
		// prix assurance = 20€
		if ($InfoVoyage->GetInsurance() == "OUI")
		{
			$priceAssurance = 20;
		}
		if($InfoVoyage->GetInsurance() == "NON")
		{
			$priceAssurance = 0;
		}
		// 2) On regarde quel age ont les voyageurs et en fonction, on calcule les prix
		//  <12ans => 10€   MAIS    >12ans => 15€
		$AgeInfGet = $SauvegardeAges->GetAgeInf();
		$AgeSuppGet = $SauvegardeAges->GetAgeSupp();
		$priceInf = $AgeInfGet *10;
		$priceSupp = $AgeSuppGet*15;

		// 3) Au final, le prix total vaut : 
		$price = $priceInf+$priceSupp+$priceAssurance;
		// On en crée une variable de SESSION
		$_SESSION['TotalPrice']=$price;



		// On enregistre ces infos dans la bdd (base de donnée) dès qu'on a appuyé sur le bouton "Confirmer"
		$reqInfoVoyage = $bdd->prepare('INSERT INTO Info_Voyage(destination, assurance, nombre_voyageurs) VALUES(:destination, :assurance, :nombre_voyageurs)');
		$reqInfoVoyage->execute(array(
			'destination' => $InfoVoyage->GetDestination(),
		    'assurance' => $InfoVoyage->GetInsurance(),
		    'nombre_voyageurs' => $InfoVoyage->GetNb_traveler()
	    ));
	    session_destroy();
	}




//**************************************************** Pour les retour en arrière ****************************************************
//**********************("Retour à la page précédente", "Annuler la réservation", "Retour à la page d'acceuil")***********************

	// 1) Si on se trouve sur la page détail et qu'on veut revenir au formulaire de départ
	if (isset($_POST["backDetails"]))
	{
	}

	// 2) Si on se trouve sur la page Validation et qu'on veut revenir à la page précédente (détail)
	if (isset($_POST["backValidation"]))
	{
	}

	// 3) Si on se trouve sur une des pages (n'importe laquelle) et on souhaite annuler la réservation
	if (isset($_POST["backcancel"]))
	{
		echo "<h6>ATTENTION : En annulant votre réservation, vous allez perdre toutes les données déjà entrées précédemment ! Êtes-vous certain d'annuler ? </br>-> Si oui, cliquez sur <em>'Annuler la réservation'</em>.</br> -> Sinon, cliquez sur <em>'Etape suivante'</em>.<h6>";
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
			if (isset($_POST['cancel']))
				{
					session_destroy();
					echo "<h6><em><font color='red'> Réservation annulée !</font></em></br> Si vous souhaitez encoder une nouvelle réservation, n'hésitez pas.</h6>";
				}
			include('View_Reservation.php');
			break;
	}
			
?>

<!-- 
1) To Do : 
- Quand on rafraîchit une page, cela enregistre des données dans la bdd -> Y remédier ! -> Ok pour InfoVoyage / pas Ok pour InfoVoyageur
- lier (join) les 2 tables
- pas oublier la protection avec htmlspecialchars -> Ok
- protection pour entrer des nombres entiers -> Ok
- problème d'affichage (présence ligne discontinue) quand on souhaite annuler une réservation

2) Demander au prof :
- Possibilité de revenir en arrière et que la case soit coché ou non selon ce qu'on avait fait avant ?
- Problème : faut appuyer 2 fois pour destroyer la session
-->
