<!-- Début insert -->
<div class="col-4" style="padding-right:3%;"> 
    <form method="post" action="">
        <div class="container" >
            <div class="col p-4 d-flex flex-column position-static">
            <div class="row g-3">                       
                    <div class="col-12">

                    <?php if($LAllergie!=NULL){
                        $tab2=array(hash('sha256',$LAllergie['email']));
                        $cle=$unControleur->callproc('getkey',$tab2);
                        $cle = $cle['cle'];
                    }   
                    ?>
                        <input type="text" name="libelle" placeholder="Libelle" class="inscricase form-control text-center fw-bold" 
                        style="border:3px solid #86B9BB" value="<?php if($LAllergie!=NULL) echo $unControleur->decrypt($LAllergie['libelle'], $cle); ?>">
                    </div>
                
                    <div class="col-12">
                            <label for="peas" class="fw-bold">Date du diagnostic :</label>
                        <input type="date" id="peas" name="date_diagnostique" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                        value="<?php if ($LAllergie!=NULL) echo $LAllergie['date_diagnostique']; ?>"> 
                    </div>

                    <div class="col-12">
                            <label for="peas" class="fw-bold">Date de guérison :</label>
                        <input type="date" id="peas" name="date_guerison" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                        value="<?php if ($LAllergie!=NULL) echo $LAllergie['date_guerison']; ?>"> 
                    </div>

                        
                    <div class="col-6" style="padding-top: 6%"> 
                        <input class="btn btn-outline-danger btn-lg w-75 fw-bold" type="reset" name="Annuler" value="Annuler">
                    </div>
                    <div class="col-6" style="padding-top: 6%"> 
                    
                        <input class="btn btn-outline-success btn-lg w-75 fw-bold" type="submit" 
                        <?php if($LAllergie!=NULL) echo 'name ="Modifier" value ="Modifier" '; else echo 'name="Valider" value ="Valider"'; ?> > 
                    </div>
                </div>       
            </div>
        </div>
    </form>
<!-- Fin insert -->
</div>
