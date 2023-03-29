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
	if(isset($_POST['Suivants']))
	{
        $where = array('email'=>$_POST['email']);
		$unControleur->setTable("utilisateur");
		$unUser = $unControleur->selectWhere($where);

        if($unUser != null){
            $_SESSION['email_recup'] = $unUser['email'];
            header("Location: index.php?page=14");
        }else{
            echo"email introuvable";
        }

        
    }

?>


<form method="post" action="">
    <div style="height: 88vh;padding-top: 10%;"> 
        <div class="container d-flex  flex-wrap text-light" style="height:75%;width:50%;background:#86B9BB;  border-radius: 11px;"> 
            <div class="col-12">
            <div class="p-3 fs-4"><u>Récuperation de mot de passe via e-mail </u></div> </a>
            </div>
            <div class="col-12 fs-4 p-1 ">
            Veuillez saisir le code obtenu via e-mail. <small> <br>(Si vous ne l'avez pas reçu, veuillez patienter 
            ou regarder dans vos spams.)</small>
            </div>
            <div class="col-12 fs-5 " style="padding: 1% 0 0 2%;">
                <input type="text" name="email" placeholder="email" class="form-control text-center w-75" value="">
            </div>
            

            <div class="col-6" style="padding-top:1%; ">
                <input class="btn btn-danger btn-lg w-50 fw-bold" type="reset" name="Annuler" value="Annuler">
            </div>
            <div class="col-6" style="padding-top:1%;">
                <input class="btn btn-success btn-lg w-50 fw-bold" type="submit" name="Suivants" value="Suivant" > 
            </div>
        </div>  
    </div>
</form>



   
    

