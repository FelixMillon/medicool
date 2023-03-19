<style>
input::placeholder {
    font-weight: bold;
    opacity: .5;
}
body{
  justify-content: unset;
}

.form{
display: block;
width: 100%;
padding: .375rem .75rem;
font-size: 1rem;
font-weight: 400;
line-height: 1.5;
background-clip: padding-box;
border: 1px solid #ced4da;
-webkit-appearance: none;
-moz-appearance: none;
appearance: none;
border-radius: .25rem;
transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

</style>

<div class="row" style="margin : 0; padding-bottom : 5%;" >
	<div class="col-3"></div>
		<div class="col-6 text-light" > 
			<form method="post" class="d-flex flex-column bd-highlight" style="padding-top : 5%;">
				<div style="padding: 2% 5% 5% 5%; background:#86B9BB; border-radius:25px;"> 
					<img src="img/logo_login.png" class="bi me-2 img border" style="width: 10vw;" role="img" alt=""> 
					<div class="row justify-content-center">
						<div class="col-6 py-2"><input type="text" class="form text-center" name="nom" placeholder="Nom"></div> 
						<div class="col-6 py-2"><input type="text" class="form text-center" name="prenom" placeholder="Prénom"></div>
						<div class="col-6 py-2"><input type="text" class="form text-center" name="email" placeholder="Email"></div> 
						<div class="col-6 py-2"><input type="text" class="form text-center" name="tel" placeholder="Tel"></div> 
						<div class="col-6 py-3">Date de naissance</div> 
						<div class="col-6 py-2"><input type="date" class="form text-center" name="date_naissance"></div> 
						<div class="col-6 py-2"><input type="text" class="form text-center" name="numrue" placeholder="Numéro de rue"></div> 
						<div class="col-6 py-2"><input type="text" class="form text-center" name="rue" placeholder="Nom de la rue"></div> 
						<div class="col-6 py-2"><input type="text" class="form text-center" name="ville"  placeholder="Ville"></div> 
						<div class="col-6 py-2"><input type="text" class="form text-center" name="cp"  placeholder="Code postal"></div> 
						<div class="col-6 py-2"> 
							<select name="question_1"  class="form-select w-100 text-center" style="border-radius:15px; border:3px solid #86B9BB;">
								<option value="1">Nom de votre école primaire ?</option>
								<option value="2">Nom de jeune fille de votre mère ?</option>
								<option value="3">Nom de votre premier amour ?</option>
								<option value="4">Nom de votre professeur préféré ?</option>
								<option value="5">Ville de rencontre de vos parents ?</option>
								<option value="6">Nom de votre roman préféré ?</option>
							</select>
						</div>
						<div class="col-6 py-2"> 
							<select name="question_2"  class="form-select w-100 text-center" style="border-radius:15px; border:3px solid #86B9BB;">
								<option value="1">Nom de votre école primaire ?</option>
								<option value="2">Nom de jeune fille de votre mère ?</option>
								<option value="3">Nom de votre premier amour ?</option>
								<option value="4">Nom de votre professeur préféré ?</option>
								<option value="5">Ville de rencontre de vos parents ?</option>
								<option value="6">Nom de votre roman préféré ?</option>
							</select>
						</div>			
						<div class="col-6 py-2"><input type="text" class="form text-center" name="reponse_secrete_1"  placeholder="Reponse 1"></div> 
						<div class="col-6 py-2"><input type="text" class="form text-center" name="reponse_secrete_2"  placeholder="Reponse 2"></div>
						<div class="col-6">
							<select name="id_medecin" class="form-select w-100 text-center" style="border-radius:15px; border:3px solid #86B9BB;">
								<option 
								<?php
								if(isset($LePatient['id_medecin']))
								{
									$leid_medecin=$LePatient['id_medecin'];
								}else
								{
									$leid_medecin='0';
								}
									if ($LePatient!=NULL) echo "value='".$leid_medecin."'";
								?>
								selected>Médecin référent</option>
								<option value='0'>Aucun medecin référent</option>
								<?php
									foreach ($lesMedecins as $unMedecin){
										echo "<option value='".$unMedecin['id_medecin']."'>".$unMedecin['nom']." ".$unMedecin['prenom']."</option>";
									}			    
								?>
							</select>
						</div>
						<div class="col-6">
							<select name="id_cat_secu" class="form-select w-100 text-center" style="border-radius:15px;border:3px solid #86B9BB">
								<option selected>Catégorie sécurité social </option>
								<?php 
								foreach ($lesCategories_secu as $UneCategorie_secu){
									echo "<option value='".$UneCategorie_secu['id_cat_secu']."'>".$UneCategorie_secu['libelle']." | ".$UneCategorie_secu['pourcent_rembourse']." </option>";
								}
								?>
							</select>
						</div>
						<div class="col-6 py-2"><input type="text" class="form text-center" name="mdp"  placeholder="Mot de passe"></div> 
						<div class="col-6 py-2"><input type="text" class="form text-center" placeholder="Confirmer le mot de passe"></div> 

					</div>
					
					
		
					<div class="d-flex justify-content-center" style="width: 75%; padding:5% 13% 0px 13%;" > 
						<input type="submit" class="col-6 form" name="sInscrire" value="S'inscrire" style="margin-right : 5%; border : 5px solid white; border-radius: 15px; background : #3B7476">
						<input type="reset"  class="col-6 form" value="Annuler" style="margin-right : 5%; border : 5px solid white; border-radius: 15px; background : #3B7476">
					</div>
				
				</div>
			</form>
		</div>
	<div class="col-3"></div>
</div>