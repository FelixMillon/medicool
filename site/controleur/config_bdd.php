<?php
if(PHP_OS == 'WINNT')
{
	$serveur ="localhost";
	$bdd = "bdd_anti_gaspi";
	$user="root";
	$mdp="";
}elseif(PHP_OS== 'Darwin')
{
	$serveur ="localhost:8889";
	$bdd = "bdd_anti_gaspi";
	$user="root";
	$mdp="root";
}elseif(PHP_OS== 'Linux')
{
	$serveur ="localhost";
	$bdd = "bdd_anti_gaspi";
	$user="root";
	$mdp="";
}

?>