<?php
session_start();
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

// INSERT INTO `test`( `destination`, `nom-age`) VALUES ('Espagne', 'Antoine - 20 ans, Pierre - 30 ans')

// INSERT INTO `test`(`destination`, `voyageur`) VALUES ('Espagne', 'Emile - 20 ans, Valentin - 30 ans, Amo - 40 ans')
/*$reponse = $bdd->query('SELECT * FROM test');
while ($donnees = $reponse->fetch())
{
    echo '</br>' . $donnees['destination'] . '</br>' . $donnees['voyageur'] . '</br>';
}
*/
/*
$Noms = 'Pierre, Antoine, Mahoudeau';
$Ages = '21, 22, 30';
$tableauNoms = explode(',' , $Noms);
$tableauAges = explode(',' , $Ages);
print_r($tableauNoms);
echo '</br>';
print_r($tableauNoms[1]);
echo '</br>';
print_r($tableauAges);
echo '</br>';
print_r($tableauAges[1]);
echo '</br>';
//echo count($tableauAges);
*/



// ********************************* AFFICHAGE NOM-AGE (sans calculer nbre voyageurs) *******************************************
// ******************************************************************************************************************************
$ListeInfoVoyageur = $bdd->query("SELECT * FROM `test`");
$_SESSION['ListeInfoVoyageur'] = $ListeInfoVoyageur;
while ($donnees = $ListeInfoVoyageur->fetch())
{
    $tableauAges = explode(',' , $donnees['Age']);
    $tableauNoms = explode(',' , $donnees['Nom']);
    /*echo $i . ') '; 
    print_r($tableauAges);
    echo '</br>';
    echo count($tableauAges) . '</br>' ;*/
    for($n=0 ; $n<count($tableauAges) ; $n++)
    {
        $p=$n+1;
        echo $donnees['ID'] . '] '. $tableauNoms[$n] . ' - ' . $tableauAges[$n] . ' ans</br>';
    }
    echo '</br>';
}


echo '</br>';
$testImplode=["Je suis", "pas là", 'pour le moment.'];
$testExplode="Je suis pas là pour le moment.";
echo implode ( ' ', $testImplode );
print_r(explode ( ' ', $testExplode ));

// explode() --> Permet d'exploser une string en plusieurs parties --> On indique le 'caractère' qui servira de repère pour exploser les différentes parties
// Implode() --> Permet de rassembler plusieurs parties pour former une string --> On indique le 'caractère' qui permettra de rassembler les différentes parties



/*echo '</br>';
// echo implode ( ' </br> ', $tableau );


$rep = $bdd->query('SELECT * FROM test');
while ($donne = $rep->fetch())
{
    echo $donne['Nom'] . '</br>';
    foreach($donne['Nom'] as $nom)
    {
        echo $nom . '</br>'; // affichera $prenoms[0], $prenoms[1] etc.
    }
}


//while ($donne = $rep->fetch())
//{
//    echo $donne['Nom'] . ' ' . $donne['Age'] . ' et </br>' ;
//}
*/
?>