<?php
DECLARE(strict_types=1);
require_once("PDOConnect.php");
require_once("Eleve.php");
require_once("EleveDAO.php");
require_once("Annee.php");
require_once("Tuteur.php");
require_once("EleveHasTuteur.php");
require_once("EleveHasTuteurDAO.php");

session_start();
extract($_POST);
date_default_timezone_set('Europe/Brussels');
$_SESSION["inscription"]=array();
$_SESSION["erreur"]=array();
unset($_SESSION['inscription']);
unset($_SESSION['erreur']);
$nom = trim(filter_var($nom, FILTER_SANITIZE_STRING));
$prenom = trim(filter_var($prenom, FILTER_SANITIZE_STRING));
$nRegistre = trim(filter_var($nRegistre, FILTER_SANITIZE_STRING));
$dateNaissance  ;
$rue = trim(filter_var($rue, FILTER_SANITIZE_STRING));
$nRue = trim(filter_var($nRue, FILTER_SANITIZE_STRING));
$codePostal = trim(filter_var($codePostal, FILTER_SANITIZE_STRING));
$ville = trim(filter_var($ville, FILTER_SANITIZE_STRING));
$anneeEtude = trim(filter_var($anneeEtude, FILTER_SANITIZE_STRING));

$_SESSION['inscription']['nom'] =$nom;
$_SESSION['inscription']['prenom'] =$prenom;
$_SESSION['inscription']['nRegistre'] =$nRegistre;
$_SESSION['inscription']['dateNaissance'] =$dateNaissance;
$_SESSION['inscription']['rue'] =$rue;
$_SESSION['inscription']['nRue'] =$nRue;
$_SESSION['inscription']['codePostal'] =$codePostal;
$_SESSION['inscription']['ville'] =$ville;
if(isset($sexe)){
    $_SESSION['inscription']['sexe'] =$sexe;
}else {
    $_SESSION['inscription']['sexe'] ="";
}
$validation = true;
$regexNom ="/^[a-z]+[ \-']?[[a-z]+[ \-']?]*[a-z]+$/i";
if (!(isset($nom) && strlen($nom) > 0 &&
    filter_var($nom, FILTER_VALIDATE_REGEXP,
        array('options'=>array('regexp'=>$regexNom))))) {
    // on aurait pu utiliser preg_match au lieu du filtre ...
    $_SESSION['erreur']['nom'] = 'Nom invalide';
    $validation = false;
}
$regexPrenom ="/^[a-z]+[ \-']?[[a-z]+[ \-']?]*[a-z]+$/i";
if (!(isset($prenom) && strlen($prenom) > 0 &&
    filter_var($prenom, FILTER_VALIDATE_REGEXP,
        array('options'=>array('regexp'=>$regexPrenom))))) {
    // on aurait pu utiliser preg_match au lieu du filtre ...
    $_SESSION['erreur']['prenom'] = 'Prenom invalide';
    $validation = false;
}
$regexNational = "/[0-9]{11}/";
if (!(isset($nRegistre) && strlen($nRegistre) > 0 &&
    filter_var($nRegistre, FILTER_VALIDATE_REGEXP,
        array('options'=>array('regexp'=>$regexNational))))) {
    // on aurait pu utiliser preg_match au lieu du filtre ...
    $_SESSION['erreur']['nRegistre'] = 'Numero registre invalide';
    $validation = false;
}
if (!(isset($sexe) && strlen($sexe) > 0)) {
    $_SESSION['erreur']['sexe'] = 'Veuillez choisir le sexe';
    $validation = false;
}
$regexRue ="/^[a-z]+[ \-']?[[a-z]+[ \-']?]*[a-z]+$/i";
if (!(isset($rue) && strlen($rue) > 0 &&
    filter_var($rue, FILTER_VALIDATE_REGEXP,
        array('options'=>array('regexp'=>$regexRue))))) {
    // on aurait pu utiliser preg_match au lieu du filtre ...
    $_SESSION['erreur']['rue'] = 'rue invalide';
    $validation = false;
}

