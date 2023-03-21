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
            <td>Date</td>
            <td>Prix</td>
            <td>Résultat </td>
            <td>Commentaire</td>
            <td>Medecin</td>
            <?php if($_SESSION['estMedecin'] == True){ echo"<td>Patient</td>";}?>
            <?php if($_SESSION['estMedecin'] == True){ echo"<td>Opération</td>";}?>
        </tr>
        
        <?php 
        foreach ($LesExamens as $unExamen) { 

            
            $tab2=array($unExamen['email']);
            $cle=$unControleur->callproc('getkey',$tab2);
            $cle = $cle['cle'];
            $libelle = $unControleur->decrypt($unExamen['libelle'], $cle);

            $where = array("id_patient"=>$unExamen['id_patient']);
		    $unControleur->setTable("patient");
		    $unPatient = $unControleur->selectWhere($where);
            $lepatient = $unControleur->decrypt($unPatient['nom'], $cle)." ".$unControleur->decrypt($unPatient['prenom'], $cle);

            $where = array("id_medecin"=>$unExamen['id_medecin']);
		    $unControleur->setTable("medecin");
		    $unMedecin = $unControleur->selectWhere($where);
            $lemedecin = $unMedecin['nom']." ".$unMedecin['prenom'];         

        echo "<tr class='text-center'>
            <td><center>".$unExamen['id_examen']."</center></td>
            <td><center>".$unControleur->decrypt($unExamen['libelle'], $cle)."</center></td>
            <td><center>".$unExamen['date']."</center></td>
            <td><center>".$unExamen['prix_examen']."</center></td>
            <td><center>".$unControleur->decrypt($unExamen['resultat'], $cle)."</center></td>
            <td><center>".$unControleur->decrypt($unExamen['commentaire'], $cle)."</center></td>
            <td><center>".$lemedecin."</center></td>";
            if($_SESSION['estMedecin'] == True){ 
                echo"<td><center>".$lepatient."</center></td>
                
            
            <td> 
                <a href='index.php?page=7&action=sup&id_examen=".$unExamen['id_examen']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=7&action=edit&id_examen=".$unExamen['id_examen']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>";
                 }
                 echo "</tr>";
        } 
        ?>
    </table>
</div>


		

