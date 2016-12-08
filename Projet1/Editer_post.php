<?php
session_start(); // On démarre la session AVANT toute chose

// Effectuer ici la requête qui insère le message
// On déclare comme variables superglobales, les données entrées... 
//... dans le formulaire page précédente 
$_SESSION['IDVoyage'] = $_POST['IDVoyage'];
$_SESSION['destinationNew']=$_POST['destinationNew'];
$_SESSION['insuranceNew']=$_POST['insuranceNew'];
$_SESSION['nb_travelerNew']=$_POST['nb_travelerNew'];

$_SESSION['IDVoyageur']=$_POST['IDVoyageur'];
$_SESSION['nameNew']=$_POST['nameNew'];
$_SESSION['ageNew']=$_POST['ageNew'];

try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Reservation;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

if(isset($_POST['insuranceNew']))
    {
        $_SESSION['insuranceNew'] = 'OUI';
    }
// Si on ne l'a pas cochée
else
    {
        $_SESSION['insuranceNew'] = 'NON';
    }


$EditVoyage = $bdd->prepare('UPDATE `Info_Voyage` SET `destination`=:destinationNew,`assurance`=:insuranceNew,`nombre_voyageurs`=:nb_travelerNew WHERE ID=:IDVoyage');
$EditVoyage->execute(array(
    'destinationNew' => $_SESSION['destinationNew'],
    'insuranceNew' => $_SESSION['insuranceNew'],
    'nb_travelerNew' => $_SESSION['nb_travelerNew'],
    'IDVoyage' => $_SESSION['IDVoyage']
    ));

$EditVoyageur = $bdd->prepare('UPDATE `Info_Voyageur` SET `nom`=:nameNew,`age`=:ageNew WHERE ID=:IDVoyageur');
$EditVoyageur->execute(array(
    'nameNew' => $_SESSION['nameNew'],
    'ageNew' => $_SESSION['ageNew'],
    'IDVoyageur' => $_SESSION['IDVoyageur']
    ));


// Puis rediriger vers la list des réservations comme ceci :
if (isset($_SESSION['IDVoyage']))
{
	header('Location: Controller.php?page=liste');
}

?>

<!-- ATTENTION -> supprimer tous les noms d'un voyage et pas uniquement un seul... -->




