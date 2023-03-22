 <div class="table-responsive w-100" style="height:40vh;border : 4px solid #86B9BB;  border-radius: 10px;">
    <table class="table table-striped table-sm" >
        <tr class="text-center fw-bold text-light" style="background:#86B9BB;opacity : 0.57; border-bottom: 4px solid  #86B9BB; ">
            <td>ID</td>
            <td>Libelle</td>
            <td>Date</td>
            <td>Montant total</td>
            <td>Montant sécurite social</td>
            <td>Montant mutuelle</td>
            <td>Prix à payer</td>
            <td>Montant à payer</td>
            <td>État</td>
            <td>Medecin</td>
            <td>Patient</td>
            <td>Opération</td>
        </tr>
        
        <?php 
        foreach ($LesFactures as $uneFacture) {

            $tab2=array(hash('sha256',$uneFacture['email']));
            $cle=$unControleur->callproc('getkey',$tab2);
            $cle = $cle['cle'];

        echo "<tr class='text-center'>
            <td><center>".$uneFacture['id_facture']."</center></td>
            <td><center>".$unControleur->decrypt($uneFacture['libelle'], $cle)."</center></td>
            <td><center>".$uneFacture['date_facturation']."</center></td>
            <td><center>".$uneFacture['montant_total']."</center></td>
            <td><center>".$uneFacture['montant_secu']."</center></td>
            <td><center>".$uneFacture['montant_mutuelle']."</center></td>
            <td><center>".$uneFacture['prix_a_payer']."</center></td>
            <td><center>".$uneFacture['montant_paye']."</center></td>
            <td><center>".$uneFacture['etat']."</center></td>
            <td><center>".$uneFacture['id_medecin']."</center></td>
            <td><center>".$uneFacture['id_patient']."</center></td>
            
            <td> 
                <a href='index.php?page=17&action=sup&id_facture=".$uneFacture['id_facture']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=17&action=edit&id_facture=".$uneFacture['id_facture']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>
        </tr>";
        } 
        ?>
    </table>
</div>


		

