
<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des patients </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:6%">
            <div class="col-1"></div>
            <div class="col-4" style="padding-right:3%;"> 


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

if(isset($_GET['action']) && isset($_GET['id_patient']))
{	
    $action = $_GET['action'];
    $id_patient = $_GET['id_patient'];
    $where = array("id_patient"=>$id_patient);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->delete($where);
            break;
        case 'edit':
            $LePatient=$unControleur->selectWhere($where);
            break;
    }
}

require_once("vue/insert_patient.php");

if (isset($_POST['Valider']))
{
     
    $key = Key::createNewRandomKey();
    $key = $key->saveToAsciiSafeString();
    var_dump("C'est la clé generer".$key);
    //$value = ['nom','prenom','email','tel','date_naissance','date_enregistrement','numrue','rue','cp','ville','id_medecin','id_cat_secu'];
    if($_POST['id_medecin']==0)
    {
        $tab=array(     
            "nom"=>$unControleur->encrypt($_POST["nom"],$key),
            "prenom"=>$unControleur->encrypt($_POST["prenom"],$key),
            "email"=>$_POST["email"],
            "tel"=>$unControleur->encrypt($_POST["tel"],$key),
            "date_naissance"=>$unControleur->encrypt($_POST["date_naissance"],$key),
            "date_enregistrement"=>$unControleur->encrypt(date('Y-m-d'),$key),
            "numrue"=>$unControleur->encrypt($_POST["numrue"],$key),
            "rue"=>$unControleur->encrypt($_POST["rue"],$key),
            "cp"=>$unControleur->encrypt($_POST["cp"],$key),
            "ville"=>$unControleur->encrypt($_POST["ville"],$key),
            "id_cat_secu"=>$_POST["id_cat_secu"],
            "mdp"=>"123",
            "question_1"=>"1",
            "question_2"=>"2",
            "droits"=>"utilisateur",
            "blocage"=>"unlock",
            "reponse_secrete_1"=>"a remplacer",
            "reponse_secrete_2"=>"a remplacer",
            "numero_dossier"=>'a triggerer',
            );
    }else
    {
        $tab=array(     
            "nom"=>$unControleur->encrypt($_POST["nom"],$key),
            "prenom"=>$unControleur->encrypt($_POST["prenom"],$key),
            "email"=>$_POST["email"],
            "tel"=>$unControleur->encrypt($_POST["tel"],$key),
            "date_naissance"=>$unControleur->encrypt($_POST["date_naissance"],$key),
            "date_enregistrement"=>$unControleur->encrypt(date('Y-m-d'),$key),
            "numrue"=>$unControleur->encrypt($_POST["numrue"],$key),
            "rue"=>$unControleur->encrypt($_POST["rue"],$key),
            "cp"=>$unControleur->encrypt($_POST["cp"],$key),
            "ville"=>$unControleur->encrypt($_POST["ville"],$key),
            "id_medecin"=>$_POST['id_medecin'],
            "id_cat_secu"=>$_POST["id_cat_secu"],
            "mdp"=>"123",
            "question_1"=>"1",
            "question_2"=>"2",
            "droits"=>"utilisateur",
            "blocage"=>"unlock",
            "reponse_secrete_1"=>"a remplacer",
            "reponse_secrete_2"=>"a remplacer",
            "numero_dossier"=>'a triggerer',
            );
    }
    $Verif = NULL; 
    $unControleur->insertValue($tab);
   

    $where = array("email"=>$_POST["email"]);
    $Verif=$unControleur->selectWhere($where);

    if($Verif){
        $tab2 = array("utilisateur"=>hash('sha256',$_POST["email"]),"cle"=>$key);
        $unControleur->callproc('genekey',$tab2);  
        echo 'Inscription reussie';  
    }

}


if(isset($_POST['Modifier']))
{
    $unControleur->setTable("utilisateur");
    $where = array("id"=>$id_patient);
    $tab=array(      
        "nom"=>$unControleur->encrypt($_POST["nom"],$key),
        "prenom"=>$unControleur->encrypt($_POST["prenom"],$key),
        "email"=>$_POST["email"],
        "tel"=>$unControleur->encrypt($_POST["tel"],$key),
        "date_naissance"=>$unControleur->encrypt($_POST["date_naissance"],$key),
        "date_enregistrement"=>$unControleur->encrypt(date('Y-m-d'),$key),
        "numrue"=>$unControleur->encrypt($_POST["numrue"],$key),
        "rue"=>$unControleur->encrypt($_POST["rue"],$key),
        "cp"=>$unControleur->encrypt($_POST["cp"],$key),
        "ville"=>$unControleur->encrypt($_POST["ville"],$key)
        );


    $unControleur->update ($tab, $where);
    $unControleur->setTable("patient");
    $where = array("id_patient"=>$id_patient);
    if($_POST['id_medecin']==0)
    {
        $tab=array(      
            "id_cat_secu"=>$_POST["id_cat_secu"]
            );
    }else
    {
        $tab=array(      
            "id_medecin"=>$_POST['id_medecin'],
            "id_cat_secu"=>$_POST["id_cat_secu"]
            );
    }

    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=19"); 
}

$unControleur->setTable("patient");
$LesPatients = $unControleur->selectAll(); 
require_once ("vue/les_patients.php"); 

?>
	</div>
	

</div>

