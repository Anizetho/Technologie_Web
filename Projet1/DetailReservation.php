<!-- DetailReservation.php --> 
<!-- Author : Thomas Anizet --> 

<?php 
session_start();

$_SESSION['destination'] = $_POST['destination'];
$_SESSION['nb_travelers'] = $_POST['nb_travelers'];
$_SESSION['insurance'] = $_POST['insurance'];
?>

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
				margin : 10px 0;
			}
		</style>
	</head>

	<body>
		<h1>
				RESERVATION </br>
		</h1>
		
		
		<table>
		
			<form method="post" action="Traitement.php">
			<input type="hidden" name="destination" value=<?php echo $_SESSION['destination']; ?> /> 
			<input type="hidden" name="nb_travelers" value=<?php echo $_SESSION['nb_travelers']; ?> /> 
			<input type="hidden" name="insurance" value=<?php echo $_SESSION['insurance']; ?> /> 

			<td> Nom </td>
			<td> <input type='text' name='name' /></td></tr>
			<td> Age </td>
			<td> <input type='number' min='0' name='age'/> </td></tr>
			<td> <input type='submit' value='Etape suivante' name='submit'> </td>
			</form>

			<form method='post' action="Reservation.html">
				<td> <input type='submit' value='Retour à la page précédente'> </td>
				<td> <input type='submit' value='Annuler'> </td></tr>
			</form>		
			
		</table>
	</body>
</html>