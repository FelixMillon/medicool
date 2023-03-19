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

				if($_SESSION['estPatient']){
					$tab2=array($unUser['email']);
					$cle=$unControleur->callproc('getkey',$tab2);
					$_SESSION['cle'] = $cle['cle'];

					$_SESSION['nom'] =   $unControleur->decrypt($unUser['nom'], $_SESSION['cle']);
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