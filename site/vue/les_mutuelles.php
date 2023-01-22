<div class="table-responsive" style="height:50vh;border : 4px solid #86B9BB;  border-radius: 10px;">
    <table class="table table-striped table-sm" >
        <tr class="text-center fw-bold text-light" style="background:#86B9BB;opacity : 0.57; border-bottom: 4px solid  #86B9BB; ">
            <td>ID</td>
            <td>Libellé</td>
            <td>Prise en charge (%)</td>
            <td>Opérations</td>
        </tr>
        
        <?php 
        foreach ($LesMutuelles as $uneMutuelle) { 
        echo "<tr class='text-center'>
            <td><center>".$uneMutuelle['id_mutuelle']."</center></td>
            <td><center>".$uneMutuelle['libelle']."</center></td>
            <td><center>".$uneMutuelle['pourcent_rembourse']."</center></td>
            
            <td> 
                <a href='index.php?page=23&action=sup&id_mutuelle=".$uneMutuelle['id_mutuelle']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=23&action=edit&id_mutuelle=".$uneMutuelle['id_mutuelle']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>
        </tr>";
        } 
        ?>
    </table>
</div>


		

