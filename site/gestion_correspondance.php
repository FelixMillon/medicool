<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des correspondances </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:12%">
            <div class="col-2"></div>
            <div class="col-4" style="padding-right:3%;"> 


<?php





$LaCorrespondance=NULL;


$unControleur->setTable("medecin");
$lesMedecins = $unControleur->selectAll();

$unControleur->setTable("patient");
$lesPatients = $unControleur->selectAll();

$unControleur->setTable("correspondance");

if(isset($_GET['action']) && isset($_GET['id_correspondance']))
{	
    $action = $_GET['action'];
    $id_correspondance = $_GET['id_correspondance'];
    $where = array("id_correspondance"=>$id_correspondance);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->delete($where);
            break;
        case 'edit':
            $LaCorrespondance=$unControleur->selectWhere($where);
            break;
    }
}

require_once("vue/insert_correspondance.php");

if (isset($_POST['Valider']))
{
    $tab=array(      
        "titre"=>$_POST["titre"],
        "contenu"=>$_POST["contenu"],
        "id_medecin_source"=>$_POST["id_medecin_source"],
        "id_medecin_cible"=>$_POST["id_medecin_cible"],
        "id_patient"=>$_POST["id_patient"]
        );
    $unControleur->insert($tab);    
}

if(isset($_POST['Modifier']))
{
    $where = array("id_correspondance"=>$id_correspondance);
    $tab=array(      
        "titre"=>$_POST["titre"],
        "contenu"=>$_POST["contenu"],
        "id_medecin_source"=>$_POST["id_medecin_source"],
        "id_medecin_cible"=>$_POST["id_medecin_cible"],
        "id_patient"=>$_POST["id_patient"]
        );
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=18"); 
}

$unControleur->setTable("correspondance");
$lesCorrespondances = $unControleur->selectAll(); 

require_once ("vue/les_correspondances.php"); 


?>		
	</div>
	
	<div class="col-2"></div>

</div>

