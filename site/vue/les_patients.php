 <div class="table-responsive" style="height:50vh;border : 4px solid #86B9BB;  border-radius: 10px;">
    <table class="table table-striped table-sm" >
        <tr class="text-center fw-bold text-light" style="background:#86B9BB;opacity : 0.57; border-bottom: 4px solid  #86B9BB; ">
            <td>ID</td>
            <td>Email</td>
            <td>Nom & Prénom</td>
            <td>Tél</td>
            <td>Date naissance </td>
            <td>Date enregistrement</td>
            <td>Adresse </td>
            <td>Droits</td>
            <td>Numéro dossier</td>
            <td>Catégorie sécu</td>
            <td>Médecin référent</td>
            <td>Opération</td>
        </tr>
        
        <?php 
        foreach ($LesPatients as $unPatient) { 
        echo "<tr class='text-center'>
            <td><center>".$unPatient['id_patient']."</center></td>
            <td><center>".$unPatient['email']."</center></td>
            <td><center>".$unPatient['nom']." ".$unPatient['prenom']."</center></td>
            <td><center>".$unPatient['tel']."</center></td>
            <td><center>".$unPatient['date_naissance']."</center></td>
            <td><center>".$unPatient['date_enregistrement']."</center></td>
            <td><center>".$unPatient['numrue']." ".$unPatient['rue']." <br> ,".$unPatient['ville']." &nbsp;".$unPatient['cp']."</center></td>
            <td><center>".$unPatient['droits']."</center></td>
            <td><center>".$unPatient['numero_dossier']."</center></td>
            <td><center>".$unPatient['id_cat_secu']."</center></td>
            <td><center>".$unPatient['id_medecin']."</center></td>
            
            <td> 
                <a href='index.php?page=19&action=sup&id_patient=".$unPatient['id_patient']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=19&action=edit&id_patient=".$unPatient['id_patient']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>
        </tr>";
        } 
        ?>
    </table>
</div>


		

