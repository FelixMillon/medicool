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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> FireCrest - IHM</title>
</head>
<body class="">
<?php
      $unControleur->setTable("utilisateur"); 
      $lesUtilisateurs = $unControleur->selectAll();
      $unControleur->setTable("medecin"); 
      $lesMedecins = $unControleur->selectAll();
      $lesID = [];

      foreach($lesMedecins as $unMedecin){
      $lesID[count($lesID)]=$unMedecin['email'];
      }

			if(isset($_SESSION['email']) && in_array($_SESSION['email'], $lesID, true))
			{
				require_once ("header/header_connect.php");
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
	  case 3:  require_once("vue/planning.php");  break;
	  case 4:  require_once("vue/hospitalisation.php");  break;
	  case 5:  require_once("vue/operation.php");  break;
	  case 6:  require_once("vue/allergie.php");  break;
	  case 7:  require_once("vue/examen.php");  break;
	  case 8:  require_once("vue/operer.php");  break;
	  case 9:  require_once("vue/pathologie.php");  break;
	  case 10: require_once("vue/traitement.php");  break;
	  case 11: require_once("vue/espace_medecin.php");  break;
	  case 12: require_once("vue/espace_secretariat.php");  break;
	  case 13: require_once("vue/blocage.php");  break;
	  case 14: require_once("vue/question_secret.php"); break;
	  case 15: require_once("vue/nouveau_mdp.php"); break;
	  case 16: require_once("vue/code_email.php"); break;
    }
		?>
	</center>
</div>
<footer class="d-flex flex-wrap align-items-center justify-content-around justify-content-md-around py-4" style="background : #3B7476;">
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