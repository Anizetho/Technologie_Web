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
            $bdd = new PDO('mysql:host=localhost;dbname=Reservation;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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
	
	// On rassemble ces infos (destination, nombre de voyageurs, assurance) avec les classes
	$InfoVoyage = new InfoReservation($_SESSION['destination'], $_SESSION['nb_traveler'], $_SESSION['insurance']);






	// ************* Quand on appuye sur "Etape suivante" DEPUIS la page détail (pour aller vers validation) *************
	if (isset($_POST["nextDetails"]))
	{
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

		// On crée des variables de SESSION pour transmettre plus facilement les informations
		$_SESSION['AgeInf']=$AgeInf;
		$_SESSION['AgeSupp']=$AgeSupp;
		$SauvegardeAges = new SaveAge($_SESSION['AgeInf'], $_SESSION['AgeSupp']);
	}

	// 1) On rassemble les infos (nom, age) avec les classes
	// 2) On crée 2 listes : Une avec tous les noms ; une autre avec tous les ages
	for($i=0; $i<$InfoVoyage->GetNb_traveler(); $i++)
		{
			$p=$i+1;
			// Remarque : cette info porte le n° du passager (on commence à 1, pas 0)
		    $InfoVoyageur[$p] = new Traveler($_SESSION['nom'.$i], $_SESSION['age'.$i]);

		    // Pour calculer le prix total
		    if($_SESSION['age'.$i]<13)
			{
				$AgeInf+=1;
			}
			else
			{
				$AgeSupp+=1;
			}

		    // On ajoute chaque age et chaque nom dans une liste (pour la bdd)
		    $ListeNom[] = $InfoVoyageur[$p]->GetName();
			$ListeAge[] = $InfoVoyageur[$p]->GetAge();
		}
	// On crée des variables de session pour transmettre plus facilement les informations
	$_SESSION['AgeInf']=$AgeInf;
	$_SESSION['AgeSupp']=$AgeSupp;
	//On rassemble les infos (AgeInf, AgeSupp) avec les classes
	$SauvegardeAges = new SaveAge($_SESSION['AgeInf'], $_SESSION['AgeSupp']);

	// On crée une 'liste' permettant d'afficher CORRECTEMENT les noms dans la bdd et on en fait une variable de session
	$correctionNom = implode(',', $ListeNom);
	$_SESSION['ListeNom'] = $correctionNom;

	// On crée une 'liste' permettant d'afficher CORRECTEMENT les ages dans la bdd et on en fait une variable de session
	$correctionAge = implode(',' , $ListeAge);
	$_SESSION['ListeAge'] = $correctionAge;







	// ************* Quand on appuye sur "Confirmer" DEPUIS la page Validation (pour aller vers confirmation) *************
	if (isset($_POST["nextValidation"]))
	{
		// On va calculer le prix total du voyage :
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


		// *********** ENREGISTREMENT DES INFOS DANS LA BASE DE DONNEE ***********		

		// On enregistre la destination, le nombre de voyageurs, l'assurance annulation, chaque passager et chaque age de la table 'Info_voyage' de la bdd (base de donnée) et ce, dès qu'on a appuyé sur le bouton "Confirmer"
		//UPDATE `Info_Voyage` SET `ID`=98,`nom`='Pierre, Antoine',`age`='20, 21' WHERE ID=98
		$reqInfoVoyage = $bdd->prepare('INSERT INTO Info_Voyage(destination, assurance, nombre_voyageurs, prix, nom, age) VALUES(:destination, :assurance, :nombre_voyageurs, :prix, :nom, :age)');
		$reqInfoVoyage->execute(array(
			'destination' => $InfoVoyage->GetDestination(),
		    'assurance' => $InfoVoyage->GetInsurance(),
		    'nombre_voyageurs' => $InfoVoyage->GetNb_traveler(),
		    'prix' => $_SESSION['TotalPrice'], 
		    'nom' => $_SESSION['ListeNom'], 
		    'age' => $_SESSION['ListeAge']
	    ));

	    session_destroy(); // pas oublier !!!
	}





	// ************* Quand on appuye sur "Modifier" DEPUIS la page Validation (pour aller vers confirmation) *************
	if (isset($_POST["modify"]))
	{
		// On va calculer le prix total du voyage :
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


		// *********** ENREGISTREMENT DES INFOS MODIFIEES DANS LA BASE DE DONNEE ***********		

		// On modifie (update) la bdd et ce, dès qu'on a appuyé sur le bouton "Modifier"
		$reqInfoVoyage = $bdd->prepare('UPDATE `Info_Voyage` SET `destination`=:destination,`assurance`=:assurance,`nombre_voyageurs`=:nombre_voyageurs,`prix`=:prix,`nom`=:nom,`age`=:age WHERE ID=:ID');
		$reqInfoVoyage->execute(array(
			'destination' => $InfoVoyage->GetDestination(),
		    'assurance' => $InfoVoyage->GetInsurance(),
		    'nombre_voyageurs' => $InfoVoyage->GetNb_traveler(),
		    'prix' => $_SESSION['TotalPrice'], 
		    'nom' => $_SESSION['ListeNom'], 
		    'age' => $_SESSION['ListeAge'],
		    'ID' => $_SESSION['IDVoyage'],
	    ));

	    session_destroy(); // pas oublier !!!
	}





	// ************* Quand on appuye sur "Voir la liste des réservations" DEPUIS la page Confirmation (pour aller vers liste) *************
	if (isset($_POST['nextConfirmation']))
	{
		// On sélectionne tous les champs de chaque table
		$ListeInfoVoyageur = $bdd->query("SELECT * FROM `Info_Voyage`");
		$ListeInfoVoyage = $bdd->query("SELECT * FROM `Info_Voyage`");

		// On fait de la variable précédentes une variable de SESSION 
		$_SESSION['ListeInfoVoyageur'] = $ListeInfoVoyageur;
		$_SESSION['ListeInfoVoyage'] = $ListeInfoVoyage;
	}


// 1) Définir comme variable $ID, l'ID de la dernière info (nom/date) ajoutée dans la base de donnée. Pour ce faire : 
	// A) On compte le nombre d'entrées dans la table (SELECT COUNT(*) AS nbentrées FROM Info_Voyageur)
	// B) On sélectionne l'ID de la dernière entrée (SELECT max(Id) FROM Info_Voyageur)
	// C)
// 2) Retirer le nombre de voyageur à cet ID ($IDNEW = $ID-InfoVoyage->GetNb_Traveler();)
// 3) Selectionner les infos à partir de ce nouvel ID ($IDNEW) et jusqu'au dernier ID ajouté ($ID) (SELECT `nom`, `age` FROM `Info_Voyageur` LIMIT $IDNEW, $ID)


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
	// De base, on lance la page View_Reservation.php
	else
	{
		$page = 'reservation';
	}
	
	// On regarde quelle valeur de page nous est renvoiée
	// Afin de savoir sur quelle page on doit aller
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

		case 'liste':
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
- Possibilité de revenir en arrière et que la case soit coché ou non selon ce qu'on avait fait avant ?
- pas oublier la protection avec htmlspecialchars -> Ok
- protection pour entrer des nombres entiers -> Ok
- problème d'affichage (présence ligne discontinue) quand on souhaite annuler une réservation (page View_Reservation.php)
- Donner un max pour les champs d'entrée de type number
- Pour les prix, vérifier avec l'age limite (12 ans) 
- Régler les problèmes avec le CSS


2) Demander au prof :
- Problème : faut appuyer 2 fois pour destroyer la session
-->
