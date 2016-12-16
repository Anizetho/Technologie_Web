<!-- View_Editer.php --> 
<!-- Author : Thomas Anizet --> 
<?php
include("Reservation.class.php");
include("Detail.class.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Edit reservation</title>
        <link rel="stylesheet" href="StyleNew.css" />
	</head>

	<body>
		<h1>
				SUPPRIMER </br>
		</h1>

		<p> Veuillez indiquer l'ID du voyage à modifier : </p>
		
		<nav>
		<table>
			<form action="Editer_post.php" method="post">
				<tr><td> ID de voyage : </td>
				<td><input type='number' min='0' max='100000' name='IDVoyage' value='' required /></td></tr>
		</table>
			<input type='submit'  value='Modifier' >
			</form>
		</nav>

		<form action='Controller.php?page=list' method='post'>
			<div class='input'><input type='submit' value='Retourner à la liste des réservations' name='nextConfirmation'></div>
		<form>

	</body>
</html>
