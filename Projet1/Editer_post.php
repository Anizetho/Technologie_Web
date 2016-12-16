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

$EditVoyage = $bdd->prepare('SELECT * FROM Info_Voyage WHERE ID=:IDVoyage');
$EditVoyage->execute(array('IDVoyage' => $_SESSION['IDVoyage']));
while ($donnees = $EditVoyage->fetch())
{
    $tableauAges = explode(',' , $donnees['age']);
    $tableauNoms = explode(',' , $donnees['nom']);

    $_SESSION['destination'] = $donnees['destination'];
    $_SESSION['nb_traveler'] = $donnees['nombre_voyageurs'];
    $_SESSION['insurance'] = $donnees['assurance'];

	for($n=0 ; $n<count($tableauAges) ; $n++)
    {
        $_SESSION['name'.$n]=$tableauNoms[$n];
        $_SESSION['age'.$n]=$tableauAges[$n];
    }
}

// To redirect on the reservation
header('Location: Controller.php?page=reservation');

?>