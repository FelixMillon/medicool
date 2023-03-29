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
            <td>Opérations</td>
        </tr>
        
        <?php 


        foreach ($LesPatients as $unPatient) { 

            if(($_SESSION['estMedecin'] == True and $_SESSION['id'] == $unPatient['id_medecin']) 
                or $unPatient['id_medecin'] == null or $_SESSION['estSecretaire'] == True){ 


            
            $tab2=array(hash('sha256',$unPatient['email']));
            $cle=$unControleur->callproc('getkey',$tab2);
            $cle = $cle['cle'];

        echo "<tr class='text-center'>
            <td><center>".$unPatient['id_patient']."</center></td>
            <td><center>".$unPatient['email']."</center></td>
            <td><center>".$unControleur->decrypt($unPatient['nom'], $cle)." ".$unControleur->decrypt($unPatient['prenom'], $cle)."</center></td>
            <td><center>".$unControleur->decrypt($unPatient['tel'], $cle)."</center></td>
            <td><center>".$unControleur->decrypt($unPatient['date_naissance'], $cle)."</center></td>
            <td><center>".$unControleur->decrypt($unPatient['date_enregistrement'], $cle)."</center></td>
            <td><center>".$unControleur->decrypt($unPatient['numrue'], $cle)." ".$unControleur->decrypt($unPatient['rue'], $cle)." <br> ,".$unControleur->decrypt($unPatient['ville'], $cle)." &nbsp;".$unControleur->decrypt($unPatient['cp'], $cle)."</center></td>
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
        } 
        ?>
    </table>
</div>


		

