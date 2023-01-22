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
            <td>Spécialisation</td>
            <td>Date de départ</td>
            <td>Opérations</td>
        </tr>
        
        <?php 
        foreach ($LesMedecins as $unMedecin) { 
        echo "<tr class='text-center'>
            <td><center>".$unMedecin['id_medecin']."</center></td>
            <td><center>".$unMedecin['email']."</center></td>
            <td><center>".$unMedecin['nom']." ".$unMedecin['prenom']."</center></td>
            <td><center>".$unMedecin['tel']."</center></td>
            <td><center>".$unMedecin['date_naissance']."</center></td>
            <td><center>".$unMedecin['date_enregistrement']."</center></td>
            <td><center>".$unMedecin['numrue']." ".$unMedecin['rue']." <br> ,".$unMedecin['ville']." &nbsp;".$unMedecin['cp']."</center></td>
            <td><center>".$unMedecin['droits']."</center></td>
            <td><center>".$unMedecin['specialisation']."</center></td>
            <td><center>".$unMedecin['date_depart_cabinet']."</center></td>
            
            <td> 
                <a href='index.php?page=21&action=sup&id_medecin=".$unMedecin['id_medecin']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=21&action=edit&id_medecin=".$unMedecin['id_medecin']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>
        </tr>";
        } 
        ?>
    </table>
</div>


		

