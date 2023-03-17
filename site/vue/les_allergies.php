<div class="table-responsive w-100" style="height:40vh;border : 4px solid #86B9BB;  border-radius: 10px;">
    <table class="table table-striped table-sm" >
        <tr class="text-center fw-bold text-light" style="background:#86B9BB;opacity : 0.57; border-bottom: 4px solid  #86B9BB; ">
            <td>ID</td>
            <td>Libellé</td>
            <td>Date de diagnostique</td>
            <td>Date de guérison</td>
            <td>Médecin</td>
            <td>Patient</td>
            <td>Opérations</td>
        </tr>
        
        <?php 
        foreach ($LesAllergies as $uneAllergie) { 
            $tab2=array($uneAllergie['email']);
            $cle=$unControleur->callproc('getkey',$tab2);
            $cle = $cle['cle'];
            $libelle = $unControleur->decrypt($uneAllergie['libelle'], $cle);

        echo "<tr class='text-center'>
            <td><center>".$uneAllergie['id_allergie']."</center></td>
            <td><center>".$libelle."</center></td>
            <td><center>".$uneAllergie['date_diagnostique']."</center></td>
            <td><center>".$uneAllergie['date_guerison']."</center></td>
            <td><center>".$uneAllergie['id_medecin']."</center></td>
            <td><center>".$uneAllergie['id_patient']." : ".$uneAllergie['email']."</center></td>
            
            <td> 
                <a href='index.php?page=6&action=sup&id_allergie=".$uneAllergie['id_allergie']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=6&action=edit&id_allergie=".$uneAllergie['id_allergie']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>
        </tr>";
        } 
        ?>
    </table>
</div>


		

