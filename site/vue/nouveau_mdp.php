<style>


.form{
	display: block;
width: 100%;
padding: .375rem .75rem;
font-size: 1rem;
font-weight: 400;
line-height: 1.5;
color: #212529;
background-color: #fff;
background-clip: padding-box;
border: 1px solid #ced4da;
-webkit-appearance: none;
-moz-appearance: none;
appearance: none;
border-radius: 10px;
transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
background : white;
color : black;
}

.btn-blue{
    background:#86B9BB;  
    color : white;
}
</style>

<?php 
	if(isset($_POST['Suivants3']))
	{

        $where = array(
            'id'=>$_SESSION['id_recup']
        );

        $tab = array(
            'mdp'=>$_POST['mdp']
        );
           
		$unControleur->setTable("utilisateur");
        $unControleur->update ($tab, $where);
    }

?>


<form method="post" action="">
    <div style="height: 88vh;padding-top: 10%;"> 
        <div class="container d-flex  flex-wrap text-light" style="height:75%;width:50%;background:#86B9BB;  border-radius: 11px;"> 
            <div class="col-12">
            <div class="p-3 fs-4"><u>Nouveau mot de passe </u></div> </a>
            </div>
            <div class="col-6 w-50 p-1 ">
            Mot de passe (12 caractères dont une majuscule, une minuscule, 1 chiffres et 1 caractère spécial)
            </div>
            <div class="col-6 fs-5 " style="padding: 1% 0 0 2%;">
                <input type="text" name="mdp" placeholder="Nouveau mot de passe" class="form-control w-75 text-center" value="">
            </div>
            <div class="col-6 w-50 p-3">
            Confirmer le mot de passe
            </div>
            <div class="col-6" style="padding: 1% 0 0 2%;">
                <input type="text" name="mdp2" placeholder="Mot de passe" class="form-control w-75 text-center" value="">
            </div>

            <div class="col-6" style="padding-top:1%; ">
                <input class="btn btn-danger btn-lg w-50 fw-bold" type="reset" name="Annuler" value="Annuler">
            </div>
            <div class="col-6" style="padding-top:1%;">
            <input class="btn btn-success btn-lg w-50 fw-bold" type="submit" name="Suivants3" value="Suivant" > 
            </div>
        </div>
    </div>
</form>



   
    

