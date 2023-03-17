
    <div class="table-responsive w-100" style="height:40vh;border : 4px solid #86B9BB;  border-radius: 10px;">
        <table class="table table-striped table-sm" >
            <tr class="text-center fw-bold text-light" style="background:#86B9BB;opacity : 0.57; border-bottom: 4px solid  #86B9BB; ">
                <td>ID</td>
                <td>Libelle</td>
                <td>Posologie</td>
                <td>Date début</td>
                <td>Date fin </td>
                <td>prix par unité</td>
                <td>Medecin</td>
                <td>Patient</td>
                <td>Opération</td>
            </tr>
            
            <?php 
        foreach ($LesTraitements as $unTraitement) { 
            $tab2=array($unTraitement['email']);
            $cle=$unControleur->callproc('getkey',$tab2);
            $cle = $cle['cle'];

        echo "<tr class='text-center'>
            <td><center>".$unTraitement['id_traitement']."</center></td>
            <td><center>".$unControleur->decrypt($unTraitement['libelle'], $cle)."</center></td>
            <td><center>".$unTraitement['posologie']."</center></td>
            <td><center>".$unTraitement['date_debut']."</center></td>
            <td><center>".$unTraitement['date_fin']."</center></td>
            <td><center>".$unTraitement['prix_par_unite']."</center></td>
            <td><center>".$unTraitement['id_medecin']."</center></td>
            <td><center>".$unTraitement['id_patient']." : ".$unTraitement['email']."</center></td>
            
            <td> 
                <a href='index.php?page=10&action=sup&id_traitement=".$unTraitement['id_traitement']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=10&action=edit&id_traitement=".$unTraitement['id_traitement']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>
        </tr>";
        } 
        ?>
    </table>
</div>


