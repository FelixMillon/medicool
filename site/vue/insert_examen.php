<!-- Début insert -->
<div class="col-4" style="padding-right:3%;"> 
    <form method="post" action="">
        <div class="container" >
            <div class="col p-4 d-flex flex-column position-static">
            <div class="row g-3">                       
                    <div class="col-12">

                    <?php if($LExamen!=NULL){
                        $tab2=array(hash('sha256',$LExamen['email']));
                        $cle=$unControleur->callproc('getkey',$tab2);
                        $cle = $cle['cle'];
                    }   
                    ?>


                        <input type="text" name="libelle" placeholder="Libelle" class="inscricase form-control text-center fw-bold" 
                        style="border:3px solid #86B9BB" value="<?php if ($LExamen!=NULL) echo $unControleur->decrypt($LExamen['libelle'], $cle); ?>">
                    </div>
                
                    <div class="col-12">
                            <label for="peas" class="fw-bold">Date d'examen :</label>
                        <input type="date" id="peas" name="date" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                        value="<?php if ($LExamen!=NULL) echo $LExamen['date']; ?>"> 
                    </div>

                    <div class="col-6">
                        <input type="number" name="prix_examen" placeholder="prix" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB"
                        value="<?php if ($LExamen!=NULL) echo $LExamen['prix_examen']; ?>"> 
                    </div>

                    <div class="col-6">
                        <input type="text" name="resultat" placeholder="Resultat" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                        value="<?php if ($LExamen!=NULL) echo $unControleur->decrypt($LExamen['resultat'], $cle); ?>"> 
                        
                    </div>

                    <div class="col-12">
                        <input type="text" name="commentaire" placeholder="Commentaire" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" 
                        value="<?php if ($LExamen!=NULL) echo $unControleur->decrypt($LExamen['commentaire'], $cle); ?>">
                    </div>
                        
                    <div class="col-6" style="padding-top: 6%"> 
                        <input class="btn btn-outline-danger btn-lg w-75 fw-bold" type="reset" name="Annuler" value="Annuler">
                    </div>
                    <div class="col-6" style="padding-top: 6%"> 
                    
                        <input class="btn btn-outline-success btn-lg w-75 fw-bold" type="submit" 
                        <?php if($LExamen!=NULL) echo 'name ="Modifier" value ="Modifier" '; else echo 'name="Valider" value ="Valider"'; ?> > 
                    </div>
                </div>       
            </div>
        </div>
    </form>
<!-- Fin insert -->

</div>