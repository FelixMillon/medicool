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
            <td>Patient</td>
            <td>Opération</td>
        </tr>
        
        <?php 
        foreach ($LesExamens as $unExamen) { 
            $tab2=array($unExamen['email']);
            $cle=$unControleur->callproc('getkey',$tab2);
            $cle = $cle['cle'];
            $libelle = $unControleur->decrypt($unExamen['libelle'], $cle);
        echo "<tr class='text-center'>
            <td><center>".$unExamen['id_examen']."</center></td>
            <td><center>".$unControleur->decrypt($unExamen['libelle'], $cle)."</center></td>
            <td><center>".$unExamen['date']."</center></td>
            <td><center>".$unExamen['prix_examen']."</center></td>
            <td><center>".$unControleur->decrypt($unExamen['resultat'], $cle)."</center></td>
            <td><center>".$unControleur->decrypt($unExamen['commentaire'], $cle)."</center></td>
            <td><center>".$unExamen['id_medecin']."</center></td>
            <td><center>".$unExamen['id_patient']."</center></td>
            
            <td> 
                <a href='index.php?page=7&action=sup&id_examen=".$unExamen['id_examen']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=7&action=edit&id_examen=".$unExamen['id_examen']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>
        </tr>";
        } 
        ?>
    </table>
</div>


		

