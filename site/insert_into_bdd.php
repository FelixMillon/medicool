<?php

use \Defuse\Crypto\Crypto;
use \Defuse\Crypto\Key;
require "vendor/autoload.php";
$LePatient=NULL;

$unControleur->setTable("medecin");
$lesMedecins = $unControleur->selectAll();

$unControleur->setTable("categorie_secu");
$lesCategories_secu = $unControleur->selectAll();


$unControleur->setTable("patient");

require_once("vue/insert_patient_test.php");

if(isset($_POST['RefreshHosp']))
{
    $unControleur->setTable('hopital');
    $where=array("1"=>"1");
    $unControleur->delete($where);
    $unControleur->RefreshHospitals();
    $unControleur->setTable("patient");
}

$lesentrees = array(
    array('emailpat@gmail.com','123','balloch','patoch','01857467879','2000-01-01','2012-12-12','666','rue_patoch','66666','enfer','4','6',"Chouaki","Moby-Dick",'null','utilisateur','6666666666','2','null'),
    array('email_minouche@gmail.com','123','Nouchnouch','minouch','0987654321','1895-01-01','2000-12-24','5','rue patouch','7minouch','hess','4','6',"Chouaki","Moby-Dick",'null','utilisateur','0000000001','3','1'),
    array('totaltout@gmail.com','m','n','p','t','2000-10-10','2000-10-10','n','r','c','v','4','6',"Chouaki","Moby-Dick",'null','super_administrateur','0123495874','1','1')
);

if (isset($_POST['Valider']))
{
    $key = Key::createNewRandomKey();
    $key = $key->saveToAsciiSafeString();
    foreach($lesentrees as $uneentree)
    {
        var_dump($uneentree);
        $tab=array(
            "email"=>$uneentree[0],
            "mdp"=>$uneentree[1],
            "nom"=>$unControleur->encrypt($uneentree[2],$key),
            "prenom"=>$unControleur->encrypt($uneentree[3],$key),
            "tel"=>$unControleur->encrypt($uneentree[4],$key),
            "date_naissance"=>$unControleur->encrypt($uneentree[5],$key),
            "date_enregistrement"=>$unControleur->encrypt($uneentree[6],$key),
            "numrue"=>$unControleur->encrypt($uneentree[7],$key),
            "rue"=>$unControleur->encrypt($uneentree[8],$key),
            "cp"=>$unControleur->encrypt($uneentree[9],$key),
            "ville"=>$unControleur->encrypt($uneentree[10],$key),
            "question_1"=>$uneentree[11],
            "question_2"=>$uneentree[12],
            "droits"=>$uneentree[13],
            "blocage"=>$uneentree[14],
            "reponse_secrete_1"=>$uneentree[15],
            "reponse_secrete_2"=>$uneentree[16],
            "numero_dossier"=>$uneentree[17],
            "id_cat_secu"=>$uneentree[18],
            "id_medecin"=>$uneentree[19],
        );
        $Verif = NULL; 
        $unControleur->insertValue($tab);
        echo 'PATIENT INSERÉR';
        $tab2 = array("utilisateur"=>$uneentree[0],"cle"=>$key);
        $unControleur->callproc('genekey',$tab2);
    }
}

$unControleur->setTable("patient");
$LesPatients = $unControleur->selectAll(); 
//require_once ("vue/les_patients.php"); 

?>

