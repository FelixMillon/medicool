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

</style>

<?php 
                $id = $_SESSION['id_patient'];
        		$where = array('id'=>$id);
                $unControleur->setTable("utilisateur");
                $unUser = $unControleur->selectWhere($where);
                $tab2=array($unUser['email']);
                $cles=$unControleur->callproc('getkey',$tab2);
                $cle = $cles['cle'];

                $unUser['prenom'] = $unControleur->decrypt($unUser['prenom'], $cle);
                $unUser['nom'] = $unControleur->decrypt($unUser['nom'], $cle);

                $unUser['numrue'] = $unControleur->decrypt($unUser['numrue'], $cle);
                $unUser['rue'] = $unControleur->decrypt($unUser['rue'], $cle);
                $unUser['ville'] = $unControleur->decrypt($unUser['ville'], $cle);
                $unUser['cp'] = $unControleur->decrypt($unUser['cp'], $cle);
                $unUser['tel'] = $unControleur->decrypt($unUser['tel'], $cle);
                $unUser['date_naissance'] = $unControleur->decrypt($unUser['date_naissance'], $cle);
                
    ?>


<div style="height: 88vh;padding-top: 1%;"> 
    <div class="container d-flex align-content-center flex-wrap" style="height:37%;background:#86B9BB;  border-radius: 18px; "> 
        <div class="col-12" style="padding-top:1%;">
           <div class="p-3"><h4 class="text-light"><u>DOSSIER MÉDICAL : <?php echo $unUser['prenom'].' '.$unUser['nom'] ?></u></h4></div> </a>
        </div>                                                 
        <div class="col-4" style="padding-top:1%;">
            <a href="index.php?page=4" class="btn nav-link form w-50 text-center"> Hospitalisation </a>
        </div>
        <div class="col-4" style="padding-top:1%;">
            <a href="index.php?page=7" class="btn nav-link form w-50 text-center"> Examen </a>
        </div>
        <div class="col-4" style="padding-top:1%;">
            <a href="index.php?page=10" class="btn nav-link form w-50 text-center"> Traitement </a>
        </div>
        <div class="col-4" style="padding-top:1%;">
            <a href="index.php?page=8" class="btn nav-link form w-50 text-center"> Opération </a>
        </div>
        <div class="col-4" style="padding-top:1%;">
            <a href="index.php?page=6" class="btn nav-link form w-50 text-center"> Allérgie </a>
        </div>
        <div class="col-4" style="padding-top:1%;">
            <a href="index.php?page=9" class="btn nav-link form w-50 text-center"> Pathologie </a>
        </div>
    </div>

  
    
    <div class="col-6" style="padding-right:3%;padding-top : 4%;"> 
            <div style="height:25%;background:#86B9BB;  border-radius: 18px; padding-bottom : 5%;">
                <div class="d-flex justify-content-between align-items-center">

                    <div class="col-12 row" style="padding-top : 4%;">
                        <div><h4 class="text-light"><u>INFORMATION DU COMPTE</u></h4></div> 
                        <div class="text-end text-light fs-6 col-5" style="margin-left : 4%">
                            Identifiant compte : 
                            <br>
                            Nom & Prénom :
                            <br>
                            Adresse :
                            <br>
                            Email :
                            <br>
                            Tel :
                            <br>
                            Date de naissance :
                        </div>
                        <div class="col-1"></div>
                        <div class="text-start text-light fs-6 col-5" >
                            <?php echo $unUser['id'] ?>
                            <br>
                            <?php echo $unUser['prenom'].' '.$unUser['nom'] ?>
                            <br>
                            <?php echo $unUser['numrue'].' '.$unUser['rue'].',  '.$unUser['ville'].' '.$unUser['cp'] ?>
                            <br>
                            <?php echo $unUser['email'] ?>
                            <br>
                            <?php echo $unUser['tel'] ?>
                            <br>
                            <?php echo $unUser['date_naissance'] ?>
                        </div>
                    </div>

                </div>                
            </div>
        </div>
</div>
