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
                <td>Date diagnositque</td>
                <td>Date guérison </td>
                <td>Médecin</td>
                <?php if($_SESSION['estMedecin'] == True){ 
                echo"<td>Patient</td>
                     <td>Opération</td>";
                }?>
            </tr>
            
            <?php 
        foreach ($LesPathologies as $unePathologie) { 

            if($_SESSION['estPatient'] == True){ 
                $_SESSION['id_patient'] = $_SESSION['id'];
             }
             
             if($_SESSION['id_patient'] == $unePathologie['id_patient']){ 


            $tab2=array(hash('sha256',$unePathologie['email']));
            $cle=$unControleur->callproc('getkey',$tab2);
            $cle = $cle['cle'];

            $where = array("id_patient"=>$unePathologie['id_patient']);
		    $unControleur->setTable("patient");
		    $unPatient = $unControleur->selectWhere($where);
            $lepatient = $unControleur->decrypt($unPatient['nom'], $cle)." ".$unControleur->decrypt($unPatient['prenom'], $cle);

            $where = array("id_medecin"=>$unePathologie['id_medecin']);
		    $unControleur->setTable("medecin");
		    $unMedecin = $unControleur->selectWhere($where);


        echo "<tr class='text-center'>
            <td><center>".$unePathologie['id_path']."</center></td>
            <td><center>".$unControleur->decrypt($unePathologie['libelle'], $cle)."</center></td>
            <td><center>".$unePathologie['date_diagnostique']."</center></td>
            <td><center>".$unePathologie['date_guerison']."</center></td>
            <td><center>".$unePathologie['id_medecin']."</center></td>";
            if($_SESSION['estMedecin'] == True){ 
                echo "<td><center>".$lepatient."</center></td>
                
                <td> 
                <a href='index.php?page=9&action=sup&id_path=".$unePathologie['id_path']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=9&action=edit&id_path=".$unePathologie['id_path']."'><img src='img/edit.png' height='30' width='30'></a>
                </td>";
            }
    
            echo"</tr>";
            }
        }
        
            ?>
    
        </table>
    </div>
    
