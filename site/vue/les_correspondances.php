 <div class="table-responsive w-100" style="height:40vh;border : 4px solid #86B9BB;  border-radius: 10px;">
    <table class="table table-striped table-sm" >
        <tr class="text-center fw-bold text-light" style="background:#86B9BB;opacity : 0.57; border-bottom: 4px solid  #86B9BB; ">
            <td>ID</td>
            <td>Titre</td>
            <td>Contenu</td>
            <td>Medecin source</td>
            <td>Medecin cible </td>
            <td>Patient </td>
            <td>Opération</td>
        </tr>
        
        <?php 
        foreach ($lesCorrespondances as $uneCorrespondance) {
            $tab2=array($uneCorrespondance['email']);
            $cle=$unControleur->callproc('getkey',$tab2);
            $cle = $cle['cle'];

        echo "<tr class='text-center'>
            <td><center>".$uneCorrespondance['id_correspondance']."</center></td>
            <td><center>".$unControleur->decrypt($uneCorrespondance['titre'], $cle)."</center></td>
            <td><center>".$unControleur->decrypt($uneCorrespondance['contenu'], $cle)."</center></td>
            <td><center>".$uneCorrespondance['id_medecin_source']."</center></td>
            <td><center>".$uneCorrespondance['id_medecin_cible']."</center></td>
            <td><center>".$uneCorrespondance['id_patient']."</center></td>
            
            <td> 
                <a href='index.php?page=18&action=sup&id_correspondance=".$uneCorrespondance['id_correspondance']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=18&action=edit&id_correspondance=".$uneCorrespondance['id_correspondance']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>
        </tr>";
        } 
        ?>
    </table>
</div>


		

