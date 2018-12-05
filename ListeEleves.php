<?php
DECLARE(strict_types=1);
require_once("PDOConnect.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="style.css" />

</head>
<body>
<main>
    <form id="formList" method="post" action="SelectedItem.php">
<table>
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Date de Naissance</th>
        <th>Classe</th
    </tr>
<?php
        try{
        $pdo = new \PDO('mysql:host=localhost;dbname=inscriptionScolaire;port=3306;charset=utf8','root','');
        $answer = $pdo->query("SELECT idEleve,nom,prenom,dateNaissance,libelle FROM ELEVE JOIN anneeEtude 
        ON anneeEtude = idAnneeEtude ORDER BY idEleve DESC");
        $i =0;
        $data = $answer->fetchAll();
        foreach($data as $line)
            {
                $test1 = $line['idEleve'];
                echo '<tr id="idEleve" name="idEleve" onclick="myFunction()"><td>'.
                    $line['nom'].'</td><td>'. $line['prenom'].'</td><td>'. $line['dateNaissance'].
                    '</td><td>'. $line['libelle'].'</td><td>'?>
    <a href="SelectedItem.php?name='<?php echo $test1 ?>'"><img src="image/loupe2.png" alt="loupe"></a>
    <?php '</td></tr>';

    }
        }catch(\PDOException $e) {
            echo $e->getMessage();
        }catch(Exception $e){
            echo $e->getMessage();
        }
?>
        </table>
    </form>
</main>
</body>
</html>
