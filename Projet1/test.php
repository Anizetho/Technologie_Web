<?php
try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Reservation;charset=utf8', 'root', 'root');
    }
catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

// 1) Définir comme variable $ID, l'ID de la dernière info (nom/date) ajoutée dans la base de donnée. Pour ce faire : 
	// A) On compte le nombre d'entrées dans la table (SELECT COUNT(*) AS nbentrées FROM Info_Voyageur)
	// B) On sélectionne l'ID de la dernière entrée (SELECT max(Id) FROM Info_Voyageur)
	// C) 
// 2) Retirer le nombre de voyageur à cet ID ($IDNEW = $ID-InfoVoyage->GetNb_Traveler();)
// 3) Selectionner les infos à partir de ce nouvel ID ($IDNEW) et jusqu'au dernier ID ajouté ($ID) (SELECT `nom`, `age` FROM `Info_Voyageur` LIMIT $IDNEW, $ID)
echo "Sur bonne page ?";

$reponse = $bdd->query("SELECT ID, max(ID) as maximum FROM Info_Voyageur");
while($donnees = $reponse->fetch())
{
	echo '<p>' . $donnees['maximum'] . '</p>';
}
echo $reponse;


?>