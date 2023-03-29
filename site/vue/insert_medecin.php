<!-- Début insert -->
<form method="post" action="">
    <div class="container" >
        <div class="col p-4 d-flex flex-column position-static">
        <div class="row g-3">  

            <div class="col-6">
                <input type="text" name="nom" placeholder="Nom" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LeMedecin!=NULL) echo $LeMedecin['nom']; ?>">
            </div>

            <div class="col-6">
                <input type="text" name="prenom" placeholder="Prénom" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LeMedecin!=NULL) echo $LeMedecin['prenom']; ?>">
            </div>

            <div class="col-12">
                <input type="text" name="email" placeholder="E-mail" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LeMedecin!=NULL) echo $LeMedecin['email']; ?>">
            </div>


            <div class="col-4">
                <input type="text" name="tel" placeholder="Téléphone" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LeMedecin!=NULL) echo $LeMedecin['tel']; ?>">
            </div>

            <div class="col-4">
                <input type="date" name="date_naissance" placeholder="Date de naissance" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LeMedecin!=NULL) echo $LeMedecin['date_naissance']; ?>">
            </div>

            <div class="col-4">
                <input type="text" name="numrue" placeholder="Numéro de rue" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LeMedecin!=NULL) echo $LeMedecin['numrue']; ?>">
            </div>

            <div class="col-4">
                <input type="text" name="rue" placeholder="Rue" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LeMedecin!=NULL) echo $LeMedecin['rue']; ?>">
            </div>

            <div class="col-4">
                <input type="text" name="cp" placeholder="Code postal" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LeMedecin!=NULL) echo $LeMedecin['cp']; ?>">
            </div>

            <div class="col-4">
                <input type="text" name="ville" placeholder="Ville" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LeMedecin!=NULL) echo $LeMedecin['ville']; ?>">
            </div>
            
            <div class="col-4">
                <input type="text" name="specialisation" placeholder="Spécialisation" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LeMedecin!=NULL) echo $LeMedecin['specialisation']; ?>">
            </div>
            
            <div class="col-4">
                <input type="date" name="date_depart_cabinet" placeholder="Date de départ" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LeMedecin!=NULL) echo $LeMedecin['date_depart_cabinet']; ?>">
            </div>

        

            <div class="col-6" style="padding-top: 6%"> 
                <input class="btn btn-outline-danger btn-lg w-75 fw-bold" type="reset" name="Annuler" value="Annuler" >
            </div>
            <div class="col-6" style="padding-top: 6%">          
                <input class="btn btn-outline-success btn-lg w-75 fw-bold" type="submit" 
                <?php if($LeMedecin!=NULL) echo 'name ="Modifier" value ="Modifier" '; else echo 'name="Valider" value ="Valider"'; ?>> 
            </div>
        </div>       
    </div>
    </div>
</form>
<!-- Fin insert -->

</div>
	<div class="col-7" style="padding-right:3%;"> 