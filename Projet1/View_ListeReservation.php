<!-- View_Reservation.php --> 
<!-- Author : Thomas Anizet --> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Reservation</title>
        <link rel="stylesheet" href="StyleListe.css" />
	</head>

	<body>
		<h1>
				LISTE DES RESERVATIONS </br>
		</h1>

		<form action='Controller.php?page=reservation' method='post'> 
			<input type='submit' value='Ajouter une réservation'> 
		</form></br>

		
		<table>
			<tr>
				<th> ID </th>
				<th> Destination </th>
				<th> Assurance </th>
				<th> Prix Total </th>
				<th> Nom - Age </th>
				<th> Editer </th>
				<th> Supprimer </th>
			</tr>
			<tr> 
				<td> 4</td>
				<td> Esapgne</td>
				<td> Oui</td>
				<td> 85</td>
				<td> Anizet - 20 </br> Anizetbis - 18</td>
				<td> <a href='index.php'> Editer </a></td>
				<td> <a href='index.php'> Supprimer </a></td>
			</tr>
		</table>
		
	</body>
</html>
