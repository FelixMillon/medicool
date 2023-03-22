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

$unControleur->setTable("vcorrespondance");

if(isset($_GET['action']) && isset($_GET['id_correspondance']))
{	
    $action = $_GET['action'];
    $id_correspondance = $_GET['id_correspondance'];
    $where = array("id_correspondance"=>$id_correspondance);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->setTable("correspondance");
            $unControleur->delete($where);
            break;
        case 'edit':
            $LaCorrespondance=$unControleur->selectWhere($where);
            break;
    }
}

require_once("vue/insert_correspondance.php");

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
        "titre"=>$unControleur->encrypt($_POST["titre"],$key['cle']),
        "contenu"=>$unControleur->encrypt($_POST["contenu"],$key['cle']),
        "id_medecin_source"=>$_POST["id_medecin_source"],
        "id_medecin_cible"=>$_POST["id_medecin_cible"],
        "id_patient"=>$_POST["id_patient"]
        );
    $unControleur->setTable("correspondance");
    $unControleur->insert($tab);    
}

if(isset($_POST['Modifier']))
{
    $where = array("id_correspondance"=>$id_correspondance);
    $tab=array(      
        "titre"=>$unControleur->encrypt($_POST["titre"],$key['cle']),
        "contenu"=>$unControleur->encrypt($_POST["contenu"],$key['cle']),
        "id_medecin_source"=>$_POST["id_medecin_source"],
        "id_medecin_cible"=>$_POST["id_medecin_cible"],
        "id_patient"=>$_POST["id_patient"]
        );
    $unControleur->setTable("correspondance");
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=18"); 
}

$unControleur->setTable("vcorrespondance");
$lesCorrespondances = $unControleur->selectAll(); 

require_once ("vue/les_correspondances.php"); 


?>		
	</div>
	
	<div class="col-2"></div>

</div>

