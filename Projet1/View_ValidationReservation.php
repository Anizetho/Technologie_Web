<!-- View_ValidationReservation.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Validation</title>
        <link rel="stylesheet" href="StyleNew.css" />
	</head>

	<body>
		<h1>
				VALIDATION DES RESERVATIONS </br>
		</h1>
		<div class="news">
			<?php
			echo "<table>
				<tr><td> Destination : </td>
				<td> " . $InfoVoyage->GetDestination() . "</td></tr>
				<tr><td> Nombre de places : </td>
				<td> " . $InfoVoyage->GetNb_traveler() . "</td></tr>";

			for($i=0; $i<$InfoVoyage->GetNb_traveler() ; $i++)
			{
				$p=$i+1;
				echo "<tr><td>Passager n°" . $p . " :</tr></td> 
				<tr><td> Nom : </td>
				<td> " . $InfoVoyageur[$p]->GetName() . "</td></tr>
				<tr><td> Age : </td>
				<td> " . $InfoVoyageur[$p]->GetAge() . "</td></tr>";
			}
				
			echo"<tr><td> Assurance annulation : </td>
				<td> " . $InfoVoyage->GetInsurance() . "</td></tr></table>";
			?>
		</div>

		<table><tr>
		<form method='post' action="Controller.php?page=confirmation">
			<td> <input type='submit' value='Confirmer' name='nextValidation'> </td>
		</form>
		<form method='post' action="Controller.php?page=details">
			<td> <input type='submit' value='Retour à la page précédente' name='backValidation'> </td>
		</form>
		<form method='post' action='Controller.php?page=cancel'>
			<td align='center'> <input type='submit' value='Annuler la réservation' name='backcancel'></td></tr>
		</form>	
		</tr></table>
	</body>
</html>
