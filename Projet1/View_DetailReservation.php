<!-- View_DetailReservation.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Suite Réservation</title>
        <link rel="stylesheet" href="Style.css" />
	</head>

	<body>
		<h1>
				DETAIL DES RESERVATIONS </br>
		</h1>
		<div class="news">
		<?php
			for($i = 0; $i < $Info->GetNb_traveler() ; $i++)
			{	
				$p = $i+1;
				$name = $_SESSION["BackName"][$i];
				$age = $_SESSION["BackAge"][$i];
				
				echo "Passager n°" . $p . " : " . "</br><table>
				<tr><td> Nom : </td>
				<td><input type='text' name='name[" . $i . "]'/></td></tr>
				<tr><td> Age : </td>
				<td><input type='text' name='age[" . $i . "]'/></td></tr></table>";
			}
		?>
		</div>
		<table>
			<tr>
			<td><form method='post' action='Controller.php?page=validation'>
				<input type='submit' value='Etape suivante' name='nextDetails' />
			</form></td>
			<td><form method='post' action='Controller.php?page=reservation' \>
				<input type='submit' value='Retour à la page précédente' name='backDetails' />
			</form></td>
			<td><form method='post' action='Controller.php?page=cancel'>
				<input type='submit' value='Annuler' name='cancel' />
			</form></td></tr>
		</table>
	</body>
</html>