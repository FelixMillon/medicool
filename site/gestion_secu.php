<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des mutuelles </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:6%">
            <div class="col-1"></div>
            <div class="col-4" style="padding-right:3%;"> 


<?php
$LaSecu=NULL;

$unControleur->setTable("categorie_secu");


if(isset($_GET['action']) && isset($_GET['id_cat_secu']))
{	
    $action = $_GET['action'];
    $id_cat_secu = $_GET['id_cat_secu'];
    $where = array("id_cat_secu"=>$id_cat_secu);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->delete($where);
            break;
        case 'edit':
            $LaSecu=$unControleur->selectWhere($where);
            break;
    }
}

require_once("vue/insert_secu.php");

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
    $where = array("id_cat_secu"=>$id_cat_secu);
    $tab=array(      
        "libelle"=>$_POST["libelle"],
        "pourcent_rembourse"=>$_POST["pourcent_rembourse"]
        );
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=24"); 
}

$unControleur->setTable("categorie_secu");
$LesSecus = $unControleur->selectAll(); 
require_once ("vue/les_secus.php"); 

?>
	</div>
	

</div>

