<!-- View_DetailReservation.php --> 
<!-- Author : Thomas Anizet --> 
<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Suite Réservation</title>
        <link rel="stylesheet" href="StyleNew.css" />
	</head>

	<body>
		<h1>
				DETAIL DES RESERVATIONS </br>
		</h1>
		
		<div class="news">
		<table>
			<form method='post' action='Controller.php?page=validation'>
				<tr><td>

					<?php
						for ($i=0; $i < $InfoTravel->GetNb_traveler(); $i++)
						{
							$p = $i+1;
							echo "Passager n°" . $p . " : ";
						?>	
							<p> Nom : <input type='text' name='name[]' value='<?php if(isset($InfoTraveler[$p])){echo $InfoTraveler[$p]->GetName();}?>' required /></p>
							<p> Age : <input type='number' min='1' max='120' name='age[]' value='<?php if(isset($InfoTraveler[$p] )){echo $InfoTraveler[$p]->GetAge();}?>' required /></p>
						<?php
						}

					?>			
			</td></tr>
		</table>
		</div>
		<table>
			<tr><td align="center"><input type='submit' value='Etape suivante' name='nextDetails' /></td>
			</form>

			<form method='post' action='Controller.php?page=reservation' \>
				<td align="center"><input type='submit' value='Retour à la page précédente' name='backDetails' /></td>
			</form>

			<form method='post' action='Controller.php?page=cancel'>
				<td align="center"><input type='submit' value='Annuler' name='backcancel' /></td></tr>
			</form>

		</table>
		<?php 
			if(isset($_SESSION['modify'])) 
			{?>
				<font color="green"><h5><em>Vous êtes en train de modifier votre réservation...</em></h5></font> <?php
			} 
		?>
	</body>
</html>
