<!-- Traitement.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Titre</title>
		<style>
			h1 
			{
				font-family: "Tahoma";
				text-align: center;
				font-size: 40px;
				font-weight: bold;
			}

			table
			{
				font-family: "Tahoma";
				text-align: left;
				font-size: 16px;
				border-width: 1px; 
				border-style: solid;
				border-spacing: 15px 10px;
			}
		</style>
	</head>

	<body>
		<h1>
				VALIDATION DES RESERVATIONS </br>
		</h1>
		
		<table>
			<td> Nom : </td> 
			<td> <?php echo $_POST['name']; ?> </td></tr>
			<td> Age : </td>
			<td> <?php echo $_POST['age']; ?> </td></tr>
			<td> Destination : </td>
			<td> <?php echo $_POST['destination']; ?> </td></tr>
			<td> Nombre de places : </td>
			<td> <?php echo $_POST['nb_travelers']; ?> </td></tr>
			<td> Assurance : </td>
			<td> <?php echo $_POST['insurance']; ?> </td></tr>
		</table>

		<form method='post' action="ConfirmationReservations.php">
			<td> <input type='submit' value='Confirmer'> </td>
			<td> <input type='submit' value='Retour à la page précédente'> </td>
			<td> <input type='submit' value='Annuler la réservation'> </td>
			</tr>
		</form>		
		
		<p><a href="Reservation.html"> clique ici</a> </p>
	</body>
</html>