
        <!-- Début insert -->
        <form method="post" action="">
            <div class="container" >
                    <div class="col p-4 d-flex flex-column position-static">

                            <div class="row g-3">

                            <?php if($Loperation!=NULL){
                                    $tab2=array($Loperation['email']);
                                    $cle=$unControleur->callproc('getkey',$tab2);
                                    $cle = $cle['cle'];
                                }   
                                ?>
                            

                                
                                <div class="col-12">
                                    <input type="text" name="libelle" placeholder="Libelle" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php  if($Loperation!=NULL) echo $unControleur->decrypt($Loperation['libelle'], $cle); ?>">
                                </div>

                                <div class="col-6 fw-bolder" style="margin-top :3%;"> Date d'opération : </div>
                               
                            
                                <div class="col-6">
                                    <input type="datetime-local" id="peas" name="date_heure_time" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php if ($Loperation!=NULL) echo $Loperation['date_heure_time']; ?>">  
                                </div>

                                <div class="col-12">
                                    <input type="time" name="duree" placeholder="Durée" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB"
                                    value="<?php if ($Loperation!=NULL) echo $Loperation['duree']; ?>">
                                </div>

                                <div class="col-6">
                                    <input type="number" name="prix" placeholder="prix" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php if ($Loperation!=NULL) echo $Loperation['prix']; ?>">
                                </div>

                                <div class="col-6">
                                    <input type="text" name="resultat" placeholder="Resultat" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php  if($Loperation!=NULL) echo $unControleur->decrypt($Loperation['resultat'], $cle); ?>">
                                </div>

                                <div class="col-12">
                                    <input type="text" name="commentaire" placeholder="Commentaire" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php  if($Loperation!=NULL) echo $unControleur->decrypt($Loperation['commentaire'], $cle); ?>">
                                </div>

                                <div class="col-12">
                                <select name="id_patient" class="form-select w-100 text-center" style="border-radius:15px;border:3px solid #86B9BB">
                                    <option selected>Patient</option>
                                    <?php 
                                    foreach ($lesPatients as $unPatient){
                                        $tab2=array($unPatient['email']);
                                        $cle=$unControleur->callproc('getkey',$tab2);
                                        $cle = $cle['cle'];
                                        $prenom = $unControleur->decrypt($unPatient['prenom'], $cle);
                            
                                        echo "<option value='".$unPatient['id_patient']."'>".$unPatient['nom']." ".$prenom." </option>";
                                    }
                                    ?>
                                </select>
                                </div>

                    
                          

                  

                                
                                <div class="col-6" style="padding-top: 6%"> 
                                    <input class="btn btn-outline-danger btn-lg w-75 fw-bold" type="reset" name="Annuler" value="Annuler">
                                </div>
                                <div class="col-6" style="padding-top: 6%"> 
                                
                                    <input class="btn btn-outline-success btn-lg w-75 fw-bold" type="submit" 
                                    <?php if($Loperation!=NULL) echo 'name ="Modifier" value ="Modifier" '; else echo 'name="Valider" value ="Valider"'; ?> > 
                                </div>
                            </div>       
                    </div>
            </div>
        </form>
        <!-- Fin insert -->


    </div>
	<div class="col-4" style="padding-left:3%"> 