$regexNr = "/^[a-z0-9]+[ \-']?[[a-z0-9]+[ \-']?]*[a-z0-9]+$/i";
if (!(isset($nRue) && strlen($nRue) > 0 &&
    filter_var($nRue, FILTER_VALIDATE_REGEXP,
        array('options'=>array('regexp'=>$regexNr))))) {
    $_SESSION['erreur']['nRue'] = 'Numéro de rue invalide';
    $validation = false;
}

$regexCodePostal = "/^[0-9]+$/i";
if (!(isset($codePostal) && strlen($codePostal) > 0 &&
    filter_var($codePostal, FILTER_VALIDATE_REGEXP,
        array('options'=>array('regexp'=>$regexCodePostal))))) {
    $_SESSION['erreur']['codePostal'] = 'code postal invalide';
    $validation = false;
}
$dateTime = (new \DateTime('now'))->format('Y-m-d');
$tabDateNaissance = explode('-', $dateNaissance);
// Ajouter une validation du format yyyy-mm-dd si le navigateur ne reconnait pas input date

$regexDateNaissance = "/^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/i";
if ( (filter_var($dateNaissance, FILTER_VALIDATE_REGEXP,array('options'=>array('regexp'=>$regexDateNaissance ))))){
    $_SESSION['erreur']['dateNaissance'] = 'syntaxe Date incorrecte yyyy-mm-dd attendu';
    $validation = false;
}
else if (!checkdate((int) $tabDateNaissance[1], (int) $tabDateNaissance[2],
    (int) $tabDateNaissance[0])) {
    $_SESSION['erreur']['dateNaissance'] = 'Date invalide - incorrecte';
    $validation = false;
}
else if (((int)($tabDateNaissance[0]))<1900) {
    $_SESSION['erreur']['dateNaissance'] = 'Date invalide - incorrecte';
    $validation = false;
}
else if ($dateNaissance > $dateTime) {
    $_SESSION['erreur']['dateNaissance'] = 'Date invalide';
    $validation = false;
}


$regexVille = "/^[a-z]+[ \-']?[[a-z]+[ \-']?]*[a-z]+$/i";
if (!(isset($ville) && strlen($ville) > 0 &&
    filter_var($ville, FILTER_VALIDATE_REGEXP,
        array('options'=>array('regexp'=>$regexVille))))) {
    $_SESSION['erreur']['ville'] = 'ville invalide';
    $validation = false;
}
if (!(isset($anneeEtude) && strlen($anneeEtude) > 0)) {
    $_SESSION['erreur']['anneeEtude'] = 'Veuillez choisir l\'annee d\'etude';
    $validation = false;
}

$nomTuteur1 = trim(filter_var($nomTuteur1, FILTER_SANITIZE_STRING));
$prenomTuteur1 = trim(filter_var($prenomTuteur1, FILTER_SANITIZE_STRING));
$nRegistreTuteur1 = trim(filter_var($nRegistreTuteur1, FILTER_SANITIZE_STRING));
$emailTuteur1 = trim(filter_var($emailTuteur1, FILTER_SANITIZE_STRING));
$mobileTuteur1 = trim(filter_var($mobileTuteur1, FILTER_SANITIZE_STRING));
$telephoneTuteur1 = trim(filter_var($telephoneTuteur1, FILTER_SANITIZE_STRING));

$_SESSION['inscription']['nomTuteur1'] =$nomTuteur1;
$_SESSION['inscription']['prenomTuteur1'] =$prenomTuteur1;
$_SESSION['inscription']['nRegistreTuteur1'] =$nRegistreTuteur1;
$_SESSION['inscription']['emailTuteur1'] =$emailTuteur1;
$_SESSION['inscription']['mobileTuteur1'] =$mobileTuteur1;
$_SESSION['inscription']['telephoneTuteur1'] =$telephoneTuteur1;
if(isset($sexeTuteur1)){
    $_SESSION['inscription']['sexeTuteur1'] =$sexeTuteur1;
}else {
    $_SESSION['inscription']['sexeTuteur1'] ="";
}
if (!(isset($statutTuteur1) && strlen($statutTuteur1) > 0)) {
    $_SESSION['erreur']['$statutTuteur1'] = 'Veuillez choisir le lien de parenté';
    $validation = false;
}

