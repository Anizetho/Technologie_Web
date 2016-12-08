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
		veuillez entrer les champs suivants : </p>
		
		<nav>
		<table>
			<form action="Supprimer_post.php?page=delete" method="post">
				1) Dans un premier temps, supprimer votre voyage en indiquant le numéro de voyage !
				<tr><td> Numéro de voyage : </td>
				<td><input type='number' name='IDVoyage' value='' required /></td></tr>
		</table>
			<input type='submit'  value='Supprimer' >
			</form>
		</nav>

		<section>
		<table>
			<form action="Supprimer_post.php?page=delete" method="post">
				2) Ensuite, supprimer chaque voyageur en indiquant à chaque fois le numéro de voyageur!
				<tr><td> Numéro de voyageur : </td>
				<td><input type='number' name='IDVoyageur' value='' required /></td></tr>
		</table>
			<input type='submit'  value='Supprimer' >
			</form>
		</section>

		<form action='Controller.php?page=liste' method='post'>
			<div class='input'><input type='submit' value='Retourner à la liste des réservations' name='nextConfirmation'></div>
		<form></td></tr></table>

	</body>
</html>
