<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des allergies </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:7%">
            <div class="col-1"></div>


<?php

$LAllergie=NULL;


$unControleur->setTable("medecin");
$lesMedecins = $unControleur->selectAll();

$unControleur->setTable("patient");
$lesPatients = $unControleur->selectAll();

$unControleur->setTable("vallergie");


if(isset($_GET['action']) && isset($_GET['id_allergie']))
{	
    $action = $_GET['action'];
    $id_allergie = $_GET['id_allergie'];
    $where = array("id_allergie"=>$id_allergie);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->setTable("allergie");
            $unControleur->delete($where);
            break;
        case 'edit':
            $LAllergie=$unControleur->selectWhere($where);
            break;
    }
}

if($_SESSION['estMedecin'] == True){
    require_once("vue/insert_allergie.php");
}

if(isset($_POST['Valider']) || isset($_POST['Modifier']))
{
    // Recherche de la clé de cryptage 
    $unControleur->setTable("patient");
    $where = array('id_patient'=>$_POST['id_patient']);
    $lePatient = $unControleur->selectWhere($where);
    $tab3=array(hash('sha256',$lePatient["email"]));
    $key=$unControleur->callproc('getkey',$tab3);
}


if (isset($_POST['Valider']))
{
    $tab=array(    
        "libelle"=>$unControleur->encrypt($_POST["libelle"],$key['cle']),  
        "date_diagnostique"=>$_POST["date_diagnostique"],
        "date_guerison"=>$_POST["date_guerison"],
        "id_medecin"=>$_POST["id_medecin"],
        "id_patient"=>$_POST["id_patient"]
        );
    $unControleur->setTable("allergie");
    $unControleur->insert($tab); 
    
}


if(isset($_POST['Modifier']))
{

    $where = array("id_allergie"=>$id_allergie);
    $tab=array(
        "libelle"=>$unControleur->encrypt($_POST["libelle"],$key['cle']),
        "date_diagnostique"=>$_POST["date_diagnostique"],
        "date_guerison"=>$_POST["date_guerison"],
        "id_medecin"=>$_POST["id_medecin"],
        "id_patient"=>$_POST["id_patient"]
        );

    $unControleur->setTable("allergie");
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=6"); 
}


if(isset($_POST['Annuler']))
{
    $LHospitalisation=NULL;
    header("Location: index.php?page=6&id_allergie=null"); 
}

$unControleur->setTable("vallergie");
$LesAllergies = $unControleur->selectAll(); 

require_once ("vue/les_allergies.php"); 


?>		
	</div>
	
	<div class="col-1"></div>

</div>

