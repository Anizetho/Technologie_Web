<!-- View_ValidationReservation.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<CENTER>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Validation</title>
        <link rel="stylesheet" href="StyleAll.css" />
	</head>

	<body>
		<h1>
			VALIDATION DES RESERVATIONS</br>
		</h1>
		
		<div class="news">
			<?php
			echo "<table>
				<tr><td><B><u> Destination</u> : </B></td>
				<td> " . $InfoTravel->GetDestination() . "</td></tr>
				<tr><td><B><u> Nombre de places</u> : </B></td>
				<td> " . $InfoTravel->GetNb_traveler() . "</td></tr>";

			for($i=0; $i<$InfoTravel->GetNb_traveler() ; $i++)
			{
				$p=$i+1;
				echo "<tr><td><B><u>Passager n°" . $p . "</u> :</B></tr></td> 
				<tr><td> Nom : </td>
				<td> " . $InfoTraveler[$p]->GetName() . "</td></tr>
				<tr><td> Age : </td>
				<td> " . $InfoTraveler[$p]->GetAge() . " ans</td></tr>";
			}
				
			echo"<tr><td><B><u> Assurance annulation</u> : </strong></td>
				<td> " . $InfoTravel->GetInsurance() . "</td></tr></table>";
			?>
		</div>
		<table><tr>
		<?php 
		if(isset($_SESSION['modify'])) 
		{?>
			<form method='post' action='controller.php?page=list'>
			<td align='center'><input style="background: green;" type='submit' value='Modifier' name='modify'>
			</form><?php 
		}

		if(!isset($_SESSION['modify'])) 
		{?>
		<form method='post' action="Controller.php?page=confirmation">
			<td> <input type='submit' value='Confirmer' name='nextValidation'> </td>
		</form>
		<?php
		}
		?>
		<form method='post' action="Controller.php?page=details">
			<td> <input type='submit' value='Retour à la page précédente' name='backValidation'> </td>
		</form>
		<form method='post' action='Controller.php?page=cancel'>
			<td align='center'> <input type='submit' value='Annuler la réservation' name='backcancel'></td></tr>
		</form>	
		</tr></table>
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