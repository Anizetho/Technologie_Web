<!-- View_Reservation.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<CENTER>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Reservation</title>
        <link rel="stylesheet" href="StyleAll.css" />
	</head>

	<body>
		<h1>
				RESERVATION </br>
		</h1>

		<h4>Le prix de la place est de 10 euros jusqu'à 12 ans et ensuite de 15 euros.</br></br>
		Le prix de l'assurance annulation est de 20 euros quelque soit le nombre de voyageurs.</h4>

		<div class="news">
		<table>
			<form action="Controller.php?page=details" method="post">
				<tr><td><div class="write"> Destination : </div></td>
				<td><input type='text' name='destination' placeholder='Exemple : Brésil,...' value='<?php if(isset($InfoTravel)){echo $InfoTravel->GetDestination();}?>' required /></td></tr>
				
				<tr><td><div class="write"> Nombre de places : </div></td>
				<td><input type='number' min='1' max='10' name='nb_traveler' value='<?php if(isset($InfoTravel)){echo $InfoTravel->GetNb_traveler();}?>' required /></td></tr>
				
				<tr><td><div class="write"> Assurance annulation : </div></td>
				<td><input type='checkbox' name='insurance' <?php if(isset($InfoTravel)){echo $check;} ?> /></td></tr>
		</table>
		</div>
		<table>
				<tr><td align="center"><input type='submit' name='nextReservation' value='Etape suivante' > </td>
			</form>
			
			<form action='Controller.php?page=cancel' method='post'>
				<td align="center"> <input type='submit' name='cancel' value='Annuler la réservation' > </td></tr>
			</form>
		</table>
		<?php 
			if(isset($_SESSION['modify'])) 
			{?>
				<font color="green"><h5><em>Vous êtes en train de modifier votre réservation...</em></h5></font>
				<?php
			} 
		?>
	</body>
</html>
</CENTER>
