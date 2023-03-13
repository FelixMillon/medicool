<?php

	require_once("vue/login.php");

	if(isset($_POST['seConnecter']))
	{
		$tab= array($_POST['email']);
		$remedles = $unControleur->selectfunction('remedless',$tab);
		$remedles =$remedles["result"].$_POST['mdp'];
		$mdp= hash('sha256',$remedles);
		$where = array('email'=>$_POST['email'] ,'mdp'=>$mdp);
		$unControleur->setTable("utilisateur");
		$unUser = $unControleur->selectWhere($where);
		if(isset($unUser['email']))
		{
			if($unUser['blocage']=='lock')
			{
				echo "<br/> Votre compte est bloqué, veuillez faire une demande de déblocage";
			}
			else
			{
				$_SESSION['estPatient']=False;
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
				$unControleur->setTable("patient");
				$lePatient = $unControleur->selectWhere($where);
				if(isset($lePatient['email']))
				{
					$_SESSION['estPatient']=True;
				}
				$_SESSION['email'] = $unUser['email'];
				$_SESSION['nom'] = $unUser['nom'];
				$_SESSION['prenom'] = $unUser['prenom'];
				$_SESSION['id'] = $unUser['id'];
				$_SESSION['droits'] = $unUser['droits'];
				$tab= array($unUser['id']);
				$unControleur->callproc('unlockuser',$tab);		
				
				if($_SESSION['estPatient']){
					$tab2=array($_SESSION['email']);
					$cle=$unControleur->callproc('getkey',$tab2);
					$_SESSION['cle'] = $cle['cle'];
				}else{
					$_SESSION['cle']="admin";
				}

				header("Location: index.php");
			}
			
		}else{
			$where2 = array('email'=>$_POST['email']);
			$unUser = $unControleur->selectWhere($where2);
			if(isset($unUser['id']))
			{
				$tab=array(
					"etat_blocage"=>null, 
					"nb_essai_restant"=>null, 
					"date_heure_echec"=>null, 
					"id_utilisateur"=>$unUser['id']
					);
				$unControleur->setTable("nb_echec_co");
				$unControleur->insert($tab);
			}
			echo "<br/> Vérifiez vos identifiants";
		}
	}
?>