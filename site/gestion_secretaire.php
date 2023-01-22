<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des secrétaires </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:6%">
            <div class="col-1"></div>
            <div class="col-4" style="padding-right:3%;"> 


<?php
$LaSecretaire=NULL;

$unControleur->setTable("secretaire");


if(isset($_GET['action']) && isset($_GET['id_secretaire']))
{	
    $action = $_GET['action'];
    $id_secretaire = $_GET['id_secretaire'];
    $where = array("id_secretaire"=>$id_secretaire);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->delete($where);
            break;
        case 'edit':
            $LaSecretaire=$unControleur->selectWhere($where);
            break;
    }
}

require_once("vue/insert_secretaire.php");

if (isset($_POST['Valider']))
{

    $tab=array(     
        "nom"=>$_POST["nom"],
        "prenom"=>$_POST["prenom"],
        "email"=>$_POST["email"],
        "tel"=>$_POST["tel"],
        "date_naissance"=>$_POST["date_naissance"],
        "date_enregistrement"=>date('Y-m-d'),
        "numrue"=>$_POST["numrue"],
        "rue"=>$_POST["rue"],
        "cp"=>$_POST["cp"],
        "ville"=>$_POST["ville"],
        "mdp"=>"Azerty@123",
        "question_1"=>"1",
        "question_2"=>"2",
        "reponse_secrete_1"=>"a remplacer",
        "reponse_secrete_2"=>"a remplacer",
        );
    $unControleur->insertValue($tab); 
}


if(isset($_POST['Modifier']))
{
    $where = array("id_secretaire"=>$id_secretaire);
    $tab=array(      
        "nom"=>$_POST["nom"],
        "prenom"=>$_POST["prenom"],
        "email"=>$_POST["email"],
        "tel"=>$_POST["tel"],
        "date_naissance"=>$_POST["date_naissance"],
        "numrue"=>$_POST["numrue"],
        "rue"=>$_POST["rue"],
        "cp"=>$_POST["cp"],
        "ville"=>$_POST["ville"],
        );
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=22"); 
}

$unControleur->setTable("secretaire");
$LesSecretaires = $unControleur->selectAll(); 
require_once ("vue/les_secretaires.php"); 

?>
	</div>
	

</div>

