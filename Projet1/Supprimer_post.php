<?php
session_start(); // On démarre la session AVANT toute chose

// Effectuer ici la requête qui insère le message
// On déclare comme variables superglobales, les données entrées... 
//... dans le formulaire page précédente 
$_SESSION['IDVoyage'] = $_POST['IDVoyage'];

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



// Puis rediriger vers la list des réservations comme ceci :
header('Location: Controller.php?page=liste');

?>