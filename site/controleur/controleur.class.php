<?php 
	require_once ("modele/modele.class.php");
	class Controleur
	{
		private $unModele;
		public function __construct($serveur,$bdd,$user,$mdp)
		{
			$this->unModele = new Modele ($serveur, $bdd,$user,$mdp);
		}
		public function setTable($uneTable)
		{
			$this->unModele->setTable($uneTable);
		}
		public function selectAll()
		{
			return $this->unModele->selectAll();
		}
		public function insert($tab)
		{
			$this->unModele->insert($tab);
		}
		public function insertValue($tab)
		{
			$this->unModele->insertValue($tab);
		}
		public function insertnonull($tab)
		{
			$this->unModele->insertnonull($tab);
		}
		public function selectSearch($tab,$mot)
		{
			return $this->unModele->selectSearch($tab,$mot);
		}
		public function delete($where)
		{
			$this->unModele->delete($where);
		}
		public function count()
		{
			return $this->unModele->count();
		}
		public function selectWhere($where)
		{
			return $this->unModele->selectWhere($where);
		}
		public function countWhere($where)
		{
			return $this->unModele->countWhere($where);
		}
		public function update($tab, $where)
		{
			$vide = true;
			foreach ($tab as $cle => $valeur)
			{
				if($valeur != ""){
					$vide = false;
				}
			
			}
			if($vide == false){
				$this->unModele->update($tab, $where);
			}		
		}
		public function callproc($nom, $tab)
		{
			return $this->unModele->callproc($nom, $tab);
		}
		public function selectfunction($nom, $tab)
		{
			return $this->unModele->selectfunction($nom, $tab);
		}

		public function encrypt($message, $key)
		{
			return $this->unModele->encrypt($message, $key);
		} 

		public function decrypt($encrypted_message, $key)
		{
			return $this->unModele->decrypt($encrypted_message, $key);
		} 
	}
?>