<!-- Début insert -->
<form method="post" action="">
    <div class="container" >
        <div class="col p-4 d-flex flex-column position-static">
            <div class="row g-3">
                <div class="col-12">
                <?php if($LHospitalisation!=NULL){
                    $tab2=array($LHospitalisation['email']);
                    $cle=$unControleur->callproc('getkey',$tab2);
                    $cle = $cle['cle'];
                }   
                ?>

                    <input type="text" name="raison" placeholder="Raison" class="inscricase form-control text-center fw-bold" 
                    style="border:3px solid #86B9BB" value="<?php if ($LHospitalisation!=NULL) echo $unControleur->decrypt($LHospitalisation['raison'], $cle); ?>">
                </div>

                <div class="col-4 fw-bold">Date de début</div>
                <div class="col-4 fw-bold">Date de fin estimée</div>    
                <div class="col-4 fw-bold">Date de fin</div>
            
                <div class="col-4">
                    <input type="date" name="date_debut" placeholder="Raison" class="inscricase form-control text-center fw-bold" 
                    style="border:3px solid #86B9BB" value="<?php if ($LHospitalisation!=NULL) echo $LHospitalisation['date_debut']; ?>">                
                </div>	
                <div class="col-4">
                    <input type="date" name="date_fin_estimee" placeholder="Raison" class="inscricase form-control text-center fw-bold" 
                    style="border:3px solid #86B9BB" value="<?php if ($LHospitalisation!=NULL) echo $LHospitalisation['date_fin_estimee']; ?>">                
                </div>	
                <div class="col-4">
                    <input type="date" name="date_fin" placeholder="Raison" class="inscricase form-control text-center fw-bold" 
                    style="border:3px solid #86B9BB" value="<?php if ($LHospitalisation!=NULL) echo $LHospitalisation['date_fin']; ?>">
                </div>

                <div class="col-4">
                <select name="id_hopital" class="form-select w-100 text-center" style="border-radius:15px;border:3px solid #86B9BB">
                    <option selected>Hopital</option>
                    <?php 
				    foreach ($lesHopitals as $unHopital){
					    echo "<option value='".$unHopital['id_hopital']."'>".$unHopital['nom']." </option>";
				    }
				    ?>
                </select>
                </div>

                <div class="col-4">
                <select name="id_medecin" class="form-select w-100 text-center" style="border-radius:15px;border:3px solid #86B9BB">
                    <option selected>Médecin</option>
                    <?php
                        foreach ($lesMedecins as $unMedecin){
                            echo "<option value='".$unMedecin['id_medecin']."'>".$unMedecin['nom']." ".$unMedecin['prenom']." </option>";
                        }			    
				    ?>
                </select>
                </div>

                <div class="col-4">
                <select name="id_patient" class="form-select w-100 text-center" style="border-radius:15px;border:3px solid #86B9BB">
                    <option selected>Patient</option>
                    <?php 
				    foreach ($lesPatients as $unPatient){
					    echo "<option value='".$unPatient['id_patient']."'>".$unPatient['nom']." ".$unPatient['prenom']." </option>";
				    }
				    ?>
                </select>
                </div>
          
                <div class="col-6" style="padding-top: 6%"> 
                    <input class="btn btn-outline-danger btn-lg w-75 fw-bold" type="submit" name="Annuler" value="Annuler">
                </div>
                <div class="col-6" style="padding-top: 6%"> 
                    <input class="btn btn-outline-success btn-lg w-75 fw-bold" type="submit" 
                    <?php if($LHospitalisation!=NULL) echo 'name ="Modifier" value ="Modifier" '; else echo 'name="Valider" value ="Valider"'; ?> >  
                </div>
            </div>       
        </div>
    </div>
</form>
<!-- Fin insert -->
</div>
<div class="col-4" style="padding-left:3%"> 

