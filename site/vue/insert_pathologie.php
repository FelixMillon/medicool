        <!-- Début insert -->
    <div class="col-4" style="padding-right:3%;"> 
        <form method="post" action="">
            <div class="container" >
                    <div class="col p-4 d-flex flex-column position-static">

                            <div class="row g-3">
                            
                                <div class="col-12">
                                
                                <?php if($Lapathologie!=NULL){
                                    $tab2=array(hash('sha256',$Lapathologie['email']));
                                    $cle=$unControleur->callproc('getkey',$tab2);
                                    $cle = $cle['cle'];
                                }   
                                ?>

                                    <input type="text" name="libelle" placeholder="Libellé" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB"
                                    value="<?php if($Lapathologie!=NULL) echo $unControleur->decrypt($Lapathologie['libelle'], $cle); ?>">
                                </div>

                                <div class="col-6 fw-bold">Date de diagnostic</div>
                                    
                                <div class="col-6 fw-bold">Date de guérison</div>
                            
                                <div class="col-6">
                                    <input type="date" name="date_diagnostique" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php if ($Lapathologie!=NULL) echo $Lapathologie['date_diagnostique']; ?>"> 
                                </div>	
                                <div class="col-6">
                                    <input type="date" name="date_guerison" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                                    value="<?php if ($Lapathologie!=NULL) echo $Lapathologie['date_guerison']; ?>"> 
                                </div>
                                
                                <div class="col-6" style="padding-top: 6%"> 
                                    <input class="btn btn-outline-danger btn-lg w-75 fw-bold" type="reset" name="Annuler" value="Annuler">
                                </div>
                                <div class="col-6" style="padding-top: 6%"> 
                                <input class="btn btn-outline-success btn-lg w-75 fw-bold" type="submit" 
                                <?php if($Lapathologie!=NULL) echo 'name ="Modifier" value ="Modifier" '; else echo 'name="Valider" value ="Valider"'; ?> > 
                                </div>
                                
                            </div>       
                    </div>
            </div>
        </form>
        <!-- Fin insert -->
    </div>
