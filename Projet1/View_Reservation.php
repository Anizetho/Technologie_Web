<!-- View_Reservation.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Reservation</title>
        <link rel="stylesheet" href="Style.css" />
	</head>

	<body>
		<h1>
				RESERVATION </br>
		</h1>

		<p>Le prix de la place est de 10 euros jusqu'a 12 anset ensuite de 15 euros.</p>
		<p>	Le prix de l'assurance annulation est de 20 euros quelque soit le nombre de voyageurs.</p>

		<div class="news">
		<table>
			<form action="Controller.php?page=details" method="post">
				<tr><td> Destination : </td>
				<td><input type='text' name='destination' placeholder='Exemple : Brésil,...' value='<?php if(isset($InfoVoyage)){echo $InfoVoyage->GetDestination();}?>' required /></td></tr>
				
				<tr><td> Nombre de places : </td>
				<td><input type='number' min='0' name='nb_traveler' value='<?php if(isset($InfoVoyage)){echo $InfoVoyage->GetNb_traveler();}?>' required /></td></tr>
				
				<tr><td> Assurance annulation : </td>
				<td><input type='checkbox' name='insurance'/></td></tr>
		</table>
		</div>
		<table>
				<tr><td align="center"><input type='submit' name='nextReservation' value='Etape suivante' > </td>
			</form>
			
			<form action='Controller.php?page=cancel' method='post'>
				<td align="center"> <input type='submit' name='cancel' value='Annuler la réservation' > </td></tr>
			</form>
		</table>
	</body>
</html>