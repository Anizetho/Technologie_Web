<!-- View_ValidationReservation.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Validation</title>
        <link rel="stylesheet" href="Style.css" />
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
				<td> " . $InfoVoyage->GetNb_traveler() . "</td></tr>" . 
				$InfoVoyage->GetNb_traveler() . 
				"<tr><td> Assurance annulation : </td>
				<td> " . $InfoVoyage->GetInsurance() . "</td></tr></table>";
			?>
		</div>

		<table><tr>
		<form method='post' action="Controller.php?page=confirmation">
			<td> <input type='submit' value='Confirmer'> </td>
		</form>
		<form method='post' action="Controller.php?page=View_Reservation">
			<td> <input type='submit' value='Retour à la page précédente'> </td>
		</form>
		<form method='post' action='Controller.php?page=cancel'>
			<td align='center'> <input type='submit' value='Annuler la réservation'></td></tr>
		</form>	
		</tr></table>
	</body>
</html>
