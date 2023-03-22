<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des pathologies </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:7%">
            <div class="col-1"></div>


<?php

$Lapathologie=NULL;


$unControleur->setTable("medecin");
$lesMedecins = $unControleur->selectAll();

$unControleur->setTable("patient");
$lesPatients = $unControleur->selectAll();

$unControleur->setTable("vpathologie");


if(isset($_GET['action']) && isset($_GET['id_path']))
{	
    $action = $_GET['action'];
    $id_path = $_GET['id_path'];
    $where = array("id_path"=>$id_path);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->setTable("pathologie");
            $unControleur->delete($where);
            break;
        case 'edit':
            $Lapathologie=$unControleur->selectWhere($where);
            break;
    }
}
if($_SESSION['estMedecin'] == True){
    require_once("vue/insert_pathologie.php");
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
    $unControleur->setTable("pathologie");
    $unControleur->insert($tab);    
}


if(isset($_POST['Modifier']))
{

    $where = array("id_path"=>$id_path);
    $tab=array(
        "libelle"=>$unControleur->encrypt($_POST["libelle"],$key['cle']),
        "date_diagnostique"=>$_POST["date_diagnostique"],
        "date_guerison"=>$_POST["date_guerison"],
        "id_medecin"=>$_POST["id_medecin"],
        "id_patient"=>$_POST["id_patient"]
        );

    $unControleur->setTable("pathologie");
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=9"); 
}

if(isset($_POST['Annuler']))
{
    $Lapathologie=NULL;
    header("Location: index.php?page=9&id_pathologie=null"); 
}


$unControleur->setTable("vpathologie");
$LesPathologies = $unControleur->selectAll(); 

require_once ("vue/les_pathologies.php"); 


?>
		
	</div>
	
	<div class="col-1"></div>

</div>

