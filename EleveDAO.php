<?php
DECLARE(strict_types=1);
require_once("DAO.php");
require_once("AnneeDAO.php");
require_once("Annee.php");
class EleveDAO extends DAO {
  function insert($object):void
  {
      if (!isset($object)) {
          throw new Exception("Attention objet vide");
      } else if (!($object instanceOF Eleve)) {
          throw new Exception("Attention l'objet n'est pas de type Eleve");
      } else if ($object->getIdEleve() != 0) {
          throw new Exception("Attention l'objet est déjà enregistré");
      }
      $AnneeTmp = new \AnneeDAO($this->pdo);
      $AnneeTmp->findID($object->getAnnee());

      $sqlInsert = ("INSERT INTO eleve VALUES(null,:nom,:prenom,:sexe,:nRegistreNational,:dateNaissance,:rue,:nrue,:codePostal,:ville,:anneeEtude,:dateCreation)");
      $pst = $this->pdo->prepare($sqlInsert);
      $pst->bindValue(':nom', $object->getNom(), PDO::PARAM_STR);
      $pst->bindValue(':prenom', $object->getPrenom(), PDO::PARAM_STR);
      $pst->bindValue(':sexe', $object->getSexe(), PDO::PARAM_STR);
      $pst->bindValue(':nRegistreNational', $object->getNRegistreNational(), PDO::PARAM_STR);
      $pst->bindValue(':dateNaissance',(string) $object->getDateNaissance()->format('d-m-Y'), PDO::PARAM_STR);
      $pst->bindValue(':rue', $object->getRue(), PDO::PARAM_STR);
      $pst->bindValue(':nrue', $object->getNRue(), PDO::PARAM_STR);
      $pst->bindValue(':codePostal', $object->getCodePostal(), PDO::PARAM_STR);
      $pst->bindValue(':ville', $object->getVille(), PDO::PARAM_STR);
      $pst->bindValue(':anneeEtude', (int)$object->getAnnee()->getIdAnnee(), PDO::PARAM_INT);
      $pst->bindValue('dateCreation',$object->getDateCreation(),PDO::PARAM_STR);
      $pst->execute();

      $keyEleve = $this->pdo->lastInsertId();
      $object->setIdEleve((int)$keyEleve);
  }
    function findId($object):void{}
}
