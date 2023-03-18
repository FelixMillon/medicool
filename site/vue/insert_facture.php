<!-- Début insert -->
<form method="post" action="">
    <div class="container" >
        <div class="col p-4 d-flex flex-column position-static">
        <div class="row g-3">  
        <?php if($LaFacture!=NULL){
                    $tab2=array($LaFacture['email']);
                    $cle=$unControleur->callproc('getkey',$tab2);
                    $cle = $cle['cle'];
                }   
                ?> 
            
                <div class="col-6">
                    <select name="id_medecin" class="form-select w-100 text-center" style="border-radius:15px;border:3px solid #86B9BB">
                        <option selected>Médecin</option>
                        <?php
                            foreach ($lesMedecins as $unMedecin){
                                echo "<option value='".$unMedecin['id_medecin']."'>".$unMedecin['nom']." ".$unMedecin['prenom']." </option>";
                            }			    
                        ?>
                    </select>
                </div>

                <div class="col-6">
                    <select name="id_patient" class="form-select w-100 text-center" style="border-radius:15px;border:3px solid #86B9BB">
                        <option selected>Patient</option>
                        <?php 
                        foreach ($lesPatients as $unPatient){
                            echo "<option value='".$unPatient['id_patient']."'>".$unPatient['nom']." ".$unPatient['prenom']." </option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-12">
                    <input type="text" name="libelle" placeholder="Libelle" class="inscricase form-control text-center fw-bold" 
                    style="border:3px solid #86B9BB" value="<?php if($LaFacture!=NULL) echo $unControleur->decrypt($LaFacture['libelle'], $cle); ?>">
                </div>
        
                <div class="col-12">
                    <input type="number"  name="montant_total" placeholder="Montant total" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB"
                     value="<?php if ($LaFacture!=NULL) echo $LaFacture['montant_total']; ?>"> 
                </div>

                      
                <div class="col-6" style="padding-top: 6%"> 
                    <input class="btn btn-outline-danger btn-lg w-75 fw-bold" type="reset" name="Annuler" value="Annuler">
                </div>
                <div class="col-6" style="padding-top: 6%"> 
                
                    <input class="btn btn-outline-success btn-lg w-75 fw-bold" type="submit" 
                    <?php if($LaFacture!=NULL) echo 'name ="Modifier" value ="Modifier" '; else echo 'name="Valider" value ="Valider"'; ?> > 
                </div>
            </div>       
        </div>
    </div>
</form>
<!-- Fin insert -->

</div>
	<div class="col-4" style="padding-left:3%"> 