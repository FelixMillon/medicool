<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des examens </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:12%">
            <div class="col-2"></div>
            <div class="col-4" style="padding-right:3%;"> 


<?php





$LExamen=NULL;


$unControleur->setTable("medecin");
$lesMedecins = $unControleur->selectAll();

$unControleur->setTable("patient");
$lesPatients = $unControleur->selectAll();

$unControleur->setTable("examen");




if(isset($_GET['action']) && isset($_GET['id_examen']))
{	
    $action = $_GET['action'];
    $id_examen = $_GET['id_examen'];
    $where = array("id_examen"=>$id_examen);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->delete($where);
            break;
        case 'edit':
            $LExamen=$unControleur->selectWhere($where);
            break;
    }
}

require_once("vue/insert_examen.php");

if (isset($_POST['Valider']))
{
    $tab=array(      
        "libelle"=>$_POST["libelle"],
        "date"=>$_POST["date"],
        "prix_examen"=>$_POST["prix_examen"],
        "resultat"=>$_POST["resultat"],
        "commentaire"=>$_POST["commentaire"],
        "id_medecin"=>$_POST["id_medecin"],
        "id_patient"=>$_POST["id_patient"]
        );
    $unControleur->insert($tab); 
    
}


if(isset($_POST['Modifier']))
{
    $where = array("id_examen"=>$id_examen);
    $tab=array(
        "libelle"=>$_POST["libelle"],
        "date"=>$_POST["date"],
        "prix_examen"=>$_POST["prix_examen"],
        "resultat"=>$_POST["resultat"],
        "commentaire"=>$_POST["commentaire"],
        "id_medecin"=>$_POST["id_medecin"],
        "id_patient"=>$_POST["id_patient"]
        );
    var_dump($tab);
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=7"); 
}

$unControleur->setTable("examen");
$LesExamens = $unControleur->selectAll(); 

require_once ("vue/les_examens.php"); 


?>


        <!-- Début insert -->

        <!-- Fin insert -->
   

    <!-- Début All -->

    
    <!-- Fin All -->

		
	</div>
	
	<div class="col-2"></div>

</div>

