<?php 
DECLARE(strict_types = 1);
 require_once ("DAO.php");
 require_once("Annee.php");
class AnneeDAO extends DAO {
  function insert($object):void{}
  function findID($object):void
  {
      if(!isset($object)) {
          throw new Exception("Attention objet vide");
      }else if( !($object instanceOF Annee)) {
          throw new Exception("Attention l'objet n'est pas de type Annee");
      }else if ($object->getAcronyme() == null) {
          throw new Exception("Attention l'objet Annee est déjà enregistré");
      }
      $sqlChoix = $this->pdo->prepare("SELECT idAnneeEtude from anneeEtude WHERE acronyme= :acronyme");
      $sqlChoix->bindValue('acronyme',$object->getAcronyme(),PDO::PARAM_STR);
      $sqlChoix->execute();
      $answer = $sqlChoix->fetch();
      $object->setIdAnnee((int)$answer['idAnneeEtude']) ;
  }
}
?>
