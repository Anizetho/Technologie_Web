<!-- Traitement.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Titre</title>
	</head>

	<body>
		<h1>
				VALIDATION DES RESERVATIONS </br>
		</h1>

		<p> Nom : <?php echo $_POST['name']; ?> </p>
		<p> Age : <?php echo $_POST['age']; ?> </p>
		<p> Destination : <?php echo $_POST['destination']; ?> </p>
		<p> Nombre de places : <?php echo $_POST['nb_travelers']; ?> </p>
		<p> Assurance : <?php echo $_POST['insurance']; ?> </p>
		

		 
		<p><a href="Reservation.html"> clique ici</a> </p>
	</body>
</html>