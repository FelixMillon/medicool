<!-- Début insert -->
<form method="post" action="">
<?php if($LePatient!=NULL){
        $tab2=array(hash('sha256',$LePatient['email']));
        $cle=$unControleur->callproc('getkey',$tab2);
        $cle = $cle['cle'];
    }   
    ?>

    <div class="container" >
        <div class="col p-4 d-flex flex-column position-static">
        <div class="row g-3">  
            <div class="col-6">
                <input type="text" name="nom" placeholder="Nom" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LePatient!=NULL) echo $unControleur->decrypt($LePatient['nom'], $cle); ?>">
            </div>
            <div class="col-6">
                <input type="text" name="prenom" placeholder="Prénom" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LePatient!=NULL) echo $unControleur->decrypt($LePatient['prenom'], $cle); ?>">
            </div>
            <div class="col-12">
                <input type="text" name="email" placeholder="E-mail" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LePatient!=NULL) echo $LePatient['email'] ?>">
            </div>


            <div class="col-4">
                <input type="text" name="tel" placeholder="Téléphone" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LePatient!=NULL) echo $unControleur->decrypt($LePatient['tel'], $cle); ?>">
            </div>

            <div class="col-4">
                <input type="date" name="date_naissance" placeholder="Date de naissance" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LePatient!=NULL) echo $unControleur->decrypt($LePatient['date_naissance'], $cle); ?>">
            </div>

            <div class="col-4">
                <input type="text" name="numrue" placeholder="Numéro de rue" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LePatient!=NULL) echo $unControleur->decrypt($LePatient['numrue'], $cle); ?>">
            </div>

            <div class="col-4">
                <input type="text" name="rue" placeholder="Rue" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LePatient!=NULL) echo $unControleur->decrypt($LePatient['rue'], $cle); ?>">
            </div>

            <div class="col-4">
                <input type="text" name="cp" placeholder="Code postal" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LePatient!=NULL) echo $unControleur->decrypt($LePatient['cp'], $cle); ?>">
            </div>

            <div class="col-4">
                <input type="text" name="ville" placeholder="Ville" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LePatient!=NULL) echo $unControleur->decrypt($LePatient['ville'], $cle); ?>">
            </div>

            <div class="col-6">
                <select name="id_medecin" class="form-select w-100 text-center" style="border-radius:15px;border:3px solid #86B9BB">
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
                    <option selected>Catégorie de sécurité sociale </option>
                    <?php 
                    foreach ($lesCategories_secu as $UneCategorie_secu){
                        echo "<option value='".$UneCategorie_secu['id_cat_secu']."'>".$UneCategorie_secu['libelle']." | ".$UneCategorie_secu['pourcent_rembourse']." </option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-6" style="padding-top: 6%"> 
                <input class="btn btn-outline-danger btn-lg w-75 fw-bold" type="reset" name="Annuler" value="Annuler" >
            </div>
            <div class="col-6" style="padding-top: 6%">          
                <input class="btn btn-outline-success btn-lg w-75 fw-bold" type="submit" 
                <?php if($LePatient!=NULL) echo 'name ="Modifier" value ="Modifier" '; else echo 'name="Valider" value ="Valider"'; ?>> 
            </div>
        </div>       
    </div>
    </div>
</form>
<!-- Fin insert -->

</div>
	<div class="col-7" style="padding-right:3%;"> 