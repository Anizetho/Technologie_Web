<!-- View_Supprimer.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Delete reservation</title>
        <link rel="stylesheet" href="StyleDelete.css" />
	</head>

	<body>

		<h1>
				SUPPRIMER UNE RESERVATION</br>
		</h1>
		<div class="news">
		Pour éviter toute mauvaise manipulation et ainsi éviter des pertes, non voulues, de certaines données enregistrées,
		veuillez indiquer l'ID de réservation du voyage : </br></br>
		
		
		<table>
			<form action="Delete_post.php?page=delete" method="post">
				<tr><td> ID de voyage : </td>
				<td><input type='number' min='0' max='100000' name='IDVoyage' value='' required /></td></tr>
		</table>
			<input type='submit'  value='Supprimer' >
			</form>
		</div>

		<form action='Controller.php?page=list' method='post'>
			<input type='submit' value='Retourner à la liste des réservations' name='nextConfirmation'>
		<form>

	</body>
</html>
