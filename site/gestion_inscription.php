
<?php

use \Defuse\Crypto\Crypto;
use \Defuse\Crypto\Key;
require "vendor/autoload.php";
$LePatient=NULL;

$unControleur->setTable("medecin");
$lesMedecins = $unControleur->selectAll();

$unControleur->setTable("categorie_secu");
$lesCategories_secu = $unControleur->selectAll();

$unControleur->setTable("patient");



require_once("vue/inscription.php");


if (isset($_POST['sInscrire']))
{
     
    $key = Key::createNewRandomKey();
    $key = $key->saveToAsciiSafeString();
    //$value = ['nom','prenom','email','tel','date_naissance','date_enregistrement','numrue','rue','cp','ville','id_medecin','id_cat_secu'];
    if($_POST['id_medecin']==0)
    {
        $tab=array(     
            "nom"=>$unControleur->encrypt($_POST["nom"],$key),
            "prenom"=>$unControleur->encrypt($_POST["prenom"],$key),
            "email"=>$_POST["email"],
            "tel"=>$unControleur->encrypt($_POST["tel"],$key),
            "date_naissance"=>$unControleur->encrypt($_POST["date_naissance"],$key),
            "date_enregistrement"=>$unControleur->encrypt(date('Y-m-d'),$key),
            "numrue"=>$unControleur->encrypt($_POST["numrue"],$key),
            "rue"=>$unControleur->encrypt($_POST["rue"],$key),
            "cp"=>$unControleur->encrypt($_POST["cp"],$key),
            "ville"=>$unControleur->encrypt($_POST["ville"],$key),
            "id_cat_secu"=>$_POST["id_cat_secu"],
            "mdp"=>$_POST["id_cat_secu"],
            "question_1"=>$_POST["question_1"],
            "question_2"=>$_POST["question_2"],
            "droits"=>"utilisateur",
            "blocage"=>"unlock",
            "reponse_secrete_1"=>$_POST["reponse_secrete_1"],
            "reponse_secrete_2"=>$_POST["reponse_secrete_2"],
            "numero_dossier"=>'a triggerer'
            );
    }else
    {
        $tab=array(     
            "nom"=>$unControleur->encrypt($_POST["nom"],$key),
            "prenom"=>$unControleur->encrypt($_POST["prenom"],$key),
            "email"=>$_POST["email"],
            "tel"=>$unControleur->encrypt($_POST["tel"],$key),
            "date_naissance"=>$unControleur->encrypt($_POST["date_naissance"],$key),
            "date_enregistrement"=>$unControleur->encrypt(date('Y-m-d'),$key),
            "numrue"=>$unControleur->encrypt($_POST["numrue"],$key),
            "rue"=>$unControleur->encrypt($_POST["rue"],$key),
            "cp"=>$unControleur->encrypt($_POST["cp"],$key),
            "ville"=>$unControleur->encrypt($_POST["ville"],$key),
            "id_medecin"=>$_POST['id_medecin'],
            "id_cat_secu"=>$_POST["id_cat_secu"],
            "mdp"=>$_POST["id_cat_secu"],
            "question_1"=>$_POST["question_1"],
            "question_2"=>$_POST["question_2"],
            "droits"=>"utilisateur",
            "blocage"=>"unlock",
            "reponse_secrete_1"=>$_POST["reponse_secrete_1"],
            "reponse_secrete_2"=>$_POST["reponse_secrete_2"],
            "numero_dossier"=>'a triggerer'
            );
    }


    $Verif = NULL; 
    $unControleur->insertValue($tab);
   

    $where = array("email"=>$_POST["email"]);
    $Verif=$unControleur->selectWhere($where);

    if($Verif){
        $tab2 = array("utilisateur"=>$_POST["email"],"cle"=>$key);
        $unControleur->callproc('genekey',$tab2);  
        echo 'Inscription reussie';  





            $where = array("email"=>$_POST["email"]);
            $unControleur->setTable("utilisateur");
            $unUser = $unControleur->selectWhere($where);
            $_SESSION['estPatient']=True;
            $_SESSION['estMedecin']=False;
            $_SESSION['estSecretaire']=False;
            $unControleur->setTable("medecin");
            $LeMedecin = $unControleur->selectWhere($where);
            if(isset($LeMedecin['email']))
            {
                $_SESSION['estMedecin']=True;
            }
            $unControleur->setTable("secretaire");
            $LeSecretaire = $unControleur->selectWhere($where);
            if(isset($LeSecretaire['email']))
            {
                $_SESSION['estSecretaire']=True;
            }
           

            if($_SESSION['estPatient']){
                $tab2=array($unUser['email']);
                $cle=$unControleur->callproc('getkey',$tab2);
                $_SESSION['cle'] = $cle['cle'];

                $_SESSION['nom'] =  $unControleur->decrypt($unUser['nom'], $_SESSION['cle']);
                $_SESSION['prenom'] = $unControleur->decrypt($unUser['prenom'], $_SESSION['cle']);
                $_SESSION['tel'] = $unControleur->decrypt($unUser['tel'], $_SESSION['cle']);
                $_SESSION['date_naissance'] = $unControleur->decrypt($unUser['date_naissance'], $_SESSION['cle']);
                $_SESSION['date_enregistrement'] = $unControleur->decrypt($unUser['date_enregistrement'], $_SESSION['cle']);
                $_SESSION['numrue'] = $unControleur->decrypt($unUser['numrue'], $_SESSION['cle']);
                $_SESSION['rue'] = $unControleur->decrypt($unUser['rue'], $_SESSION['cle']);
                $_SESSION['ville'] = $unControleur->decrypt($unUser['ville'], $_SESSION['cle']);
                $_SESSION['cp'] = $unControleur->decrypt($unUser['cp'], $_SESSION['cle']);
            }


            if($_SESSION['estMedecin'] or $_SESSION['estSecretaire'] ){
                $_SESSION['nom'] = $unUser['nom'];
                $_SESSION['prenom'] = $unUser['prenom'];
                $_SESSION['tel'] = $unUser['tel'];
                $_SESSION['date_naissance'] = $unUser['date_naissance'];
                $_SESSION['date_enregistrement'] = $unUser['date_enregistrement'];
                $_SESSION['numrue'] = $unUser['numrue'];
                $_SESSION['rue'] = $unUser['rue'];
                $_SESSION['ville'] = $unUser['ville'];
                $_SESSION['cp'] = $unUser['cp'];
            }





            $_SESSION['email'] = $unUser['email'];
            $_SESSION['id'] = $unUser['id'];
            $_SESSION['droits'] = $unUser['droits'];

            $tab= array($unUser['id']);
            $unControleur->callproc('unlockuser',$tab);		
            

            header("Location: index.php");	

    }         
}




?>


