<?php
	class Modele
	{
		private $unPdo, $uneTable ;

		public function __construct ($serveur, $bdd, $user,$mdp)
		{
			$this->unPdo = null;
			try{
				$this->unPdo = new PDO("mysql:host=".$serveur.";dbname=".$bdd,$user,$mdp);
			}
			catch(PDOException $exp)
			{
				echo "Erreur de connexion : ".$exp->getMessage();
			}
		}

		public function setTable($uneTable)
		{
			$this->uneTable = $uneTable;
		}

		public function selectAll()
		{
			$requete="select * from ".$this->uneTable." ; ";
			$select= $this->unPdo->prepare($requete);
			$select->execute();
			return $select->fetchAll();
		}
		public function insert ($tab)
		{
			$champs =array();
			$donnees=array();
			foreach ($tab as $cle => $valeur)
			{
				if($valeur=="" or $valeur=="0000-00-00")
				{
					$champs[] = "null";
				}else{
					$champs[] = ":".$cle;
					$donnees[":".$cle] = $valeur;
				}
			}
			$chaineChamps = implode(",",$champs);
			$requete ="insert into ".$this->uneTable." values (null,".$chaineChamps.");";
			$insert = $this->unPdo->prepare($requete);
			$insert->execute($donnees);
		}

		public function insertValue ($tab)
		{
			$champs =array();
			$champs2 = array();
			$donnees=array();
			foreach ($tab as $cle => $valeur)
			{
				$champs[] = ":".$cle;
				$champs2[] = $cle;
				$donnees[":".$cle] = $valeur;
			}

			$chaineChamps = implode(",",$champs);
			$chaineChamps2 = implode(",",$champs2);
			$requete ="insert into ".$this->uneTable."($chaineChamps2) 
			values (".$chaineChamps.");";
			$insert = $this->unPdo->prepare($requete);
			$insert->execute($donnees);
		
			
		}


		public function insertnonull ($tab)
		{
			$champs =array();
			$donnees=array();
			foreach ($tab as $cle => $valeur)
			{
				$champs[] = ":".$cle;
				$donnees[":".$cle] = $valeur;
			}
			$chaineChamps = implode(",",$champs);
			$requete ="insert into ".$this->uneTable." values (".$chaineChamps.");";
			$insert = $this->unPdo->prepare($requete);
			$insert->execute($donnees);
		}
		public function selectSearch($tab,$mot)
		{
			$donnees = array(":mot"=>"%".$mot."%");
			$champs=array();
			foreach($tab as $cle)
			{
				$champs[] = $cle." like :mot";
			}
			$chaineWhere = implode(" or ", $champs);
			$requete="select * from ".$this->uneTable." where ".$chaineWhere.";";
			$select= $this->unPdo->prepare($requete);
			$select->execute($donnees);
			return $select->fetchAll();
		}
		public function delete($where)
		{
			$donnees=array();
			$champs=array();
			foreach($where as $cle => $valeur)
			{
				$champs[] = $cle." = :".$cle;
				$donnees[":".$cle] = $valeur;
			}
			$chaineWhere = implode(" and ", $champs);
			$requete ="delete from ".$this->uneTable." where ".$chaineWhere;
			$delete = $this->unPdo->prepare($requete);
			$delete->execute($donnees);
		}
		public function count()
		{
			$requete = "select count(*) as nb from ".$this->uneTable;
			$select = $this->unPdo->prepare($requete);
			$select->execute();
			return $select->fetch();
		}

		public function countWhere($where)
		{
			$donnees = array();
			$champs=array();
			foreach($where as $cle => $valeur)
			{
				$champs[] = $cle." = :".$cle;
				$donnees[":".$cle] = $valeur;
			}
			$chaineWhere = implode(" and ", $champs);
			$requete="select count(*) as nb from ".$this->uneTable." where ".$chaineWhere;
			$select=$this->unPdo->prepare($requete);
			$select->execute($donnees);
			return $select->fetch();
		}

		public function selectWhere($where)
		{
			$donnees = array();
			$champs=array();
			foreach($where as $cle => $valeur)
			{
				$champs[] = $cle." = :".$cle;
				$donnees[":".$cle] = $valeur;
			}
			$chaineWhere = implode(" and ", $champs);
			$requete="select * from ".$this->uneTable." where ".$chaineWhere;
			$select=$this->unPdo->prepare($requete);
			$select->execute($donnees);
			return $select->fetch();
		}

		public function update($tab,$where)
		{
			$donnees=array();
			$champs2=array();
			foreach ($tab as $cle => $valeur)
			{
				if($valeur != "" or $valeur=="0000-00-00"){
					$champs2[] = $cle." = :".$cle;
					$donnees[":".$cle] = $valeur;
				}		
			}
			$chaineChamps = implode(",",$champs2);
			$champs=array();
			foreach($where as $cle => $valeur)
			{
				$champs[] = $cle." = :".$cle;
				$donnees[":".$cle] = $valeur;
			}
			$chaineWhere = implode(" and ", $champs);
			$requete ="update ".$this->uneTable." set ".$chaineChamps." where ".$chaineWhere;

			$update = $this->unPdo->prepare($requete);
			$update->execute($donnees);

			var_dump($requete); var_dump($donnees); 
		}

		public function callproc($nom,$tab)
		{
			if($tab!=null)
			{
				$chaine="'".implode("','", $tab)."'";
				$requete ='call '.$nom.'('.$chaine.');';
			}else
			{
				$requete ='call '.$nom.'();';
			}
			$proc = $this->unPdo->prepare($requete);
			$proc->execute();
		    return $proc->fetch();
		}
		
		public function selectfunction($nom,$tab)
		{
			if($tab!=null)
			{
				$chaine="'".implode("','", $tab)."'";
				$requete ='select '.$nom.'('.$chaine.') as result;';
			}else
			{
				$requete ='select '.$nom.'();';
			}
			$select = $this->unPdo->prepare($requete);
			$select->execute();
			return $select->fetch();
		}

		public function encrypt($message, $key) {
			$iv_size = openssl_cipher_iv_length('AES-256-CBC');
			$iv = openssl_random_pseudo_bytes($iv_size);
			$encrypted = openssl_encrypt($message, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
			return base64_encode($iv . $encrypted);
		  }

		public function decrypt($encrypted_message, $key) {
			$encrypted = base64_decode($encrypted_message);
			$iv_size = openssl_cipher_iv_length('AES-256-CBC');
			$iv = substr($encrypted, 0, $iv_size);
			$encrypted = substr($encrypted, $iv_size);
			return openssl_decrypt($encrypted, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
		  }

	}
?>