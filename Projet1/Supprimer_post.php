<?php
session_start(); // On démarre la session AVANT toute chose

// Effectuer ici la requête qui insère le message
// On déclare comme variables superglobales, les données entrées... 
//... dans le formulaire page précédente 
$_SESSION['IDVoyage'] = $_POST['IDVoyage'];
$_SESSION['IDVoyageur'] = $_POST['IDVoyageur'];

try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Reservation;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }


$SuppVoyage = $bdd->prepare('DELETE FROM `Info_Voyage` WHERE ID=:IDVoyage');
$SuppVoyage->execute(array(
    'IDVoyage' => $_SESSION['IDVoyage']
    ));

$SuppVoyage = $bdd->prepare('DELETE FROM `Info_Voyageur` WHERE ID=:IDVoyageur');
$SuppVoyage->execute(array(
    'IDVoyageur' => $_SESSION['IDVoyageur']
    ));

// Puis rediriger vers la list des réservations comme ceci :
header('Location: Controller.php?page=liste');

?>

<!--
// Etapes : 
// 1) Compter combien il y a d'éléments dans la liste des InfoVoyageur
// 2) Ayant demandé le nom du 1er passager et l'age du 1er passager -> Sélectionner du 1er passager renseignée au dernier grâce au nb_traveler
// 3) Connaissant les noms, il faut les receuillir et les effacer de la bdd

for($i=0 ; $i<$_SESSION['nb_travelerSupp'] ; $i++)
{
	SELECT `nom`, `age` FROM `Info_Voyageur` LIMIT 3, 4
	$SuppVoyage = $bdd->prepare('DELETE FROM `Info_Voyageur` LIMIT 2, $_SESSION['nb_travelerSupp'] ');
	$SuppVoyage->execute(array(
	    'nom' => $_SESSION['nom'],
	    'age' => $_SESSION['age']
	    ));
}
-->





