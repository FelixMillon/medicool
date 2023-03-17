<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des operations </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:12%">
            <div class="col-2"></div>
            <div class="col-4" style="padding-right:3%;"> 


<?php

$Loperation=NULL;

$unControleur->setTable("patient");
$lesPatients = $unControleur->selectAll();

$unControleur->setTable("voperation");


if(isset($_GET['action']) && isset($_GET['id_operation']))
{	
    $action = $_GET['action'];
    $id_operation = $_GET['id_operation'];
    $where = array("id_operation"=>$id_operation);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->setTable("operation");
            $unControleur->delete($where);
            break;
        case 'edit':
            $Loperation=$unControleur->selectWhere($where);
            break;
    }
}

require_once("vue/insert_operation.php");

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
        "date_heure_time"=>$_POST["date_heure_time"],
        "duree"=>$_POST["duree"],
        "prix"=>$_POST["prix"],
        "resultat"=>$unControleur->encrypt($_POST["resultat"],$key['cle']),
        "commentaire"=>$unControleur->encrypt($_POST["commentaire"],$key['cle']),
        "id_patient"=>$_POST["id_patient"]
        );
    $unControleur->setTable("operation");
    $unControleur->insert($tab); 
    
}


if(isset($_POST['Modifier']))
{

    $where = array("id_operation"=>$id_operation);
    $tab=array(
        "libelle"=>$unControleur->encrypt($_POST["libelle"],$key['cle']),
        "date_heure_time"=>$_POST["date_heure_time"],
        "duree"=>$_POST["duree"],
        "prix"=>$_POST["prix"],
        "resultat"=>$unControleur->encrypt($_POST["resultat"],$key['cle']),
        "commentaire"=>$unControleur->encrypt($_POST["commentaire"],$key['cle']),
        "id_patient"=>$_POST["id_patient"]
        );

    $unControleur->setTable("operation");
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=5"); 
}

$unControleur->setTable("voperation");
$LesOperations  = $unControleur->selectAll(); 

require_once ("vue/les_operations.php"); 


?>


        <!-- Début insert -->

        <!-- Fin insert -->
   

    <!-- Début All -->

    
    <!-- Fin All -->

		
	</div>
	
	<div class="col-2"></div>

</div>

