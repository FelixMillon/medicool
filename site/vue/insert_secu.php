<!-- Début insert -->
<form method="post" action="">
    <div class="container" >
        <div class="col p-4 d-flex flex-column position-static">
        <div class="row g-3">  

            <div class="col-12">
                <input type="text" name="libelle" placeholder="Libellé" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LaSecu!=NULL) echo $LaSecu['libelle']; ?>">
            </div>

            <div class="col-6">
                <input type="number" step="any" min="0" name="pourcent_rembourse" placeholder="Prise en charge (%)" class="inscricase form-control text-center fw-bold" 
                style="border:3px solid #86B9BB" value="<?php if ($LaSecu!=NULL) echo $LaSecu['pourcent_rembourse']; ?>">
            </div>
        

            <div class="col-6" style="padding-top: 6%"> 
                <input class="btn btn-outline-danger btn-lg w-75 fw-bold" type="reset" name="Annuler" value="Annuler" >
            </div>
            <div class="col-6" style="padding-top: 6%">          
                <input class="btn btn-outline-success btn-lg w-75 fw-bold" type="submit" 
                <?php if($LaSecu!=NULL) echo 'name ="Modifier" value ="Modifier" '; else echo 'name="Valider" value ="Valider"'; ?>> 
            </div>
        </div>       
    </div>
    </div>
</form>
<!-- Fin insert -->

</div>
	<div class="col-7" style="padding-right:3%;"> 