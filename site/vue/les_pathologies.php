    <div class="table-responsive w-100" style="height:40vh;border : 4px solid #86B9BB;  border-radius: 10px;">
        <table class="table table-striped table-sm" >
            <tr class="text-center fw-bold text-light" style="background:#86B9BB;opacity : 0.57; border-bottom: 4px solid  #86B9BB; ">
                <td>ID</td>
                <td>Libelle</td>
                <td>Date diagnositque</td>
                <td>Date guérison </td>
                <td>Médecin</td>
                <td>Patient</td>
                <td>Opération</td>
            </tr>
            
            <?php 
        foreach ($LesPathologies as $unePathologie) { 
            $tab2=array($unePathologie['email']);
            $cle=$unControleur->callproc('getkey',$tab2);
            $cle = $cle['cle'];

        echo "<tr class='text-center'>
            <td><center>".$unePathologie['id_path']."</center></td>
            <td><center>".$unControleur->decrypt($unePathologie['libelle'], $cle)."</center></td>
            <td><center>".$unePathologie['date_diagnostique']."</center></td>
            <td><center>".$unePathologie['date_guerison']."</center></td>
            <td><center>".$unePathologie['id_medecin']."</center></td>
            <td><center>".$unePathologie['id_patient']." : ".$unePathologie['email']."</center></td>
            
            <td> 
                <a href='index.php?page=9&action=sup&id_path=".$unePathologie['id_path']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=9&action=edit&id_path=".$unePathologie['id_path']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>
        </tr>";
        } 
        ?>
    </table>
</div>


