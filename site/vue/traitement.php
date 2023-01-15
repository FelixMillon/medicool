 
 <div style="display: flex; flex-direction: column; height: 87vh;"> 
    <h2 class="d-flex align-items-center text-light fw-bold text-start" style="padding-left : 10%;background: #86B9BB; height:7vh" >Gestion des traitements </h2>
<div class="d-flex justifiy-content-center" style="padding-top:12%">
    <div class="col-2"></div>
    <div class="col-4" style="padding-right:3%;"> 

        <!-- Début insert -->
        <form method="post" action="">
            <div class="container" >
                    <div class="col p-4 d-flex flex-column position-static">

                            <div class="row g-3">         
                                <div class="col-6">
                                    <input type="text" name="raison" placeholder="Libelle" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" value="">
                                </div>

                                <div class="col-6">
                                    <input type="text" name="posologie" placeholder="Posologie" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" value="">
                                </div>

                                <div class="col-6 fw-bold">Date de début</div>
                                    
                                <div class="col-6 fw-bold">Date de fin</div>
                            
                                <div class="col-6">
                                    <input type="date" name="datedebut" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" value="" > 
                                </div>	
                                <div class="col-6">
                                    <input type="date" name="datefin" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" value="" > 
                                </div>

                                <div class="col-12">
                                    <input type="number" name="prix_par_unite" placeholder="Prix par unite" class="inscricase form-control text-center fw-bold" style="border:3px solid #86B9BB" value="">
                                </div>
                                          
                                <div class="col-6" style="padding-top: 6%"> 
                                    <input class="btn btn-outline-danger btn-lg w-75 fw-bold" type="reset" name="Annuler" value="Annuler">
                                </div>
                                <div class="col-6" style="padding-top: 6%"> 
                                    <input class="btn btn-outline-success btn-lg w-75 fw-bold" type="submit"> 
                                </div>
                            </div>       
                    </div>
            </div>
        </form>
        <!-- Fin insert -->


    </div>
	<div class="col-4" style="padding-left:3%"> 

    <div class="table-responsive w-100" style="height:40vh;border : 4px solid #86B9BB;  border-radius: 10px;">
        <table class="table table-striped table-sm" >
            <tr class="text-center fw-bold text-light" style="background:#86B9BB;opacity : 0.57; border-bottom: 4px solid  #86B9BB; ">
                <td>ID</td>
                <td>Libelle</td>
                <td>Posologie</td>
                <td>Date début</td>
                <td>Date fin </td>
                <td>prix par unité</td>
                <td>Opération</td>
            </tr>
            
            <tr class="text-center"> 
                <td > 1 </td>
                <td>Maladie E</td>
                <td></td> 
                <td>15/06/2022</td> 
                <td>22/06/2022</td> 
                <td>15.02</td> 
                <td></td> 
            </tr>

        </table>
</div>


		
	</div>
	
	<div class="col-2"></div>

</div>

