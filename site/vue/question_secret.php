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
	if(isset($_POST['Suivants2']))
	{

        $tab= array($_SESSION['email_recup']);
        $remedles = $unControleur->selectfunction('remedless',$tab);
		$remedles =$remedles["result"].$_POST['reponse_secrete_1'];
        $_SESSION['reponse_secrete_1_recup'] = hash('sha256',$remedles);

        $remedles2 = $unControleur->selectfunction('remedless',$tab);
        $remedles2 =$remedles2["result"].$_POST['reponse_secrete_2'];
        $_SESSION['reponse_secrete_2_recup'] = hash('sha256',$remedles2);

        var_dump($_POST['question_1']);
        var_dump($reponse_secrete_1);

        $where = array('email'=>$_SESSION['email_recup'], 
                       'question_1'=>$_POST['question_1'],
                       'reponse_secrete_1'=>$_SESSION['reponse_secrete_1_recup'],
                       'question_2'=>$_POST['question_2'],
                       'reponse_secrete_2'=>$_SESSION['reponse_secrete_2_recup'],
                    );
                    
		$unControleur->setTable("utilisateur");
		$unUser = $unControleur->selectWhere($where);



        if($unUser['email'] == $_SESSION['email_recup'])
        {
            $_SESSION['id_recup'] = $unUser['id'];
            header("Location: index.php?page=15");
        }else{
            echo"Mauvaise réponses";
        }
        
    }

?>

<form method="post" action="">
    <div style="height: 88vh;padding-top: 10%;"> 
        <div class="container d-flex  flex-wrap text-light" style="height:75%;width:50%;background:#86B9BB;  border-radius: 11px;"> 
            <div class="col-12">
            <div class="p-3 fs-4"><u>Récupération du compte via question secrete </u></div> </a>
            </div>
            <div class="col-6">
            <select name="question_1"  class="form-select w-50 text-center" style="border-radius:15px;border:3px solid #86B9BB">
                <option selected>Question 1</option>
                <option value="Nom de votre ecole primaire">Nom de votre école primaire ?</option>
                <option value="Nom de jeune fille de votre m?re">Nom de jeune fille de votre mère ?</option>
                <option value="Nom de votre premier amour">Nom de votre premier amour ?</option>
                <option value="Nom de votre professeur prefere">Nom de votre professeur préféré ?</option>
                <option value="Ville de rencontre de vos parents">Ville de rencontre de vos parents ?</option>
                <option value="Nom de votre roman prefere">Nom de votre roman préféré ?</option>
            </select>
            </div>
            <div class="col-6 fs-5 text-start" style="padding: 1% 0 0 2%;">
                <input type="text" name="reponse_secrete_1" placeholder="Réponse à la question 1" class="form-control w-75" value="">
            </div>
            <div class="col-6">
            <select name="question_2" class="form-select w-50 text-center" style="border-radius:15px;border:3px solid #86B9BB">
                <option selected>Question 2</option>
                <option value="Nom de votre ecole primaire">Nom de votre école primaire ?</option>
                <option value="Nom de jeune fille de votre m?re">Nom de jeune fille de votre mère ?</option>
                <option value="Nom de votre premier amour">Nom de votre premier amour ?</option>
                <option value="Nom de votre professeur prefere">Nom de votre professeur préféré ?</option>
                <option value="Ville de rencontre de vos parents">Ville de rencontre de vos parents ?</option>
                <option value="Nom de votre roman prefere">Nom de votre roman préféré ?</option>
            </select>
            </div>
            <div class="col-6 fs-5 text-start" style="padding: 1% 0 0 2%;">
                <input type="text" name="reponse_secrete_2" placeholder="Réponse à la question 2" class="form-control w-75" value="">
            </div>

            <div class="col-6" style="padding-top:1%; ">
                <input class="btn btn-danger btn-lg w-50 fw-bold" type="reset" name="Annuler" value="Annuler">
            </div>
            <div class="col-6" style="padding-top:1%;">
            <input class="btn btn-success btn-lg w-50 fw-bold" type="submit" name="Suivants2" value="Suivant" > 
            </div>
        </div>

    
        
    </div>
</form>



   
    

