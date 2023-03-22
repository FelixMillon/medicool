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
border-radius: 12px;
transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
background : white;
color : black;
}

</style>

<form method="post" action="">
    <div style="height: 88vh;padding-top: 1%;"> 
        <div class="d-flex justify-content-around">
            <div class="col-4">
                <div class="row align-items-center" style="height:100%;background:#86B9BB;  border-radius: 18px;">
                    <div class="d-flex flex-column">
                        <div class="p-3"><h4 class="text-light"><u>GESTIONS DES PATIENTS</u></h4></div> 
                        <div class="p-3 d-flex justify-content-between">     
                            <select name="id" class="form-select w-50 text-center" style="border-radius:15px;">
                                <option selected>Patient</option>
                                    <?php 
                                    foreach ($LesPatients as $unPatient){
                                        if($unPatient['id_medecin']== null or $unPatient['id_medecin'] == $_SESSION['id'])
                                        {
                                            $tab2=array(hash('sha256',$unPatient['email']));
                                            $cle=$unControleur->callproc('getkey',$tab2);
                                            $cle = $cle['cle'];
                                            $prenom = $unControleur->decrypt($unPatient['prenom'], $cle);
                                            $nom = $unControleur->decrypt($unPatient['nom'], $cle);
                                            echo "<option value='".$unPatient['id_patient']."'>".$nom." ".$prenom." </option>";
                                        }
                                    }
                                    ?>
                            </select>
                            <input class="btn form w-50 text-center"  type="submit" name="Ouvrir" value="Ouvrir le dossier médical">
                        </div>
                        <!--If super admin-->
                        <div class="p-3 d-flex align-content-center flex-wrap"> 
                            <div class="col-6" style="padding-top:1%;">
                                <a class="btn nav-link form w-50 text-center"> Ajouter un rendez-vous </a>
                            </div>
                            <div class="col-6" style="padding-top:1%;">
                                <a href="index.php?page=19" class="btn nav-link form w-50 text-center"> Gestion des patients </a>
                            </div>
                            <?php if($_SESSION['droits'] == "super_administrateur" or $_SESSION['droits'] == "administrateur") { ?>
                            <div class="col-6" style="padding-top:1%;">
                                <a class="btn nav-link form w-50 text-center"> Gestion des secrétaires (Admin) </a>
                            </div>
                            <div class="col-6" style="padding-top:1%;">
                                <a class="btn nav-link form w-50 text-center"> Gestion des médecins (Admin) </a>
                            </div>

                            <?php } ?>
                        </div>
                        <!--End super admin-->
                    </div>
                </div>
            </div>
            
        </div>
        

            <div class="col-6" style="padding-top : 1%;"> 
                <div style="height:25%;background:#86B9BB;  border-radius: 18px; padding-bottom : 5%;">
                    <div class="d-flex justify-content-between align-items-center">

                    <div class="col-8 row" style="padding-top : 4%;">
                        <div><h4 class="text-light"><u>INFORMATION DU COMPTE</u></h4></div> 
                        <div class="text-end text-light fs-6 col-4" style="margin-left : 4%">
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
                        <div class="text-start text-light fs-6 col-6" >
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

                        <div class="col-4" style="padding-top : 5%;">
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
</form>