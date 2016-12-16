<!-- View_ConfirmationReservation.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Confirmation</title>
        <link rel="stylesheet" href="StyleNew.css" />
	</head>

	<body>
		<h1>
				CONFIRMATION DES RESERVATIONS </br>
		</h1>
		
		<p> Votre demande a bien été enregistrée. </p>
		<p>	Merci de bien verser la somme de <?php echo "<strong>" . $_SESSION['TotalPrice'] . "</strong>"; ?> euros sur le compte 000-000000-00</p>
		
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
