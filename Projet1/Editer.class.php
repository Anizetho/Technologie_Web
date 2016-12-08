<!-- Supprimer.class.php --> 
<!-- Author : Thomas Anizet --> 
<?php
session_start(); // On démarre la session AVANT toute chose
try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Reservation;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
$ListeInfoVoyage = $bdd->query("SELECT * FROM `Info_Voyage`");
$ListeInfoVoyageur = $bdd->query("SELECT * FROM `Info_Voyageur`");
$ListNombreVoyageur = $bdd->query("SELECT nombre_voyageurs FROM `Info_Voyage`");

// On fait des variables précédentes des variables de SESSION 
$_SESSION['ListeInfoVoyage'] = $ListeInfoVoyage;
$_SESSION['ListeInfoVoyageur'] = $ListeInfoVoyageur;
$_SESSION['ListNombreVoyageur'] = $ListNombreVoyageur;

// On reprend dans la table Info_voyage le nombre de voyageur inscrit pour chaque voyage et on en fait un tableau
// --> Autrement dit, la variable $listeNombre est un tableau reprenant des nombres. Ces nombres correspondent aux nombres d'inscrits pour chaque voyage différent. (Astuce : pour comprendre -> print_r($listeNombre);)
$i=0;

while($nombre = $ListNombreVoyageur->fetch())
	{
		$i = $nombre['nombre_voyageurs'];
		$listeNombre[]=$i;
		$i++;
	}

// count permet de compter le nombre d'élément du tableau 'listeNombre'.
// On fait de chaque nombre de voyageur une variable de SESSION.
for($n=0 ; $n<count($listeNombre) ; $n++)
{
	$_SESSION['nbre'.$n] = $listeNombre[$n];
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Reservation</title>
        <link rel="stylesheet" href="StyleNew.css" />
	</head>

	<body>
		<h1>
				MODIFIER </br>
		</h1>

		<p> Pour modifier des données, veuillez préciser les champs suivants : </p>

		<form action="Editer_post.php?page=delete" method="post">
		<nav>
			<strong><u>Pour modifier les infos du voyage</u></strong></br></br>
			<strong><u><em>OLD</em></u></strong></br>

			Numéro du voyage :</br>
			<input type='text' name='IDVoyage' value=''  /></br></br>
			
			<strong><u><em>NEW</em></u></strong></br>
			Nouvelle Destination : </br>
			<input type='text' name='destinationNew' value=''  /></br></br>
			
			Assurance annulation : </br>
			<input type='checkbox' name='insuranceNew' value='' /></br></br>
			
			Nombre de places : </br>
			<input type='text' min='0' name='nb_travelerNew'  /></br></br>
		</nav>

		<section>
			<strong><u>Pour modifier les infos d'un voyageur</u></strong></br></br>
			<strong><u><em>OLD</em></u></strong></br>

			Numéro du voyageur : </br>
			<input type='text' name='IDVoyageur'/></br>

			<strong><u><em>OLD</em></u></strong></br>

			Nouveau nom voyageur : </br>
			<input type='text' name='nameNew'/></br>

			Nouvel age voyageur : </br>
			<input type='text' name='ageNew'/></br></br>
		</section></br>
		<div class='input'><input type='submit'  value='Modifier' ></form></div>


		<?php
			echo "<table>";
			for($i=0; $i<count($listeNombre); $i++)
				{	
					$donneesVoyage = $ListeInfoVoyage->fetch();
					echo '<tr><td>' . $donneesVoyage['ID'] . '</td><td>' . $donneesVoyage['destination'] . '</td><td>' . $donneesVoyage['assurance'] . '</td><td>' . $donneesVoyage['prix'] . '</td><td>';
					for($n=0 ; $n<$_SESSION['nbre'.$i] ; $n++)
					{
						$p=$n+1;
						$donneesVoyageur = $ListeInfoVoyageur->fetch();
						echo $donneesVoyageur['ID']  . ' - '. $donneesVoyageur['nom'] . ' - ' . $donneesVoyageur['age'] . ' ans</br>';
					}
					echo "</td></tr>";
				}
			echo "</table>";
			?>
		
		<form action='Controller.php?page=liste' method='post'>
			<div class='input'><input type='submit' value='Retourner à la liste des réservations' name='nextConfirmation'></div>
		<form></td></tr></table>

	</body>
</html>
