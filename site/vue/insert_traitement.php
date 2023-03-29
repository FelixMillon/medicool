
    <!-- Début insert -->
    <div class="col-4" style="padding-right:3%;"> 
        <form method="post" action="">
            <div class="container" >
                    <div class="col p-4 d-flex flex-column position-static">

                    <?php if($Letraitement!=NULL){
                    $tab2=array(hash('sha256',$Letraitement['email']));
                    $cle=$unControleur->callproc('getkey',$tab2);
                    $cle = $cle['cle'];
                    }   
                    ?>

                            <div class="row g-3">         
                                <div class="col-6">
                                    <input type="text" name="libelle" placeholder="Libelle" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php if($Letraitement!=NULL) echo $unControleur->decrypt($Letraitement['libelle'], $cle); ?>">
                                </div>

                                <div class="col-6">
                                    <input type="text" name="posologie" placeholder="Posologie" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php if ($Letraitement!=NULL) echo $Letraitement['posologie']; ?>"> 
                                </div>

                                <div class="col-6 fw-bold">Date de début</div>
                                    
                                <div class="col-6 fw-bold">Date de fin</div>
                            
                                <div class="col-6">
                                    <input type="date" name="date_debut" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php if ($Letraitement!=NULL) echo $Letraitement['date_debut']; ?>"> 
                                </div>	
                                <div class="col-6">
                                    <input type="date" name="date_fin" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php if ($Letraitement!=NULL) echo $Letraitement['date_fin']; ?>"> 
                                </div>

                                <div class="col-12">
                                    <input type="number" name="prix_par_unite" placeholder="Prix par unite" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php if ($Letraitement!=NULL) echo $Letraitement['prix_par_unite']; ?>"> 
                                </div>
                                       
                                <div class="col-6" style="padding-top: 6%"> 
                                    <input class="btn btn-outline-danger btn-lg w-75 fw-bold" type="reset" name="Annuler" value="Annuler">
                                </div>
                                <div class="col-6" style="padding-top: 6%"> 
                                
                                    <input class="btn btn-outline-success btn-lg w-75 fw-bold" type="submit" 
                                    <?php if($Letraitement!=NULL) echo 'name ="Modifier" value ="Modifier" '; else echo 'name="Valider" value ="Valider"'; ?> > 
                                </div>
                            </div>       
                    </div>
            </div>
        </form>
        <!-- Fin insert -->
    </div>