$regexNom ="/^[a-z]+[ \-']?[[a-z]+[ \-']?]*[a-z]+$/i";
if (!(isset($nomTuteur1) && strlen($nomTuteur1) > 0 &&
    filter_var($nomTuteur1, FILTER_VALIDATE_REGEXP,
        array('options'=>array('regexp'=>$regexNom))))) {
    // on aurait pu utiliser preg_match au lieu du filtre ...
    $_SESSION['erreur']['nomTuteur1'] = 'Nom invalide';
    $validation = false;
}
$regexPrenom ="/^[a-z]+[ \-']?[[a-z]+[ \-']?]*[a-z]+$/i";
if (!(isset($prenomTuteur1) && strlen($prenomTuteur1) > 0 &&
    filter_var($prenomTuteur1, FILTER_VALIDATE_REGEXP,
        array('options'=>array('regexp'=>$regexPrenom))))) {
    // on aurait pu utiliser preg_match au lieu du filtre ...
    $_SESSION['erreur']['prenomTuteur1'] = 'Prenom invalide';
    $validation = false;
}
$regexNational = "/[0-9]{11}/";
if (!(isset($nRegistreTuteur1) && strlen($nRegistreTuteur1) > 0 &&
    filter_var($nRegistreTuteur1, FILTER_VALIDATE_REGEXP,
        array('options'=>array('regexp'=>$regexNational))))) {
    // on aurait pu utiliser preg_match au lieu du filtre ...
    $_SESSION['erreur']['nRegistreTuteur1'] = 'Numero registre invalide';
    $validation = false;
}
if (!(isset($sexeTuteur1) && strlen($sexeTuteur1) > 0)) {
    $_SESSION['erreur']['sexeTuteur1'] = 'Veuillez choisir le sexe';
    $validation = false;
}

$regexEmailTuteur1 = "/^[a-z0-9._-]+@[a-z]+.[a-z]{2,4}$/";
if (!(isset($emailTuteur1) && strlen($emailTuteur1) >0 &&
    filter_var($emailTuteur1, FILTER_VALIDATE_REGEXP,
        array('options'=>array('regexp'=>$regexEmailTuteur1))))) {
    $_SESSION['erreur']['emailTuteur1'] = 'email invalide';
    $validation = false;
}
$regextelMobil = '/^04(6|[789]\d)(\s?\d{2}){3}$/';
if (!(isset($mobileTuteur1) && strlen($mobileTuteur1) == 10 &&
    filter_var($mobileTuteur1, FILTER_VALIDATE_REGEXP,
        array('options'=>array('regexp'=>$regextelMobil))))) {
    $_SESSION['erreur']['mobileTuteur1'] = 'mobile invalide';
    $validation = false;
}
$regextelFixe = '/^(0(\d\s?\d{3}|\d{2}\s?\d{2})(\s?\d{2}){2})$/';
if (!(isset($telephoneTuteur1) && strlen($telephoneTuteur1) == 9  &&
    filter_var($telephoneTuteur1, FILTER_VALIDATE_REGEXP,
        array('options'=>array('regexp'=>$regextelFixe))))) {
    $_SESSION['erreur']['telephoneTuteur1'] = 'telephone invalide';
    $validation = false;
}


