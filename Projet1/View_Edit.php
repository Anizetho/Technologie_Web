<!-- View_Editer.php --> 
<!-- Author : Thomas Anizet --> 
<?php
include("Reservation.class.php");
include("Detail.class.php");
?>
<!DOCTYPE html>
<CENTER>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Edit reservation</title>
        <link rel="stylesheet" href="StyleAll.css" />
	</head>

	<body>
		<h1>
				MODIFIER UNE RESERVATION</br>
		</h1>

		<p> Veuillez indiquer l'ID du voyage à modifier : </p>
		
		<div class="news">
		<table>
			<form action="Edit_post.php" method="post">
				<tr><td> ID de voyage : </td>
				<td><input type='number' min='0' max='100000' name='IDVoyage' value='' required /></td><td><input type='submit'  value='Modifier' ></form></td></tr>
		</table>
		</div>

		<form action='Controller.php?page=list' method='post'>
			<input type='submit' value='Retourner à la liste des réservations' name='nextConfirmation'>
		<form>

	</body>
</html>
</CENTER>