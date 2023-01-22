<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des allergies </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:12%">
            <div class="col-2"></div>
            <div class="col-4" style="padding-right:3%;"> 


<?php





$LAllergie=NULL;


$unControleur->setTable("medecin");
$lesMedecins = $unControleur->selectAll();

$unControleur->setTable("patient");
$lesPatients = $unControleur->selectAll();

$unControleur->setTable("allergie");




if(isset($_GET['action']) && isset($_GET['id_allergie']))
{	
    $action = $_GET['action'];
    $id_allergie = $_GET['id_allergie'];
    $where = array("id_allergie"=>$id_allergie);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->delete($where);
            break;
        case 'edit':
            $LAllergie=$unControleur->selectWhere($where);
            break;
    }
}

require_once("vue/insert_allergie.php");

if (isset($_POST['Valider']))
{
    $tab=array(      
        "libelle"=>$_POST["libelle"],
        "date_diagnostique"=>$_POST["date_diagnostique"],
        "date_guerison"=>$_POST["date_guerison"],
        "id_medecin"=>$_POST["id_medecin"],
        "id_patient"=>$_POST["id_patient"]
        );
    $unControleur->insert($tab); 
    
}


if(isset($_POST['Modifier']))
{
    $where = array("id_allergie"=>$id_allergie);
    $tab=array(
        "libelle"=>$_POST["libelle"],
        "date_diagnostique"=>$_POST["date_diagnostique"],
        "date_guerison"=>$_POST["date_guerison"],
        "id_medecin"=>$_POST["id_medecin"],
        "id_patient"=>$_POST["id_patient"]
        );
    var_dump($tab);
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=20"); 
}

$unControleur->setTable("allergie");
$LesAllergies = $unControleur->selectAll(); 

require_once ("vue/les_allergies.php"); 


?>


        <!-- Début insert -->

        <!-- Fin insert -->
   

    <!-- Début All -->

    
    <!-- Fin All -->

		
	</div>
	
	<div class="col-2"></div>

</div>

