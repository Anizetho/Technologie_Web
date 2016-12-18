<?php
session_start(); 
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

// To go into the database to select the info with the corresponding ID
// Those info will be entered in the creation page (View_Reservation.php)
$EditTravel = $bdd->prepare('SELECT * FROM Info_Voyage WHERE ID=:IDVoyage');
$EditTravel->execute(array('IDVoyage' => $_SESSION['IDVoyage']));
while ($data = $EditTravel->fetch())
{
    $tableAges = explode(',' , $data['age']);
    $tableNames = explode(',' , $data['nom']);

    $_SESSION['destination'] = $data['destination'];
    $_SESSION['nb_traveler'] = $data['nombre_voyageurs'];
    $_SESSION['insurance'] = $data['assurance'];

	for($n=0 ; $n<count($tableAges) ; $n++)
    {
        $_SESSION['name'.$n]=$tableNames[$n];
        $_SESSION['age'.$n]=$tableAges[$n];
    }
}
$_SESSION['checkNextReservation'] = TRUE;
$_SESSION['checkNextDetails'] = TRUE;

// To redirect on the reservation
header('Location: Controller.php?page=reservation');

?>