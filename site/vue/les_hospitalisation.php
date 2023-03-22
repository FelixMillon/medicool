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
                <td>Raison</td>
                <td>Date début</td>
                <td>Durée estimée</td>
                <td>Date fin </td>
                <td>Hopital</td>
                <?php if($_SESSION['estMedecin'] == True){ echo"<td>Patient</td>";}?>
                <td>Medecin</td>
                <?php if($_SESSION['estMedecin'] == True){ echo"<td>Opération</td>";}?>
            </tr>
            
        <?php 

        foreach ($LesHospitalisations as $UneHospitalisation){ 
            
            if($_SESSION['estPatient'] == True){ 
               $_SESSION['id_patient'] = $_SESSION['id'];
            }
            
            if($_SESSION['id_patient'] == $UneHospitalisation['id_patient']){ 
                  

            $tab2=array(hash('sha256',$UneHospitalisation['email']));
            $cle=$unControleur->callproc('getkey',$tab2);
            $cle = $cle['cle'];

            $where = array("id_patient"=>$UneHospitalisation['id_patient']);
		    $unControleur->setTable("patient");
		    $unPatient = $unControleur->selectWhere($where);
            $lepatient = $unControleur->decrypt($unPatient['nom'], $cle)." ".$unControleur->decrypt($unPatient['prenom'], $cle);

            $where = array("id_medecin"=>$UneHospitalisation['id_medecin']);
		    $unControleur->setTable("medecin");
		    $unMedecin = $unControleur->selectWhere($where);
            $lemedecin = $unMedecin['nom']." ".$unMedecin['prenom'];

            $where = array("id_hopital"=>$UneHospitalisation['id_hopital']);
		    $unControleur->setTable("hopital");
		    $unHopital = $unControleur->selectWhere($where);
            $lHopital = $unHopital['nom'];
                            
        

        echo "<tr class='text-center'>
            <td><center>".$UneHospitalisation['id_hospitalisation']."</center></td>
            <td><center>".$unControleur->decrypt($UneHospitalisation['raison'], $cle)."</center></td>
            <td><center>".$UneHospitalisation['date_debut']."</center></td>
            <td><center>".$UneHospitalisation['date_fin_estimee']."</center></td>
            <td><center>".$UneHospitalisation['date_fin']."</center></td>
            <td><center>".$lHopital."</center></td>";
            if($_SESSION['estMedecin'] == True){ 
            echo"<td><center>".$lepatient."</center></td>";
            }
            echo "
            <td><center>".$lemedecin."</center></td>";
            if($_SESSION['estMedecin'] == True){ 
                echo "<td> 
                <a href='index.php?page=4&action=sup&id_hospitalisation=".$UneHospitalisation['id_hospitalisation']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=4&action=edit&id_hospitalisation=".$UneHospitalisation['id_hospitalisation']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>";
        }

        echo"</tr>";
        }
    }
    
        ?>

    </table>
</div>
