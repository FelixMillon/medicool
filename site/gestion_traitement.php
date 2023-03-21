<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des traitements </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:7%">
        <div class="col-1"></div>


<?php

$Letraitement=NULL;


$unControleur->setTable("medecin");
$lesMedecins = $unControleur->selectAll();

$unControleur->setTable("patient");
$lesPatients = $unControleur->selectAll();

$unControleur->setTable("vtraitement");


if(isset($_GET['action']) && isset($_GET['id_traitement']))
{	
    $action = $_GET['action'];
    $id_traitement = $_GET['id_traitement'];
    $where = array("id_traitement"=>$id_traitement);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->setTable("traitement");
            $unControleur->delete($where);
            break;
        case 'edit':
            $Letraitement=$unControleur->selectWhere($where);
            break;
    }
}
if($_SESSION['estMedecin'] == True){
require_once("vue/insert_traitement.php");
}
if(isset($_POST['Valider']) || isset($_POST['Modifier']))
{
    // Recherche de la clé de cryptage 
    $unControleur->setTable("patient");
    $where = array('id_patient'=>$_POST['id_patient']);
    $lePatient = $unControleur->selectWhere($where);
    $tab3=array($lePatient["email"]);
    $key=$unControleur->callproc('getkey',$tab3);
}


if (isset($_POST['Valider']))
{
    $tab=array(    
        "libelle"=>$unControleur->encrypt($_POST["libelle"],$key['cle']),  
        "posologie"=>$_POST["posologie"],
        "date_debut"=>$_POST["date_debut"],
        "date_fin"=>$_POST["date_fin"],
        "prix_par_unite"=>$_POST["prix_par_unite"],
        "id_medecin"=>$_POST["id_medecin"],
        "id_patient"=>$_POST["id_patient"]
        );
    $unControleur->setTable("traitement");
    $unControleur->insert($tab); 
    
}


if(isset($_POST['Modifier']))
{

    $where = array("id_traitement"=>$id_traitement);
    $tab=array(    
        "libelle"=>$unControleur->encrypt($_POST["libelle"],$key['cle']),  
        "posologie"=>$_POST["posologie"],
        "date_debut"=>$_POST["date_debut"],
        "date_fin"=>$_POST["date_fin"],
        "prix_par_unite"=>$_POST["prix_par_unite"],
        "id_medecin"=>$_POST["id_medecin"],
        "id_patient"=>$_POST["id_patient"]
        );

    $unControleur->setTable("traitement");
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=10"); 
}

$unControleur->setTable("vtraitement");
$LesTraitements = $unControleur->selectAll(); 

require_once ("vue/les_traitements.php"); 


?>


        <!-- Début insert -->

        <!-- Fin insert -->
   

    <!-- Début All -->

    
    <!-- Fin All -->

		
	</div>
	
	<div class="col-1"></div>

</div>

