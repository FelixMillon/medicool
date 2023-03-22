<?php
    if($_SESSION['estMedecin'] == False){
        echo "<div class='col-10'>";
    }else{
        echo "<div class='col-6'>";
    }
?>
<div class="table-responsive w-100" style="height:40vh;border : 4px solid #86B9BB;  border-radius: 10px;">
    <table class="table table-striped table-sm" >
        <tr class="text-center fw-bold text-light" style="background:#86B9BB;opacity : 0.57; border-bottom: 4px solid  #86B9BB; ">
            <td>ID</td>
            <td>Libellé</td>
            <td>Date de diagnostique</td>
            <td>Date de guérison</td>
            <td>Médecin</td>
            <?php if($_SESSION['estMedecin'] == True){ echo"<td>Patient</td>";}?>
            <?php if($_SESSION['estMedecin'] == True){ echo"<td>Opération</td>";}?>
        </tr>
        
        <?php 
        foreach ($LesAllergies as $uneAllergie) { 

            if($_SESSION['estPatient'] == True){ 
                $_SESSION['id_patient'] = $_SESSION['id'];
             }
             
             if($_SESSION['id_patient'] == $uneAllergie['id_patient']){ 


            $tab2=array(hash('sha256',$uneAllergie['email']));
            $cle=$unControleur->callproc('getkey',$tab2);
            $cle = $cle['cle'];
            $libelle = $unControleur->decrypt($uneAllergie['libelle'], $cle);


            $where = array("id_patient"=>$uneAllergie['id_patient']);
		    $unControleur->setTable("patient");
		    $unPatient = $unControleur->selectWhere($where);
            $lepatient = $unControleur->decrypt($unPatient['nom'], $cle)." ".$unControleur->decrypt($unPatient['prenom'], $cle);

            $where = array("id_medecin"=>$uneAllergie['id_medecin']);
		    $unControleur->setTable("medecin");
		    $unMedecin = $unControleur->selectWhere($where);
            $lemedecin = $unMedecin['nom']." ".$unMedecin['prenom'];



        echo "<tr class='text-center'>
            <td><center>".$uneAllergie['id_allergie']."</center></td>
            <td><center>".$libelle."</center></td>
            <td><center>".$uneAllergie['date_diagnostique']."</center></td>
            <td><center>".$uneAllergie['date_guerison']."</center></td>
            <td><center>".$lemedecin."</center></td>";
            if($_SESSION['estMedecin'] == True){ 
                echo"<td><center>".$lepatient."</center></td>";
            }
            if($_SESSION['estMedecin'] == True){  echo "
            <td> 
                <a href='index.php?page=6&action=sup&id_allergie=".$uneAllergie['id_allergie']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=6&action=edit&id_allergie=".$uneAllergie['id_allergie']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>";
            }
        echo"</tr>";
        }
    } 
        ?>
    </table>
</div>


		

