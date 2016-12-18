<?php
session_start(); 
$_SESSION['IDVoyage'] = $_POST['IDVoyage'];

try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Reservation;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

// To go into the database to delete the info with the corresponding ID
$TravelUp = $bdd->prepare('DELETE FROM `Info_Voyage` WHERE ID=:IDVoyage');
$TravelUp->execute(array(
    'IDVoyage' => $_SESSION['IDVoyage']
    ));



// To redirect on the list of the reservations
header('Location: Controller.php?page=list');

?>