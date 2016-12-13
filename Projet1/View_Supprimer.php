<!-- Supprimer.class.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Reservation</title>
        <link rel="stylesheet" href="StyleNew.css" />
	</head>

	<body>
		<h1>
				SUPPRIMER </br>
		</h1>

		<p> Pour éviter toute mauvaise manipulation et ainsi éviter des pertes, non voulues, de certaines données enregistrées, </br>
		veuillez indiquer l'ID de réservation du voyage : </p>
		
		<nav>
		<table>
			<form action="Supprimer_post.php?page=delete" method="post">
				<tr><td> ID de voyage : </td>
				<td><input type='number' min='0' name='IDVoyage' value='' required /></td></tr>
		</table>
			<input type='submit'  value='Supprimer' >
			</form>
		</nav>

		<form action='Controller.php?page=liste' method='post'>
			<div class='input'><input type='submit' value='Retourner à la liste des réservations' name='nextConfirmation'></div>
		<form>

	</body>
</html>
