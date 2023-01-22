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
            <td>Opérations</td>
        </tr>
        
        <?php 
        foreach ($LesSecretaires as $uneSecretaire) { 
        echo "<tr class='text-center'>
            <td><center>".$uneSecretaire['id_secretaire']."</center></td>
            <td><center>".$uneSecretaire['email']."</center></td>
            <td><center>".$uneSecretaire['nom']." ".$uneSecretaire['prenom']."</center></td>
            <td><center>".$uneSecretaire['tel']."</center></td>
            <td><center>".$uneSecretaire['date_naissance']."</center></td>
            <td><center>".$uneSecretaire['date_enregistrement']."</center></td>
            <td><center>".$uneSecretaire['numrue']." ".$uneSecretaire['rue']." <br> ,".$uneSecretaire['ville']." &nbsp;".$uneSecretaire['cp']."</center></td>
            <td><center>".$uneSecretaire['droits']."</center></td>
            
            <td> 
                <a href='index.php?page=22&action=sup&id_secretaire=".$uneSecretaire['id_secretaire']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=22&action=edit&id_secretaire=".$uneSecretaire['id_secretaire']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>
        </tr>";
        } 
        ?>
    </table>
</div>


		

