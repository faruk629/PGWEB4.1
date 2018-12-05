<?php
DECLARE(strict_types=1);
require_once("PDOConnect.php");
$idEleve = trim(filter_var($_GET['name'], FILTER_SANITIZE_NUMBER_INT));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>La vertu </title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <main>
            <?php
                $pdo = new \PDO('mysql:host=localhost;dbname=inscriptionScolaire;port=3306;charset=utf8','root','');
               $sqlInsert =('SELECT  eleve.nom, eleve.prenom, eleve.sexe, eleve.nRegistreNational,
 dateNaissance, rue, nrue, codePostal, ville, eleve.dateCreation, anneeEtude.libelle,tuteur.nom,
 tuteur.prenom,tuteur.sexe, tuteur.nRegistreNational, email, mobile, telephone,tuteur.dateCreation
 FROM elevehasTuteur  JOIN tuteur ON elevehasTuteur.idTuteur =tuteur.idTuteur JOIN eleve ON elevehasTuteur.idEleve = eleve.idEleve 
   JOIN anneeEtude ON idAnneeEtude = anneeEtude where eleve.idEleve = :selectedStudent;' );
             /* $sqlInsert = ("select nom, prenom, sexe, nRegistreNational,dateNaissance,rue, nrue, codePostal, ville,
                 dateCreation, libelle FROM eleve JOIN anneeEtude ON idAnneeEtude = anneeEtude where idEleve 
                 = :selectedStudent;");*/
                $pst = $pdo->prepare($sqlInsert);
                $pst->bindValue(':selectedStudent', (int)$idEleve, PDO::PARAM_INT);
                $pst->execute();
                $data =$pst->fetch();
            ?>
            <table>
                <tr class="infEleve" name="infEleve">
                    <td class="infEleveTd" name="infEleveTd" >Nom</td>
                    <td class="infEleveTd" name="infEleveTd"><?php echo $data[0] ?></td>
                </tr>
                <tr class="infEleve" name="infEleve">
                    <td class="infEleveTd" name="infEleveTd" >Prenom</td>
                    <td class="infEleveTd" name="infEleveTd"><?php echo $data[1] ?></td>
                </tr>
                <tr class="infEleve" name="infEleve">
                    <td class="infEleveTd" name="infEleveTd" >Sexe</td>
                    <td class="infEleveTd" name="infEleveTd"><?php echo $data[2] ?></td>
                </tr>
                <tr class="infEleve" name="infEleve">
                    <td class="infEleveTd" name="infEleveTd" >Numéro de registre national</td>
                    <td class="infEleveTd" name="infEleveTd"><?php echo $data[3] ?></td>
                </tr>
                <tr class="infEleve" name="infEleve">
                    <td class="infEleveTd" name="infEleveTd" >Date de naissance</td>
                    <td class="infEleveTd" name="infEleveTd"><?php echo $data[4] ?></td>
                </tr>
                <tr class="infEleve" name="infEleve">
                    <td class="infEleveTd" name="infEleveTd" >Rue</td>
                    <td class="infEleveTd" name="infEleveTd"><?php echo $data[5] ?></td>
                </tr>
                <tr class="infEleve" name="infEleve">
                    <td class="infEleveTd" name="infEleveTd" >Numéro de rue</td>
                    <td class="infEleveTd" name="infEleveTd"><?php echo $data[6] ?></td>
                </tr>
                <tr class="infEleve" name="infEleve">
                    <td class="infEleveTd" name="infEleveTd" >Code Postal</td>
                    <td class="infEleveTd" name="infEleveTd"><?php echo $data[7] ?></td>
                </tr>
                <tr class="infEleve" name="infEleve">
                    <td class="infEleveTd" name="infEleveTd" >Ville</td>
                    <td class="infEleveTd" name="infEleveTd"><?php echo $data[8] ?></td>
                </tr>
                <tr class="infEleve" name="infEleve">
                    <td class="infEleveTd" name="infEleveTd"> Classe </td>
                    <td class="infEleveTd" name="infEleveTd"><?php echo $data[10] ?></td>
                </tr>
                <tr class="infEleve" name="infEleve">
                    <td class="infEleveTd" name="infEleveTd" >Date d'inscription</td>
                    <td class="infEleveTd" name="infEleveTd"><?php echo $data[9] ?></td>
                </tr>
            </table>
        </main>
    </body>
</html>
