<!-- View_DetailReservation.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Suite Réservation</title>
        <link rel="stylesheet" href="Style.css" />
	</head>

	<body>
		<h1>
				DETAIL DES RESERVATIONS </br>
		</h1>

		<table><tr><td>
			<form method='post' action='Controller.php?page=validation'>
				<div class="news">
					<?php
						for ($i=0; $i < $InfoVoyage->GetNb_traveler(); $i++)
						{
							$p = $i+1;
							echo "Passager n°" . $p . " : ";
						?>	
							<p> Nom : <input type='text' name='nom[]' value='<?php if(isset($InfoVoyageur[$p])){echo $InfoVoyageur[1]->GetName();}?>'/></p>
							<p> Age : <input type='text' name='age[]' value='<?php if(isset($InfoVoyageur[$p] )){echo $InfoVoyageur[$p]->GetAge();}?>'/></p>
						<?php
						}
					?>			
				</div>
				<input type='submit' value='Etape suivante' name='nextDetails' />
			</form></td>


			<td><form method='post' action='Controller.php?page=reservation' \>
				<input type='submit' value='Retour à la page précédente' name='backDetails' />
			</form></td>
			<td><form method='post' action='Controller.php?page=cancel'>
				<input type='submit' value='Annuler' name='cancel' />
			</form></td></tr>
		</table>
	</body>
</html>