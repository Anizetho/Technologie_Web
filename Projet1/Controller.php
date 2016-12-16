<!-- Controller.php --> 
<!-- Author : Thomas Anizet --> 

<?php
	session_start();
	include('Reservation.class.php');
	include('Detail.class.php');
	include('Confirmation.class.php');

//**************************************************** To connect the database ****************************************************
//******************************************************(Using PDO)*****************************************************
	try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=Reservation;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
    catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }


//**************************************************** To advance ****************************************************
//********************************************("next step", "Confirmation")*********************************************

	// ************ When we press "Next step (Etape suivante)" on the reservation page *************
	if (isset($_POST["nextReservation"]))
	{
		// htmlspecialchars to protect against XSS fault
		// To save the data in session
		$_SESSION['destination'] = htmlspecialchars($_POST['destination']);
	    $_SESSION['nb_traveler'] = htmlspecialchars($_POST['nb_traveler']);
	    // If the check box is checked
	    if(isset($_POST['insurance']))
			{
				$_SESSION['insurance'] = 'OUI';
			}
		// If the check box is not checked
		else
			{
				$_SESSION['insurance'] = 'NON';
			}
		
		// To collect this info
		$InfoTravel = new InfoReservation($_SESSION['destination'], $_SESSION['nb_traveler'], $_SESSION['insurance']);
	}
	
	// To use this info at any time
	$InfoTravel = new InfoReservation($_SESSION['destination'], $_SESSION['nb_traveler'], $_SESSION['insurance']);
	// To see if we must tick the box when the customer go back on the reservation page
	if ($InfoTravel->GetInsurance() == 'OUI') {$check = checked;}
	if ($InfoTravel->GetInsurance() == 'NON') {$check = '';}






	// ************* When we press "Next step (Etape suivante)" on the detail page *************
	if (isset($_POST["nextDetails"]))
	{
		// AgeLow and AgeUp -> To calculate the price (used after)
		$AgeLow = 0;
		$AgeUp = 0;
		// To save the data of each person in session
		for($i=0; $i<$InfoTravel->GetNb_traveler(); $i++)
		{
			$p=$i+1;

			$_SESSION['name'.$i] = htmlspecialchars($_POST['name'][$i]);
			$_SESSION['age'.$i] = htmlspecialchars($_POST['age'][$i]);
			
		    $InfoTraveler[$p] = new Traveler($_SESSION['name'.$i], $_SESSION['age'.$i]);

		    if($_SESSION['age'.$i]<13)
			{
				$AgeLow+=1;
			}
			else
			{
				$AgeUp+=1;
			}
		}

		$_SESSION['AgeLow']=$AgeLow;
		$_SESSION['AgeUp']=$AgeUp;
		$SavingAges = new SaveAge($_SESSION['AgeLow'], $_SESSION['AgeUp']);
	}

	// To use this info at any time (+ in SESSION !)
	// Creation of 2 lists : One with the names and one with the ages
	for($i=0; $i<$InfoTravel->GetNb_traveler(); $i++)
		{
			$p=$i+1;
		    $InfoTraveler[$p] = new Traveler($_SESSION['name'.$i], $_SESSION['age'.$i]);

		    // To calculate the total price
		    // Different price between the adults and the children
		    if($_SESSION['age'.$i]<13)
			{
				$AgeLow+=1;
			}
			else
			{
				$AgeUp+=1;
			}

		    // Add each name and each age to a list
		    $ListName[] = $InfoTraveler[$p]->GetName();
			$ListAge[] = $InfoTraveler[$p]->GetAge();
		}

	$_SESSION['AgeLow']=$AgeLow;
	$_SESSION['AgeUp']=$AgeUp;
	$SavingAges = new SaveAge($_SESSION['AgeLow'], $_SESSION['AgeUp']);

	// To create a list who display correctly the names in the database (+ SESSION).
	$correctionName = implode(',', $ListName);
	$_SESSION['ListName'] = $correctionName;

	// To create a list who display correctly the ages in the database (+ SESSION).
	$correctionAge = implode(',' , $ListAge);
	$_SESSION['ListAge'] = $correctionAge;







	// ************* When we press "Confirm (Confirmer)" on the validation page *************
	if (isset($_POST["nextValidation"]))
	{
		// 3 steps to calculate the total price :
		// 1) the insurance is checked or not
		// insurance price = 20€
		if ($InfoTravel->GetInsurance() == "OUI")
		{
			$priceInsurance = 20;
		}
		if($InfoTravel->GetInsurance() == "NON")
		{
			$priceInsurance = 0;
		}
		// 2) We looks the age of each people
		// until 12years old => 10€   BUT    >12years old => 15€
		$AgeLowGet = $SavingAges->GetAgeLow();
		$AgeUpGet = $SavingAges->GetAgeUp();
		$priceLow = $AgeLowGet *10;
		$priceUp = $AgeUpGet*15;

		// 3) In the end, the total price is : 
		$price = $priceLow+$priceUp+$priceInsurance;
		$_SESSION['TotalPrice']=$price;


		// *********** Saving all data in the database ***********	
		// Using INSERT INTO ... VALUES ... 	
		$reqInfoTravel = $bdd->prepare('INSERT INTO Info_Voyage(destination, assurance, nombre_voyageurs, prix, nom, age) VALUES(:destination, :assurance, :nombre_voyageurs, :prix, :nom, :age)');
		$reqInfoTravel->execute(array(
			'destination' => $InfoTravel->GetDestination(),
		    'assurance' => $InfoTravel->GetInsurance(),
		    'nombre_voyageurs' => $InfoTravel->GetNb_traveler(),
		    'prix' => $_SESSION['TotalPrice'], 
		    'nom' => $_SESSION['ListName'], 
		    'age' => $_SESSION['ListAge']
	    ));

	    session_destroy(); 
	}





	// ************* When we press "Modify (Modifier)" on the validation page *************
	if (isset($_POST["modify"]))
	{
		// The same calculations (= same explanations just before) to get the total price
		if ($InfoTravel->GetInsurance() == "OUI")
		{
			$priceInsurance = 20;
		}
		if($InfoTravel->GetInsurance() == "NON")
		{
			$priceInsurance = 0;
		}

		$AgeLowGet = $SavingAges->GetAgeLow();
		$AgeUpGet = $SavingAges->GetAgeUp();
		$priceLow = $AgeLowGet *10;
		$priceUp = $AgeUpGet*15;

		$price = $priceLow+$priceUp+$priceInsurance;
		$_SESSION['TotalPrice']=$price;


		// *********** Saving all modified data in the database ***********	
		// Using UPDATE ... SET ... WHERE
		$reqInfoTravel = $bdd->prepare('UPDATE `Info_Voyage` SET `destination`=:destination,`assurance`=:assurance,`nombre_voyageurs`=:nombre_voyageurs,`prix`=:prix,`nom`=:nom,`age`=:age WHERE ID=:ID');
		$reqInfoTravel->execute(array(
			'destination' => $InfoTravel->GetDestination(),
		    'assurance' => $InfoTravel->GetInsurance(),
		    'nombre_voyageurs' => $InfoTravel->GetNb_traveler(),
		    'prix' => $_SESSION['TotalPrice'], 
		    'nom' => $_SESSION['ListName'], 
		    'age' => $_SESSION['ListAge'],
		    'ID' => $_SESSION['IDVoyage'],
	    ));

	    session_destroy(); 
	}





	// ************* When we press "See the reservation list (Voir la liste des réservations)" on the confirmation page *************
	if (isset($_POST['nextConfirmation']))
	{
		// To select all fields from each table (+ SESSION) 
		$ListInfoTraveler = $bdd->query("SELECT * FROM `Info_Voyage`");
		$ListInfoTravel = $bdd->query("SELECT * FROM `Info_Voyage`");

		$_SESSION['ListInfoTraveler'] = $ListInfoTraveler;
		$_SESSION['ListInfoTravel'] = $ListInfoTravel;
	}