if($hiddenClear =="clear") {
    $nomTuteur2 = trim(filter_var($nomTuteur2, FILTER_SANITIZE_STRING));
    $prenomTuteur2 = trim(filter_var($prenomTuteur2, FILTER_SANITIZE_STRING));
    $nRegistreTuteur2 = trim(filter_var($nRegistreTuteur2, FILTER_SANITIZE_STRING));
    $emailTuteur2 = trim(filter_var($emailTuteur2, FILTER_SANITIZE_STRING));
    $mobileTuteur2 = trim(filter_var($mobileTuteur2, FILTER_SANITIZE_STRING));
    $telephoneTuteur2 = trim(filter_var($telephoneTuteur2, FILTER_SANITIZE_STRING));

    $_SESSION['inscription']['nomTuteur2'] = $nomTuteur2;
    $_SESSION['inscription']['prenomTuteur2'] = $prenomTuteur2;
    $_SESSION['inscription']['nRegistreTuteur2'] = $nRegistreTuteur2;
    $_SESSION['inscription']['emailTuteur2'] = $emailTuteur2;
    $_SESSION['inscription']['mobileTuteur2'] = $mobileTuteur2;
    $_SESSION['inscription']['telephoneTuteur2'] = $telephoneTuteur2;
    if (isset($sexeTuteur2)) {
        $_SESSION['inscription']['sexeTuteur2'] = $sexeTuteur2;
    } else {
        $_SESSION['inscription']['sexeTuteur2'] = "";
    }
    if (!(isset($statutTuteur2) && strlen($statutTuteur2) > 0)) {
        $_SESSION['erreur']['$statutTuteur2'] = 'Veuillez choisir le lien de parenté';
        $validation = false;
    }
    $regexNom = "/^[a-z]+[ \-']?[[a-z]+[ \-']?]*[a-z]+$/i";
    if (!(isset($nomTuteur2) && strlen($nomTuteur2) > 0 &&
        filter_var($nomTuteur2, FILTER_VALIDATE_REGEXP,
            array('options' => array('regexp' => $regexNom))))) {
    // on aurait pu utiliser preg_match au lieu du filtre ...
        $_SESSION['erreur']['nomTuteur2'] = 'Nom invalide';
        $validation = false;
    }
    $regexPrenom = "/^[a-z]+[ \-']?[[a-z]+[ \-']?]*[a-z]+$/i";
    if (!(isset($prenomTuteur2) && strlen($prenomTuteur2) > 0 &&
        filter_var($prenomTuteur2, FILTER_VALIDATE_REGEXP,
            array('options' => array('regexp' => $regexPrenom))))) {
    // on aurait pu utiliser preg_match au lieu du filtre ...
        $_SESSION['erreur']['prenomTuteur2'] = 'Prenom invalide';
        $validation = false;
    }
    $regexEmailTuteur2 = "#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#";
    if (!(isset($emailTuteur2) && strlen($emailTuteur2) >0 &&
        filter_var($emailTuteur2, FILTER_VALIDATE_REGEXP,
            array('options'=>array('regexp'=>$regexEmailTuteur2))))) {
        $_SESSION['erreur']['emailTuteur1'] = 'email invalide';
        $validation = false;
    }

    $regexNational2 = "/[0-9]{11}/";
    if (!(isset($nRegistreTuteur2) && strlen($nRegistreTuteur2) > 0 &&
        filter_var($nRegistreTuteur2, FILTER_VALIDATE_REGEXP,
            array('options' => array('regexp' => $regexNational2))))) {
    // on aurait pu utiliser preg_match au lieu du filtre ...
        $_SESSION['erreur']['nRegistreTuteur2'] = 'Numero registre invalide';
        $validation = false;
    }
    if (!(isset($sexeTuteur2) && strlen($sexeTuteur2) > 0)) {
        $_SESSION['erreur']['sexeTuteur2'] = 'Veuillez choisir le sexe';
        $validation = false;
    }

    $regextelMobil = '/^04(6|[789]\d)(\s?\d{2}){3}$/';
    if (!(isset($mobileTuteur2) && strlen($mobileTuteur2) == 10 &&
        filter_var($mobileTuteur2, FILTER_VALIDATE_REGEXP,
            array('options' => array('regexp' => $regextelMobil))))) {
        $_SESSION['erreur']['mobileTuteur2'] = 'mobile invalide';
        $validation = false;
    }
    $regextelFixe = '/^(0(\d\s?\d{3}|\d{2}\s?\d{2})(\s?\d{2}){2})$/';
    if (!(isset($telephoneTuteur2) && strlen($telephoneTuteur2) == 9 &&
        filter_var($telephoneTuteur2, FILTER_VALIDATE_REGEXP,
            array('options' => array('regexp' => $regextelFixe))))) {
        $_SESSION['erreur']['telephoneTuteur2'] = 'telephone invalide';
        $validation = false;
    }
}
if ($validation == false) {
    header('location: index.php');
    exit();
}

