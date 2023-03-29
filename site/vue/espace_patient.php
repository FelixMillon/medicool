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


<div style="height: 88vh;padding-top: 2%;"> 
    <div class="container d-flex align-content-center flex-wrap" style="height:37%;background:#86B9BB;  border-radius: 18px; "> 
        <div class="col-12" style="padding-top:1%;">
           <div class="p-3"><h4 class="text-light"><u>DOSSIER MÉDICAL : <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'] ?></u></h4></div> </a>
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
            <a href="index.php?page=5" class="btn nav-link form w-50 text-center"> Opération </a>
        </div>
        <div class="col-4" style="padding-top:1%;">
            <a href="index.php?page=6" class="btn nav-link form w-50 text-center"> Allergie </a>
        </div>
        <div class="col-4" style="padding-top:1%;">
            <a href="index.php?page=9" class="btn nav-link form w-50 text-center"> Pathologie </a>
        </div>
    </div>
    
    <div class="col-6" style="padding-right:3%;padding-top : 4%;"> 
            <div style="height:25%;background:#86B9BB;  border-radius: 18px; padding-bottom : 5%;">
                <div class="d-flex justify-content-between align-items-center">

                    <div class="col-7 row" style="padding-top : 4%;">
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
                            <?php echo $_SESSION['id'] ?>
                            <br>
                            <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'] ?>
                            <br>
                            <?php echo $_SESSION['numrue'].' '.$_SESSION['rue'].',  '.$_SESSION['ville'].' '.$_SESSION['cp'] ?>
                            <br>
                            <?php echo $_SESSION['email'] ?>
                            <br>
                            <?php echo $_SESSION['tel'] ?>
                            <br>
                            <?php echo $_SESSION['date_naissance'] ?>
                        </div>
                    </div>

                    <div class="col-5" style="padding-top : 5%;">
                    <?php
                    $ext = "toto"; 
                    $type_image = array(".png",".PNG",".jpg",".JPG",".jpeg",".JPEG");
                    foreach($type_image as $type){
                        if(file_exists("image_user/profil_".$_SESSION['id'].$type)){
                            $ext=$type;
                        }
                    }
                    if($ext != "toto"){
                        echo "<img src='image_user/profil_".$_SESSION['id'].$ext."' width='35%' alt=''><br><br>";
                    }else{
                        echo "<img src='img/user.png' width='35%' alt=''><br><br>";
                    }  
                    ?><br><br>
                    <a href="index.php?page=20" class="btn nav-link form text-center w-75"><small> Demande de modification d'information</small></a>

                    </div>

                </div>                
            </div>
        </div>
</div>
