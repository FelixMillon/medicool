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

    $tab3=array(hash('sha256',$_SESSION["email"]));
    $key=$unControleur->callproc('getkey',$tab3);

    $id = $_SESSION['id'];

    if($_SESSION['estPatient']){
        $where = array("id_patient"=>$id);
        $tab=array(
            "id_cat_secu"=>$_POST["id_cat_secu"]
        );
        $unControleur->setTable("patient");
        $unControleur->update($tab, $where);
    }

    $where = array("id"=>$id);

    if($_SESSION['estPatient']){

        if(!empty($_POST["nom"])){
            $nom = $unControleur->encrypt($_POST["nom"],$key['cle']);
        }else{
            $nom = $_POST["nom"];
        }

        if(!empty($_POST["prenom"])){
            $prenom = $unControleur->encrypt($_POST["prenom"],$key['cle']);
        }else{
            $prenom = $_POST["prenom"];
        }

        if(!empty($_POST["tel"])){
            $tel = $unControleur->encrypt($_POST["tel"],$key['cle']);
        }else{
            $tel = $_POST["tel"];
        }

        if(!empty($_POST["date_naissance"])){
            $date_naissance = $unControleur->encrypt($_POST["date_naissance"],$key['cle']);
        }else{
            $date_naissance = $_POST["date_naissance"];
        }

        if(!empty($_POST["numrue"])){
            $numrue = $unControleur->encrypt($_POST["nom"],$key['numrue']);
        }else{
            $numrue = $_POST["numrue"];
        }

        if(!empty($_POST["rue"])){
            $rue = $unControleur->encrypt($_POST["nom"],$key['rue']);
        }else{
            $rue = $_POST["rue"];
        }

        if(!empty($_POST["cp"])){
            $cp = $unControleur->encrypt($_POST["nom"],$key['cp']);
        }else{
            $cp = $_POST["cp"];
        }

        if(!empty($_POST["ville"])){
            $ville = $unControleur->encrypt($_POST["nom"],$key['ville']);
        }else{
            $ville = $_POST["ville"];
        }

    $tab=array(     
        "nom"=>$nom,
        "prenom"=>$prenom,
        "tel"=>$tel,
        "date_naissance"=>$date_naissance,
        "numrue"=>$numrue,
        "rue"=>$rue,
        "cp"=>$cp,
        "ville"=>$ville,
        );
        var_dump($unControleur->encrypt($_POST["ville"],$key['cle']));
    }else{
        $tab=array(     
            "nom"=>$_POST["nom"],
            "prenom"=>$_POST["prenom"],
            "tel"=>$_POST["tel"],
            "date_naissance"=>$_POST["date_naissance"],
            "numrue"=>$_POST["numrue"],
            "rue"=>$_POST["rue"],
            "cp"=>$_POST["cp"],
            "ville"=>$_POST["ville"]
            );  
    }
    $unControleur->setTable("utilisateur");
    $unControleur->update ($tab, $where);

    $unControleur->setTable("utilisateur");
    $unUser = $unControleur->selectWhere($where);

    if($_SESSION['estPatient']){

    $_SESSION['nom'] =   $unControleur->decrypt($unUser['nom'], $_SESSION['cle']);
    $_SESSION['prenom'] = $unControleur->decrypt($unUser['prenom'], $_SESSION['cle']);
    $_SESSION['tel'] = $unControleur->decrypt($unUser['tel'], $_SESSION['cle']);
    $_SESSION['date_naissance'] = $unControleur->decrypt($unUser['date_naissance'], $_SESSION['cle']);
    $_SESSION['numrue'] = $unControleur->decrypt($unUser['numrue'], $_SESSION['cle']);
    $_SESSION['rue'] = $unControleur->decrypt($unUser['rue'], $_SESSION['cle']);
    $_SESSION['ville'] = $unControleur->decrypt($unUser['ville'], $_SESSION['cle']);
    $_SESSION['cp'] = $unControleur->decrypt($unUser['cp'], $_SESSION['cle']);
    header("Location: index.php?page=20");
    }else{

    $_SESSION['nom'] = $unUser['nom'];
    $_SESSION['prenom'] = $unUser['prenom'];
    $_SESSION['tel'] = $unUser['tel'];
    $_SESSION['date_naissance'] = $unUser['date_naissance'];
    $_SESSION['numrue'] = $unUser['numrue'];
    $_SESSION['rue'] = $unUser['rue'];
    $_SESSION['ville'] = $unUser['ville'];
    $_SESSION['cp'] = $unUser['cp'];
    header("Location: index.php?page=20");
    }


    }

?>

<form method="post" action="" enctype="multipart/form-data" style="padding-top : 1%; padding-bottom : 7%;">
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
                        <label for="prenomp" class="fw-bold"> Prénom</label>
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
                    
                    <?php if($_SESSION['estPatient']){ ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="cat" class="fw-bold py-3"> Catégorie de sécurité sociale </label>
                        <select for="cat" name="id_cat_secu" class="text-center" style="border-radius:15px;border:3px solid #86B9BB">
                            
                            <option  value="">Catégorie de sécurité social</option>
                            <?php 
                            foreach ($LesSecus as $UneCategorie_secu){
                                echo "<option value='".$UneCategorie_secu['id_cat_secu']."'>".$UneCategorie_secu['libelle']." | ".$UneCategorie_secu['pourcent_rembourse']." </option>";
                            }
                            ?>
                        </select>
                    </div>
                    <?php } ?>
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
    <br><a href="index.php?page=11" class="btn btn-lg text-light fw-bold w-25" style="background:#3B7476;">Retour</a>
    </div>
        
    </div>
</form>
