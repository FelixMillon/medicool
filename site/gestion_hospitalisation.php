<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des hospitalisations </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:7%">
            <div class="col-2"></div>
            <div class="col-4" style="padding-right:3%;"> 


<?php





$LHospitalisation=NULL;


$unControleur->setTable("medecin");
$lesMedecins = $unControleur->selectAll();

$unControleur->setTable("patient");
$lesPatients = $unControleur->selectAll();

$unControleur->setTable("hopital");
$lesHopitals = $unControleur->selectAll();

$unControleur->setTable("hospitalisation");




if(isset($_GET['action']) && isset($_GET['id_hospitalisation']))
{	
    $action = $_GET['action'];
    $id_hospitalisation = $_GET['id_hospitalisation'];

    $where = array("id_hospitalisation"=>$id_hospitalisation);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->delete($where);
            break;
        case 'edit':
            $LHospitalisation=$unControleur->selectWhere($where);
            break;
    }
}

require_once("vue/insert_hospitalisation.php");

if (isset($_POST['Valider']))
{
    $tab=array(      
        "raison"=>$_POST["raison"],
        "date_debut"=>$_POST["date_debut"],
        "date_fin_estimee"=>$_POST["date_fin_estimee"],
        "date_fin"=>$_POST["date_fin"],
        "id_hopital"=>$_POST["id_hopital"],
        "id_patient"=>$_POST["id_patient"],
        "id_medecin"=>$_POST["id_medecin"]
        );
    $unControleur->insert($tab); 
    
}





if(isset($_POST['Modifier']))
{
    $where = array("id_hospitalisation"=>$id_hospitalisation);
    $tab=array(
        "id_hospitalisation"=>$_POST["id_hospitalisation"],
        "raison"=>$_POST["raison"],
        "date_debut"=>$_POST["date_debut"],
        "date_fin_estimee"=>$_POST["date_fin_estimee"],
        "date_fin"=>$_POST["date_fin"],
        "id_hopital"=>$_POST["id_hopital"],
        "id_patient"=>$_POST["id_patient"],
        "id_medecin"=>$_POST["id_medecin"]
        );
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=4"); 
}

if(isset($_POST['Annuler']))
{
    $LHospitalisation=NULL;
    header("Location: index.php?page=4&id_hospitalisation=null"); 
}


$unControleur->setTable("hospitalisation");
$LesHospitalisations = $unControleur->selectAll(); 

require_once ("vue/les_hospitalisation.php"); 


?>		
	</div>
	
	<div class="col-2"></div>

</div>

