
<?php

$unControleur->setTable("patient");
$LesPatients = $unControleur->selectAll(); 
require_once("vue/espace_medecin.php");


if (isset($_POST['Ouvrir']))
{
    $_SESSION['id_patient'] = $_POST["id"];
    if( $_SESSION['id_patient'] != "Patient"){
        header("Location: index.php?page=22");
    }
    
}


?>

