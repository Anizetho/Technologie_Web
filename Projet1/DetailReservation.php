<!-- DetailReservation.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Titre</title>
	</head>

	<body>
		<h1>
				RESERVATION </br>
		</h1>
		
		
		
		<?php 
		$Destination = $_POST['destination']; 
		$nb_travelers = $_POST['nb_travelers'];
		?>
		
		<form method="POST" action="Traitement.php">
		<table>
			<td> <input type="hidden" name="destination" value="$Destination"> </td></tr>
			<td> <input type="hidden" name="nb_travelers" value="$nb_travelers"> </td></tr>
			<td> Nom </td>
			<td> <input type='text' name='name' /></td></tr>
			<td> Age </td>
			<td> <input type='number' min='0' name='age'/> </td></tr>
			<td align='center'> <input type='submit' value='Etape suivante' name='submit'> </td>
			<td align='center'> <input type='submit' value='Retour à la page précédente' name='submit'> </td>
			<td align='center'> <input type='submit' value="Annuler la réservation" name='submit'> </td></tr>			
		</table>
		</form>
	</body>
</html>