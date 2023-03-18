<div class="table-responsive w-100" style="height:40vh;border : 4px solid #86B9BB;  border-radius: 10px;">
    <table class="table table-striped table-sm" >
        <tr class="text-center fw-bold text-light" style="background:#86B9BB;opacity : 0.57; border-bottom: 4px solid  #86B9BB; ">
                <td>ID</td>
                <td>Libelle</td>
                <td>Date</td>
                <td>Durée</td>
                <td>Prix</td>
                <td>Résultat </td>
                <td>Commentaire</td>
                <td>Patient</td>
                <td>Opération</td>
            </tr>
        
        <?php 
        foreach ($LesOperations as $uneOperation) { 
            $tab2=array($uneOperation['email']);
            $cle=$unControleur->callproc('getkey',$tab2);
            $cle = $cle['cle'];
            $libelle = $unControleur->decrypt($uneOperation['libelle'], $cle);

        echo "<tr class='text-center'>
            <td><center>".$uneOperation['id_operation']."</center></td>
            <td><center>".$unControleur->decrypt($uneOperation['libelle'], $cle)."</center></td>
            <td><center>".$uneOperation['date_heure_time']."</center></td>
            <td><center>".$uneOperation['duree']."</center></td>
            <td><center>".$uneOperation['prix']."</center></td>
            <td><center>".$unControleur->decrypt($uneOperation['resultat'], $cle)."</center></td>
            <td><center>".$unControleur->decrypt($uneOperation['commentaire'], $cle)."</center></td>
            <td><center>".$uneOperation['id_patient']." : ".$uneOperation['email']."</center></td>
            
            <td> 
                <a href='index.php?page=5&action=sup&id_operation=".$uneOperation['id_operation']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=5&action=edit&id_operation=".$uneOperation['id_operation']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>
        </tr>";
        } 
        ?>
    </table>
</div>


		

