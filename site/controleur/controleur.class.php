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

		public function RefreshHospitals()
        {
            if(file_exists("json/hopitaux.json"))
            {
                $f = fopen ("json/hopitaux.json", "r"); 
                $octet=filesize("json/hopitaux.json");
                if ($octet!=0 and $f!= null)
                {
                    $lesHopitauxJson = file_get_contents("json/hopitaux.json");
                    $lesHopitaux = json_decode($lesHopitauxJson, true);
                    foreach($lesHopitaux as $unHopital)
                    {
						if($unHopital['fields']['raison_sociale_entite_juridique']!=null
						and $unHopital['fields']['num_voie']!=null
						and $unHopital['fields']['voie']!=null
						and $unHopital['fields']['cp_ville']!=null
						and $unHopital['fields']['raison_sociale']!=null)
						{
							$tab= array(
								"nom"=>$unHopital['fields']['raison_sociale_entite_juridique'],
								"numrue"=>$unHopital['fields']['num_voie'],
								"rue"=>$unHopital['fields']['voie'],
								"cp"=>substr($unHopital['fields']['cp_ville'],0,5),
								"ville"=>substr($unHopital['fields']['cp_ville'],6,-1),
								"specialisation"=>$unHopital['fields']['raison_sociale']
							);
							$this->unModele->setTable('hopital');
							$this->unModele->insert($tab);
							print("hopital inséré <br>");
						}
						
                    }
                }
                fclose($f);
            }
        }
	}
?>