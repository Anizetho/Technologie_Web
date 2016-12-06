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
				<td> " . $Info->GetDestination() . "</td></tr>
				<tr><td> Nombre de places : </td>
				<td> " . $Info->GetNb_traveler() . "</td></tr>" . 
				for($i=0 ; $i < $Info->GetNb_traveler();$i++)
				{	
					$n = $i +1;
					$format = '<p>Participant %d : %s _ %d ans </p>';
					echo sprintf($format, $n, $pers[$i]->get_name(),  $pers[$i]->get_age());
				} . 
				"<tr><td> Assurance annulation : </td>
				<td> " . $Info->GetInsurance() . "</td></tr></table>";
			?>
		</div>

		<table><tr>
		<form method='post' action="Controller.php?page=confirmation">
			<td> <input type='submit' value='Confirmer'> </td>
		</form>
		<form method='post' action="controller.php?page=View_Reservation">
			<td> <input type='submit' value='Retour à la page précédente'> </td>
		</form>
		<form method='post' action='controller.php?page=cancel'>
			<td align='center'> <input type='submit' value='Annuler la réservation'></td></tr>
		</form>	
		</tr></table>
	</body>
</html>