//**************************************************** To go back ****************************************************
//**********************("Return to the previous page", "cancel the reservation", "Back to home page")***********************

	// If we wish to cancel a reservation (from any page) 
	if (isset($_POST["backcancel"]))
	{
		echo "<h6>ATTENTION : En annulant votre réservation, vous allez perdre toutes les données déjà entrées précédemment ! Êtes-vous certain d'annuler ? </br>-> Si oui, cliquez sur <em>'Annuler la réservation'</em>.</br> -> Sinon, cliquez sur <em>'Etape suivante'</em>.<h6>";
	}

	
//**************************************************** To know which page to open ****************************************************
//********************************************************** Using switch() **********************************************************
	
	if (isset($_GET['page']))
	{
		$page = $_GET['page'];
	}
	// Initially, we launch the reservation page
	else
	{
		$page = 'reservation';
	}
	
	// with the value of the $_GET['page'] -> each switch 
	switch($page)
	{	
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

		case 'list':
			include ('View_ListeReservation.php');
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
- pas oublier la protection avec htmlspecialchars -> Ok
- protection pour entrer des nombres entiers -> Ok
- Donner un max pour les champs d'entrée de type number -> Ok
- Pour les prix, vérifier avec l'age limite (12 ans) -> Ok
- Problème affichage (encadré en-dessous) sur la page calidation -> Ok
- Faire en sorte que le bouton "Confirmer" sur la page de validation n'apparaisse plus quand on modifie une réservation -> Ok
- Possibilité de revenir en arrière et que la case soit coché ou non selon ce qu'on avait fait avant -> Ok
- problème d'affichage (présence ligne discontinue) quand on souhaite annuler une réservation (page View_Reservation.php) -> Pas nécessaire de corriger ! -> Ok

- Régler les problèmes avec le CSS -> à priori Ok -> Vérifier sur un autre ordi !