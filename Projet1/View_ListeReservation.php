<!-- View_Reservation.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Reservation</title>
        <link rel="stylesheet" href="StyleListe.css" />
	</head>

	<body>
		<h1>
				LISTE DES RESERVATIONS </br>
		</h1>

		
		<form action='Controller.php?page=reservation' method='post'> 
			<input type='submit' value='Ajouter une réservation'> 
		</form>

		<table>
			<tr>
				<th> ID </th>
				<th> Destination </th>
				<th> Assurance </th>
				<th> Prix Total </th>
				<th> N°Voyageur - Nom - Age </th>
				<th> Editer </th>
				<th> Supprimer </th>
			</tr>

			<?php
				
				// ************************************ AFFICHAGE CORRECTE DE TOUT LE TABLEAU ***************************************************
				//count permet de compter le nombre d'élément
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
					echo "</td><td> <a href='Editer.class.php'> Editer </a></td>
					<td> <a href='Supprimer.class.php'> Supprimer </a></td>
					</tr>";
				}
				// **********************************************************************************************************************
			?>

		</table>	

		<form action='Controller.php?page=liste' method='post'> 
			<input type='submit' value='Rafraîchir la page' name='nextConfirmation'> 
		</form>	
	</body>
</html>
