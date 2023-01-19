
    <div class="table-responsive w-100" style="height:40vh;border : 4px solid #86B9BB;  border-radius: 10px;">
        <table class="table table-striped table-sm" >
            <tr class="text-center fw-bold text-light" style="background:#86B9BB;opacity : 0.57; border-bottom: 4px solid  #86B9BB; ">
                <td>ID</td>
                <td>Raison</td>
                <td>Date début</td>
                <td>Durée estimée</td>
                <td>Date fin </td>
                <td>Hopital</td>
                <td>Patient</td>
                <td>Medecin</td>
                <td>Opération</td>
            </tr>
            
        <?php 
        foreach ($LesHospitalisations as $UneHospitalisation) { 
        echo "<tr class='text-center'>
            <td><center>".$UneHospitalisation['id_hospitalisation']."</center></td>
            <td><center>".$UneHospitalisation['raison']."</center></td>
            <td><center>".$UneHospitalisation['date_debut']."</center></td>
            <td><center>".$UneHospitalisation['date_fin_estimee']."</center></td>
            <td><center>".$UneHospitalisation['date_fin']."</center></td>
            <td><center>".$UneHospitalisation['id_hopital']."</center></td>
            <td><center>".$UneHospitalisation['id_patient']."</center></td>
            <td><center>".$UneHospitalisation['id_medecin']."</center></td>
            
            <td> 
                <a href='index.php?page=4&action=sup&id_hospitalisation=".$UneHospitalisation['id_hospitalisation']."'><img src='img/sup.png' height='30' width='30'></a>                            
                <a href='index.php?page=4&action=edit&id_hospitalisation=".$UneHospitalisation['id_hospitalisation']."'><img src='img/edit.png' height='30' width='30'></a>
            </td>
        </tr>";
        } 
        ?>

    </table>
</div>
