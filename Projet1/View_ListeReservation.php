<!-- View_ListeReservation.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Reservation list</title>
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
				// *********************************************** Display NAME-AGE ****************************************************
				// *********************************************************************************************************************
				if(isset($_SESSION['ListInfoTraveler']))
				{
					while ($donnees = $_SESSION['ListInfoTraveler']->fetch())
					{
					    $tableauAges = explode(',' , $donnees['age']);
					    $tableauNoms = explode(',' , $donnees['nom']);
					    $donneesVoyage = $ListInfoTravel->fetch();
						echo '<tr><td>' . $donneesVoyage['ID'] . '</td><td>' . $donneesVoyage['destination'] . '</td><td>' . $donneesVoyage['assurance'] . '</td><td>' . $donneesVoyage['prix'] . '</td><td>';
					    for($n=0 ; $n<count($tableauAges) ; $n++)
					    {
					        $p=$n+1;
					        echo $tableauNoms[$n] . ' - ' . $tableauAges[$n] . ' ans</br>';
					    }
					    echo "</td><td> <a href='View_Editer.php'> Editer n°" . $donneesVoyage['ID'] . "</a></td>
						<td> <a href='View_Supprimer.php'> Supprimer </a></td>
						</tr>";
					}
				}
				//**********************************************************************************************************************
			?>
		</table>	

		<form action='Controller.php?page=list' method='post'> 
			<input type='submit' value='Rafraîchir la page' name='nextConfirmation'> (Veuillez cliquer sur le bouton <em>"Rafaîchir la page"</em> si rien ne s'affiche) 
		</form>	
	</body>
</html>
