<?php 
DECLARE(strict_types=1);
class Eleve {
  private $idEleve=0; //int 
  private $nom=null; //string 
  private $prenom=null; //string 
  private $sexe=null; //string 
  private $nRegistreNational =null; // string
  private $dateNaissance=null; //string
  private $rue=null; //string 
  private $nrue=null; //string
  private $codePostal=null;//string
  private $ville=null; //string
  private $dateCreation = null;//string
  // Classe d'association
  private $annee; // Annee
  
  
  function setIdEleve(int $idEleve) {
   $this->idEleve = $idEleve;  
  }
  function getIdEleve():int {
   return $this->idEleve; 
  }
  function setNom(string $nom) {
    $this->nom = $nom;  
  }
  function getNom():string {
    return $this->nom; 
  }
  function setPrenom(string $prenom) {
    $this->prenom = $prenom;  
  }
  function getPrenom():string {
    return $this->prenom; 
  }
  function setSexe(string $sexe){
    $this->sexe = $sexe;  
  }
  function getSexe():string {
     return $this->sexe;
  }
  function setNRegistreNational(string $nRegistreNational) {
     $this->nRegistreNational = $nRegistreNational;  
  }
  function getNRegistreNational():string {
    return $this->nRegistreNational; 
  }
  function setDateNaissance(\DateTime $dateNaissance) {
   $this->dateNaissance = $dateNaissance;  
  }
  function getDateNaissance(): \DateTime {
    return $this->dateNaissance; 
  }
  function setRue(string $rue) {
   $this->rue = $rue;  
  }
  function getRue():string {
    return $this->rue; 
  }  
  function setNRue(string $nrue) {
   $this->nrue = $nrue;  
  }
  function getNRue():string {
    return $this->nrue; 
  } 
  function setVille(string $ville) {
   $this->ville = $ville;  
  }
  function getVille():string {
    return $this->ville; 
  }  
  function setOption(Option $option) {
   $this->option = $option;  
  }
  function getOption():Option {
    return $this->option; 
  }
  function setAnnee(Annee $annee) {
   $this->annee = $annee;  
  }
  function getAnnee():Annee {
    return $this->annee; 
  }
  function setDateCreation(string $dateCreation) {
   $this->dateCreation = $dateCreation;  
  }
  function getDateCreation():string {
    return $this->dateCreation; 
  }
    function setCodePostal(string $codePostal) {
        $this->codePostal = $codePostal;
    }
    function getCodePostal():string {
        return $this->codePostal;
    }
}