$elev = new Eleve;
$elev->setNom($_SESSION['inscription']['nom']);
$elev->setPrenom($_SESSION['inscription']['prenom']);
$elev->setSexe($_SESSION['inscription']['sexe']);
$elev->setNRegistreNational($_SESSION['inscription']['nRegistre']);
$elev->setDateNaissance(new \DateTime($_SESSION['inscription']['dateNaissance']));
$elev->setRue($_SESSION['inscription']['rue']);
$elev->setNRue($_SESSION['inscription']['nRue']);
$elev->setCodePostal($_SESSION['inscription']['codePostal']);
$elev->setVille($_SESSION['inscription']['ville']);
$elev->setDateCreation((new DateTime('now'))->format('d-m-Y'));
$ann = new Annee ;
$ann->setAcronyme($anneeEtude);
$elev->setAnnee($ann);

$_SESSION['inscription']['nomTuteur1'] =$nomTuteur1;
$_SESSION['inscription']['prenomTuteur1'] =$prenomTuteur1;
$_SESSION['inscription']['nRegistreTuteur1'] =$nRegistreTuteur1;
$_SESSION['inscription']['emailTuteur1'] =$emailTuteur1;
$_SESSION['inscription']['mobileTuteur1'] =$mobileTuteur1;
$_SESSION['inscription']['telephoneTuteur1'] =$telephoneTuteur1;

$tut1 = new Tuteur;
$tut1->setNom($_SESSION['inscription']['nomTuteur1']);
$tut1->setPrenom($_SESSION['inscription']['prenomTuteur1']);
$tut1->setSexe($_SESSION['inscription']['sexeTuteur1']);
$tut1->setNRegistreNational($_SESSION['inscription']['nRegistreTuteur1']);
$tut1->setEmail($_SESSION['inscription']['emailTuteur1']);
$tut1->setMobile($_SESSION['inscription']['mobileTuteur1']);
$tut1->setTelephone($_SESSION['inscription']['telephoneTuteur1']);
$tut1->setDateCreation((new DateTime('now'))->format('d-m-Y'));
$flag=false;

$eleTut = new EleveHasTuteur();
$eleTut->setEleve($elev);
$eleTut->setTuteur($tut1);
$eleTut->setLienDeParente($statutTuteur1);
if($hiddenClear =="clear") {
    $tut2 = new Tuteur;
    $tut2->setNom($_SESSION['inscription']['nomTuteur2']);
    $tut2->setPrenom($_SESSION['inscription']['prenomTuteur2']);
    $tut2->setSexe($_SESSION['inscription']['sexeTuteur2']);
    $tut2->setNRegistreNational($_SESSION['inscription']['nRegistreTuteur2']);
    $tut2->setEmail($_SESSION['inscription']['emailTuteur2']);
    $tut2->setMobile($_SESSION['inscription']['mobileTuteur2']);
    $tut2->setTelephone($_SESSION['inscription']['telephoneTuteur2']);
    $tut2->setDateCreation((new DateTime('now'))->format('d-m-Y'));
    $flag = false;

    $eleTut1 = new EleveHasTuteur();
    $eleTut1->setEleve($elev);
    $eleTut1->setTuteur($tut2);
    $eleTut1->setLienDeParente($statutTuteur2);
}
try{
    $pdo= getPDOConnect();
    $pdo->beginTransaction();
    $test = new EleveHasTuteurDAO($pdo);
    $test->insert($eleTut);
    if($hiddenClear =="clear") {
        $test = new EleveHasTuteurDAO($pdo);
        $test->insert($eleTut1);
    }
        $pdo->commit();
    $flag=true;
    echo "encodé";
}catch(\PDOException $e) {
    echo $e->getMessage();
}catch(Exception $e){
    echo $e->getMessage();
}Finally {
    if ( $flag === false ) {
        $pdo->rollBack();
        echo "insertion et roolback";
    }else {
        header('location: enregistrement.php');
    }
}
