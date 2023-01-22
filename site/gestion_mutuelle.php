<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des mutuelles </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:6%">
            <div class="col-1"></div>
            <div class="col-4" style="padding-right:3%;"> 


<?php
$LaMutuelle=NULL;

$unControleur->setTable("mutuelle");


if(isset($_GET['action']) && isset($_GET['id_mutuelle']))
{	
    $action = $_GET['action'];
    $id_mutuelle = $_GET['id_mutuelle'];
    $where = array("id_mutuelle"=>$id_mutuelle);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->delete($where);
            break;
        case 'edit':
            $LaMutuelle=$unControleur->selectWhere($where);
            break;
    }
}

require_once("vue/insert_mutuelle.php");

if (isset($_POST['Valider']))
{

    $tab=array(     
        "libelle"=>$_POST["libelle"],
        "pourcent_rembourse"=>$_POST["pourcent_rembourse"]
        );
    $unControleur->insertValue($tab); 
}


if(isset($_POST['Modifier']))
{
    $where = array("id_mutuelle"=>$id_mutuelle);
    $tab=array(      
        "libelle"=>$_POST["libelle"],
        "pourcent_rembourse"=>$_POST["pourcent_rembourse"]
        );
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=23"); 
}

$unControleur->setTable("mutuelle");
$LesMutuelles = $unControleur->selectAll(); 
require_once ("vue/les_mutuelles.php"); 

?>
	</div>
	

</div>

