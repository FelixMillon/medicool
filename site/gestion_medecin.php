<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des médecins </h2>
        <div class="d-flex justifiy-content-center" style="padding-top:6%">
            <div class="col-1"></div>
            <div class="col-4" style="padding-right:3%;"> 


<?php
$LeMedecin=NULL;

$unControleur->setTable("medecin");


if(isset($_GET['action']) && isset($_GET['id_medecin']))
{	
    $action = $_GET['action'];
    $id_medecin = $_GET['id_medecin'];
    $where = array("id_medecin"=>$id_medecin);
    switch($_GET['action'])
    {
        case 'sup':
            $unControleur->delete($where);
            break;
        case 'edit':
            $LeMedecin=$unControleur->selectWhere($where);
            break;
    }
}

require_once("vue/insert_medecin.php");

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
        "specialisation"=>$_POST["specialisation"],
        "date_depart_cabinet"=>$_POST["date_depart_cabinet"]
        );
    $unControleur->insertValue($tab); 
}


if(isset($_POST['Modifier']))
{
    $where = array("id_medecin"=>$id_medecin);
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
        "specialisation"=>$_POST["specialisation"],
        "date_depart_cabinet"=>$_POST["date_depart_cabinet"]
        );
    $unControleur->update ($tab, $where); 
    header("Location: index.php?page=21"); 
}

$unControleur->setTable("medecin");
$LesMedecins = $unControleur->selectAll(); 
require_once ("vue/les_medecins.php"); 

?>
	</div>
	

</div>

