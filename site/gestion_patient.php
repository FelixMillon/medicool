<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des patients </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:6%">
            <div class="col-1"></div>
            <div class="col-4" style="padding-right:3%;"> 


<?php
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
    //$value = ['nom','prenom','email','tel','date_naissance','date_enregistrement','numrue','rue','cp','ville','id_medecin','id_cat_secu'];
    $tab=array(     
        "nom"=>$_POST["nom"],
        "prenom"=>$_POST["prenom"],
        "email"=>$_POST["email"],
        "tel"=>$_POST["tel"],
        "date_naissance"=>$_POST["date_naissance"],
        "date_enregistrement"=>date('Y-m-d'),
        "numrue"=>$_POST["numrue"],
        "rue"=>$_POST["rue"],
        "cp"=>$_POST["cp"],
        "ville"=>$_POST["ville"],
        "id_medecin"=>$_POST['id_medecin'],
        "id_cat_secu"=>$_POST["id_cat_secu"],
        "mdp"=>"Azerty@123",
        "question_1"=>"1",
        "question_2"=>"2",
        "droits"=>"utilisateur",
        "blocage"=>"unlock",
        "reponse_secrete_1"=>"a remplacer",
        "reponse_secrete_2"=>"a remplacer",
        "numero_dossier"=>'a triggerer',
        );
    $unControleur->insertValue($tab); 
}


if(isset($_POST['Modifier']))
{
    $unControleur->setTable("utilisateur");
    $where = array("id"=>$id_patient);
    $tab=array(      
        "nom"=>$_POST["nom"],
        "prenom"=>$_POST["prenom"],
        "email"=>$_POST["email"],
        "tel"=>$_POST["tel"],
        "date_naissance"=>$_POST["date_naissance"],
        "numrue"=>$_POST["numrue"],
        "rue"=>$_POST["rue"],
        "cp"=>$_POST["cp"],
        "ville"=>$_POST["ville"]
        );
    $unControleur->update ($tab, $where);
    $unControleur->setTable("patient");
    $where = array("id_patient"=>$id_patient);
    $tab=array(      
        "id_medecin"=>$_POST['id_medecin'],
        "id_cat_secu"=>$_POST["id_cat_secu"]
        );
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=19"); 
}

$unControleur->setTable("patient");
$LesPatients = $unControleur->selectAll(); 
require_once ("vue/les_patients.php"); 

?>
	</div>
	

</div>

