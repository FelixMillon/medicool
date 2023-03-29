<div class="col-4" style="padding-right:3%;"> 
        <!-- Début insert -->
        <form method="post" action="">
            <div class="container" >
                    <div class="col p-4 d-flex flex-column position-static">

                            <div class="row g-3">

                            <?php if($Loperation!=NULL){
                                    $tab2=array(hash('sha256',$Loperation['email']));
                                    $cle=$unControleur->callproc('getkey',$tab2);
                                    $cle = $cle['cle'];
                                }   
                                ?>
                            

                                
                                <div class="col-12">
                                    <input type="text" name="libelle" placeholder="Libellé" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php  if($Loperation!=NULL) echo $unControleur->decrypt($Loperation['libelle'], $cle); ?>">
                                </div>

                                <div class="col-6 fw-bolder" style="margin-top :3%;"> Date d'opération : </div>
                               
                            
                                <div class="col-6">
                                    <input type="datetime-local" id="peas" name="date_heure_time" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php if ($Loperation!=NULL) echo $Loperation['date_heure_time']; ?>">  
                                </div>

                                <div class="col-6 fw-bolder" style="margin-top :3%;"> Durée de l'opération : </div>

                                <div class="col-6">
                                    <input type="time" name="duree" placeholder="Durée" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB"
                                    value="<?php if ($Loperation!=NULL) echo $Loperation['duree']; ?>">
                                </div>

                                <div class="col-6">
                                    <input type="number" name="prix" placeholder="Prix" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php if ($Loperation!=NULL) echo $Loperation['prix']; ?>">
                                </div>

                                <div class="col-6">
                                    <input type="text" name="resultat" placeholder="Résultats" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php  if($Loperation!=NULL) echo $unControleur->decrypt($Loperation['resultat'], $cle); ?>">
                                </div>

                                <div class="col-12">
                                    <input type="text" name="commentaire" placeholder="Commentaire" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php  if($Loperation!=NULL) echo $unControleur->decrypt($Loperation['commentaire'], $cle); ?>">
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


