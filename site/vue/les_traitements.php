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
                <td>Libelle</td>
                <td>Posologie</td>
                <td>Date début</td>
                <td>Date fin </td>
                <td>prix par unité</td>
                <td>Medecin</td>
                <?php if($_SESSION['estMedecin'] == True){ 
                echo"<td>Patient</td>
                     <td>Opération</td>";
                }?>
                
            </tr>
            
            <?php 
        foreach ($LesTraitements as $unTraitement) { 

            if($_SESSION['estPatient'] == True){ 
                $_SESSION['id_patient'] = $_SESSION['id'];
             }
             
             if($_SESSION['id_patient'] == $unTraitement['id_patient']){ 


            $tab2=array(hash('sha256',$unTraitement['email']));
            $cle=$unControleur->callproc('getkey',$tab2);
            $cle = $cle['cle'];

            $where = array("id_patient"=>$unTraitement['id_patient']);
		    $unControleur->setTable("patient");
		    $unPatient = $unControleur->selectWhere($where);
            $lepatient = $unControleur->decrypt($unPatient['nom'], $cle)." ".$unControleur->decrypt($unPatient['prenom'], $cle);

            $where = array("id_medecin"=>$unTraitement['id_medecin']);
		    $unControleur->setTable("medecin");
		    $unMedecin = $unControleur->selectWhere($where);
            $lemedecin = $unMedecin['nom']." ".$unMedecin['prenom'];


        echo "<tr class='text-center'>
            <td><center>".$unTraitement['id_traitement']."</center></td>
            <td><center>".$unControleur->decrypt($unTraitement['libelle'], $cle)."</center></td>
            <td><center>".$unTraitement['posologie']."</center></td>
            <td><center>".$unTraitement['date_debut']."</center></td>
            <td><center>".$unTraitement['date_fin']."</center></td>
            <td><center>".$unTraitement['prix_par_unite']."</center></td>
            <td><center>".$lemedecin."</center></td>";
            if($_SESSION['estMedecin'] == True){ 
            echo "<td><center>".$lepatient."</center></td>
            
            <td> 
                <a href='index.php?page=10&action=sup&id_traitement=".$unTraitement['id_traitement']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=10&action=edit&id_traitement=".$unTraitement['id_traitement']."'><img src='img/edit.png' height='30' width='30'></a>
                </td>";
            }
    
            echo"</tr>";
            }
        }
        
            ?>
    
        </table>
    </div>
    
