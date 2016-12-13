<?php
session_start(); // On démarre la session AVANT toute chose
//include("Reservation.class.php");
//include("Detail.class.php");

// Effectuer ici la requête qui insère le message
// On déclare comme variables superglobales, les données entrées... 
//... dans le formulaire page précédente 
$_SESSION['IDVoyage'] = $_POST['IDVoyage'];
$_SESSION['modify']=true;
try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Reservation;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

$EditVoyage = $bdd->prepare('SELECT * FROM Info_Voyage WHERE ID=:IDVoyage');
$EditVoyage->execute(array('IDVoyage' => $_SESSION['IDVoyage']));
while ($donnees = $EditVoyage->fetch())
{
    $tableauAges = explode(',' , $donnees['age']);
    $tableauNoms = explode(',' , $donnees['nom']);

    $_SESSION['destination'] = $donnees['destination'];
    $_SESSION['nb_traveler'] = $donnees['nombre_voyageurs'];
    $_SESSION['insurance'] = $donnees['assurance'];
    // On rassemble ces infos dans les classes
    //$InfoVoyage = new InfoReservation($_SESSION['destination'], $_SESSION['nb_traveler'], $_SESSION['insurance']);
	//echo 'Destination : ' . $InfoVoyage->GetDestination() . ' </br> Nombre de voyageurs : ' . $InfoVoyage->GetNb_traveler() . ' </br> Assurance : ' . $InfoVoyage->GetInsurance() . '</br>' ;

	for($n=0 ; $n<count($tableauAges) ; $n++)
    {
        $_SESSION['nom'.$n]=$tableauNoms[$n];
        $_SESSION['age'.$n]=$tableauAges[$n];
    }
}

// Puis rediriger vers la list des réservations comme ceci :
header('Location: Controller.php?page=reservation');

?>