<?php
require_once("vue/login.php");
	$unControleur->setTable("utilisateur");
	

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
			$_SESSION['email'] = $unUser['email'];
			$_SESSION['nom'] = $unUser['nom'];
			$_SESSION['prenom'] = $unUser['prenom'];
			$_SESSION['id'] = $unUser['id'];
			$_SESSION['droits'] = $unUser['droits'];
			header("Location: index.php");
		}else{
			echo "<br/> Vérifiez vos identifiants";
		}
	}
?>