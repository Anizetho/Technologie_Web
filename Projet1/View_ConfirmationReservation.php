<!-- View_ConfirmationReservation.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<CENTER>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Confirmation</title>
        <link rel="stylesheet" href="StyleAll.css" />
	</head>

	<body>
		<h1>
				CONFIRMATION DES RESERVATIONS</br>
		</h1>
		
		<div class="write"><div class="box"> Votre demande a bien été enregistrée. </br>
			Merci de bien verser la somme de <?php echo "<strong>" . $_SESSION['TotalPrice'] . "</strong>"; ?> euros sur le compte <strong>000-000000-00</strong></div></div>
		
		<table>
		<tr>
		<form method='post' action="Controller.php?page=reservation">
			<td> <input type='submit' value="Retour à la page d'acceuil"> </td>
		</form>	

		<form method='post' action="Controller.php?page=list">
			<td> <input type='submit' value="Voir la liste des réservations" name='nextConfirmation'> </td>
		</form>		
		</tr>
		</table>
		
	</body>
</html>
</CENTER>