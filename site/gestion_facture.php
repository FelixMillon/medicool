<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des factures </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:12%">
            <div class="col-2"></div>
            <div class="col-4" style="padding-right:3%;"> 


<?php
$LaFacture=NULL;

$unControleur->setTable("medecin");
$lesMedecins = $unControleur->selectAll();

$unControleur->setTable("patient");
$lesPatients = $unControleur->selectAll();

$unControleur->setTable("facture");




if(isset($_GET['action']) && isset($_GET['id_facture']))
{	
    $action = $_GET['action'];
    $id_facture = $_GET['id_facture'];
    $where = array("id_facture"=>$id_facture);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->delete($where);
            break;
        case 'edit':
            $LaFacture=$unControleur->selectWhere($where);
            break;
    }
}

require_once("vue/insert_facture.php");

if (isset($_POST['Valider']))
{
    $nom = "facturation";
    $tab=array(      
        "montant_total"=>$_POST["montant_total"],
        "id_patient"=>$_POST["id_patient"],
        "id_medecin"=>$_POST["id_medecin"],
        "libelle"=>$_POST["libelle"]
        );
    $unControleur->callproc($nom, $tab);; 
    
}


if(isset($_POST['Modifier']))
{
    $where = array("id_facture"=>$id_facture);
    $tab=array(      
        "montant_total"=>$_POST["montant_total"],
        "id_patient"=>$_POST["id_patient"],
        "id_medecin"=>$_POST["id_medecin"],
        "libelle"=>$_POST["libelle"]
        );
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=17"); 
}

$unControleur->setTable("facture");
$LesFactures = $unControleur->selectAll(); 
require_once ("vue/les_factures.php"); 

?>


        <!-- Début insert -->

        <!-- Fin insert -->
   

    <!-- Début All -->

    
    <!-- Fin All -->

		
	</div>
	
	<div class="col-2"></div>

</div>

