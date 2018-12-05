<?php
DECLARE(strict_types=1);
class Annee {
  private $idAnnee = 0; // int 
  private $acronyme =null;//string
  private $libelle= null; // string 
  
  public function setIdAnnee(int $idAnnee) {
    $this->idAnnee = $idAnnee;
  }
  public function getIdAnnee():int {
    return $this->idAnnee;
  }
  public function setLibelle(string $libelle) {
    $this->libelle = $libelle;
  }
  public function getLibelle():string {
    return $this->libelle;
  }
  public function setAcronyme(string $acronyme) {
    $this->acronyme = $acronyme;
  }
  public function getAcronyme():string {
    return $this->acronyme;
  }
}
?>
