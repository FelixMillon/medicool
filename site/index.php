<?php
  session_start();
  ob_start();
	require_once("controleur/config_bdd.php");
	require_once("controleur/controleur.class.php");
	$unControleur = new Controleur($serveur,$bdd,$user,$mdp);
?>

<!DOCTYPE html>
<html>
<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="js/style.css">
    <link rel="stylesheet" href="js/style_ambrine.css">
	<link rel="stylesheet" href="js/felix.css">

	<link rel="icon" type="image/png" sizes="16x16" href="img/icon.png">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" http-equiv="X-UA-Compatible" content="IE=edge" name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Médicool</title>
</head>
<body class="">
<?php
	if(!isset($_SESSION['jour']))
	{
		$date = new DateTime();
		$date->setISODate($date->format('o'), $date->format('W'), 1);
		$_SESSION['jour'] = $date;
	}
	$unControleur->setTable("utilisateur"); 
	$lesUtilisateurs = $unControleur->selectAll();
	$unControleur->setTable("medecin"); 
	$lesMedecins = $unControleur->selectAll();
	$unControleur->setTable("patient"); 
	$lesPatients = $unControleur->selectAll();
	$lesIDMedecins = [];
	$lesIDPatients = [];

	foreach($lesMedecins as $unMedecin){
	$lesIDMedecins[count($lesIDMedecins)]=$unMedecin['email'];
	}

	foreach($lesPatients as $unPatient){
	$lesIDPatients[count($lesIDPatients)]=$unPatient['email'];
	}
	

		if(isset($_SESSION['email']) && $_SESSION['estSecretaire'])
		{
			require_once ("header/header_connect_sec.php");			
		}else if(isset($_SESSION['email']) && $_SESSION['estMedecin'])
		{
			require_once ("header/header_connect_med.php");			
		}else if(isset($_SESSION['email']) && $_SESSION['estPatient']) {
			require_once ("header/header_connect_patient.php");
		}else{
			require_once ("header/header_prospec.php");
		}

		?>

	<center>

		<?php

			if(isset($_GET['page']))
			{
				$page = $_GET['page'];
			}else{
				$page = 0;
			}
    switch ($page) {

      case 0: require_once ("vue/home.php"); break;
      
      case 100: unset($_SESSION);
      session_destroy();
      header("Location: index.php");

	  

      default : require_once("vue/home.php");  break;
	  case 1:  require_once("gestion_connexion.php");  break;
	  case 2:  require_once("vue/espace_patient.php");  break;
	  case 3:  require_once("gestion_planning.php");  break;
	  case 4:  require_once("gestion_hospitalisation.php");  break;
	  case 5:  require_once("gestion_operation.php");  break;
	  case 6:  require_once("gestion_allergie.php");  break;
	  case 7:  require_once("gestion_examen.php");  break;
	  case 8:  require_once("vue/operer.php");  break;
	  case 9:  require_once("gestion_pathologie.php");  break;
	  case 10: require_once("gestion_traitement.php");  break;
	  case 11: require_once("gestion_espace_medecin.php");  break;
	  case 12: require_once("vue/espace_secretariat.php");  break;
	  case 13: require_once("vue/blocage.php");  break;
	  case 14: require_once("vue/question_secret.php"); break;
	  case 15: require_once("vue/nouveau_mdp.php"); break;
	  case 16: require_once("vue/code_email.php"); break;
	  case 17: require_once("gestion_facture.php"); break;
	  case 18: require_once("gestion_correspondance.php"); break;
	  case 19: require_once("gestion_patient.php"); break;
	  case 20: require_once("vue/changement_info.php"); break;
	  case 21: require_once("gestion_inscription.php"); break;
	  case 22:  require_once("vue/espace_patient_med.php");  break;
	  case 23: require_once("gestion_medecin.php"); break;
	  case 24: require_once("gestion_secretaire.php"); break;
      case 999: require_once("insert_into_bdd.php"); break;


    }
		?>
	</center>
</div>
<footer class="d-flex flex-wrap align-items-center justify-content-around justify-content-md-around py-2" style="background : #3B7476;">
	<p class="col-md-4 mb-0 text-light" style="padding-left: 6%; white-space: nowrap;" >©Copyright 2022 FireCrest</p>

	<a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
	<svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
	</a>

	<ul class="nav col-md-4 justify-content-end" style="padding-right: 6%; white-space: nowrap;">
	<li class="nav-item"><a href="#" class="nav-link px-2 text-light">Mentions légales</a></li>
	<li class="nav-item"><a href="#" class="nav-link px-2 text-light">Conditions générle d'uilisation</a></li>
	</ul>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="js/gestion_cookie.js"></script>
</footer>
</body>
</html>