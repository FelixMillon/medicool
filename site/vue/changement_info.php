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

body{
  justify-content: unset;
}

</style>

<?php 


$unControleur->setTable("categorie_secu");
$LesSecus = $unControleur->selectAll(); 



if(isset($_FILES['file']) and isset($_POST['ModifierInfo']) and $_FILES['file']['name'] != null)
{

    $tmpName = $_FILES['file']['tmp_name'];
    $name = "profil_".$_SESSION['id'].'.'.explode('.',$_FILES['file']['name'])[1];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tab=array(      
      "nom"=>"profil_".$_SESSION['id'].'.'.explode('.',$_FILES['file']['name'])[1],
      "path_file"=>"image_user/profil_".$_SESSION['id'].'.'.explode('.',$_FILES['file']['name'])[1],
      "id"=>$_SESSION['id']
      );
    //  var_dump($_FILES['file']);
    $unControleur->setTable("image");
    
    if(file_exists("image_user/profil_".$_SESSION['id'].'.png')
    or file_exists("image_user/profil_".$_SESSION['id'].'.jpg')
    or file_exists("image_user/profil_".$_SESSION['id'].'.jpeg')
    or file_exists("image_user/profil_".$_SESSION['id'].'.PNG')
    or file_exists("image_user/profil_".$_SESSION['id'].'.JPG')
    or file_exists("image_user/profil_".$_SESSION['id'].'.JPEG')
    ){
        $type_image = array(".png",".PNG",".jpg",".JPG",".jpeg",".JPEG");
        foreach($type_image as $type){
            print($type);
            if(file_exists("image_user/profil_".$_SESSION['id'].$type)){
                unlink("image_user/profil_".$_SESSION['id'].$type);
                var_dump("coucou");
            }
        }
        
        $id = $_SESSION['id'];
        $where = array("id"=>$id);
        $unControleur->update ($tab, $where);
    }else{
       $unControleur->insert($tab);  
    }
    move_uploaded_file($tmpName, './image_user/'.$name);
}


if (isset($_POST['ModifierInfo']))
{

    // Recherche de la clé de cryptage 

    $tab3=array($_SESSION["email"]);
    $key=$unControleur->callproc('getkey',$tab3);
    

    $id = $_SESSION['id'];


    $where = array("id_patient"=>$id);
    $tab=array(
        "id_cat_secu"=>$_POST["id_cat_secu"]
    );

    $unControleur->setTable("patient");
    $unControleur->update($tab, $where);

    $where = array("id"=>$id);

    $tab=array(     
        "nom"=>$unControleur->encrypt($_POST["nom"],$key['cle']),
        "prenom"=>$unControleur->encrypt($_POST["prenom"],$key['cle']),
        "tel"=>$unControleur->encrypt($_POST["tel"],$key['cle']),
        "date_naissance"=>$unControleur->encrypt($_POST["date_naissance"],$key['cle']),
        "numrue"=>$unControleur->encrypt($_POST["numrue"],$key['cle']),
        "rue"=>$unControleur->encrypt($_POST["rue"],$key['cle']),
        "cp"=>$unControleur->encrypt($_POST["cp"],$key['cle']),
        "ville"=>$unControleur->encrypt($_POST["ville"],$key['cle']),
        );



    $unControleur->setTable("utilisateur");
    $unControleur->update ($tab, $where);
    }

?>

<form method="post" action="" enctype="multipart/form-data" style="padding-top : 5%; padding-bottom : 11%;">
    <div class="container" style="background:#86B9BB;  border-radius: 18px; padding-bottom : 5%;">
        <div class="row justify-content-between align-items-center" > 
            <div class="col-7 row" style="padding-top : 4%;">
                <h4 class="text-light"><u>INFORMATION DU COMPTE</u></h4>

                <div class="col-2"> </div>
                
                <div class="text-start text-light fs-6 col-7" style="padding-top: 2%">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="nomp" class="fw-bold"> Nom </label>
                        <span> <input name="nom" id="nomp" type="text" placeholder="<?php echo $_SESSION['nom'] ?>" class="text-center fw-bold" style="height : 23px; width : 130%; "></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="prenomp" class="fw-bold"> Prenom</label>
                        <span> <input  name="prenom"  id="prenomp" type="text" placeholder="<?php echo $_SESSION['prenom'] ?>" class="text-center fw-bold" style="height : 23px; width : 130%;"></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="nomp" class="fw-bold"> Téléphone</label>
                        <span> <input  name="tel"  id="nomp" type="text" placeholder="<?php echo $_SESSION['tel'] ?>" class="text-center fw-bold" style="height : 23px; width : 130%;"></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="nomp" class="fw-bold"> Date de naissance </label>
                        <span> <input  name="date_naissance"  id="nomp" type="date" class="text-center fw-bold " style="height : 23px; "></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="nomp" class="fw-bold"> Numéro de rue</label>
                        <span> <input name="numrue" id="nomp" type="text" placeholder="<?php echo $_SESSION['numrue'] ?>" class="text-center fw-bold" style="height : 23px; width : 130%;"></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="nomp" class="fw-bold"> Nom de rue</label>
                        <span> <input name="rue"  id="nomp" type="text" placeholder="<?php echo $_SESSION['rue'] ?>" class="text-center fw-bold" style="height : 23px; width : 130%;"></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="nomp" class="fw-bold"> Ville</label>
                        <span> <input name="ville" id="nomp" type="text" placeholder="<?php echo $_SESSION['ville'] ?>" class="text-center fw-bold" style="height : 23px; width : 130%;"></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="nomp" class="fw-bold"> Code postal</label>
                        <span> <input name="cp" id="nomp" type="text" placeholder="<?php echo $_SESSION['cp'] ?>" class="text-center fw-bold" style="height : 23px; width : 130%;"></span>
                    </div>
                    

                    <div class="d-flex justify-content-between align-items-center">
                        <label for="cat" class="fw-bold py-3"> Catégorie sécruite social </label>
                        <select for="cat" name="id_cat_secu" class="text-center" style="border-radius:15px;border:3px solid #86B9BB">
                            
                            <option  value="">Catégorie sécurité social</option>
                            <?php 
                            foreach ($LesSecus as $UneCategorie_secu){
                                echo "<option value='".$UneCategorie_secu['id_cat_secu']."'>".$UneCategorie_secu['libelle']." | ".$UneCategorie_secu['pourcent_rembourse']." </option>";
                            }
                            ?>
                        </select>
                    </div>

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
                    echo "<img src='image_user/profil_".$_SESSION['id'].$ext."' width='25%' alt=''><br><br>";
                }else{
                    echo "<img src='img/user.png' width='25%' alt=''><br><br>";
                }  
                
                ?>
                <div class="container">
                    <label class="form-label text-light fs-6" for="customFile">Changer de photo de profil</label>
                    <input type="file" name="file" class="form-control" id="customFile">
                </div>
            </div>
    </div>
            

    <div class="d-flex justify-content-between align-items-center" style="padding-top: 6%">
        <div class="col-2"> </div>
        <input class="btn btn-danger btn-lg w-25 fw-bold" type="reset" name="Annuler" value="Annuler">
        <div class="col-2"> </div>
        <input class="btn btn-primary text-light btn-lg w-25 fw-bold" type="submit" name="ModifierInfo" value="Modifier">
        <div class="col-2"> </div>
    </div>

        </div>
    </div>
</form>
