<form method="POST">
    <input type="submit" value="Semaine précedente" name="prevWeek">
    <input type="submit" value="Semaine courante" name="thisWeek">
    <select name="annee">
        <option value="">Année</option>
        <?php
            $current_year = date('Y');
            for ($i = $current_year - 5; $i <= $current_year + 5; $i++) {
            echo '<option value="' . $i . '">' . $i . '</option>';
            }
        ?>
    </select>
    <select  name="mois">
        <?php
        $months = array(
            "" => 'Mois',
            1 => 'Janvier',
            2 => 'Février',
            3 => 'Mars',
            4 => 'Avril',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juillet',
            8 => 'Août',
            9 => 'Septembre',
            10 => 'Octobre',
            11 => 'Novembre',
            12 => 'Décembre'
        );
        foreach ($months as $value => $label) {
            echo '<option value="' . $value . '">' . $label . '</option>';
        }
        ?>
    </select>
    <select name="semaine">
        <option value="">Semaine</option>
        <?php
            for ($i = 1; $i <= 4; $i++) {
            echo '<option value="' . $i . '">' . $i . '</option>';
            }
        ?>
    </select>
        <input type="submit" value="Afficher" name="Afficher">
        <input type="submit" value="Semaine suivante" name="nextWeek">
</form>
<div style="display: flex; flex-direction: column; height: 87vh;"> 
    <div style="margin: 6% 6% 3% 6%;" >
    <div class="table-responsive" style="height:72vh;">

            <table class="table " style="height:72vh; table-layout: fixed ;width: 100%" id="mytable">
                <tr class="text-center"  style="border-bottom: 4px solid  #3B7476;">
                    <?php
                    echo '<th style="width: 5%;">Horaire</th>
                        <th>Lundi '.date('d', strtotime($laSemaine->format('d-m-Y'))).' '.utf8_encode(strftime('%B', mktime(0, 0, 0, date_parse_from_format('Y-m-d\TH:i:sP', $laSemaine->format('d-m-Y'))['month'], 1))).'</th>
                        <th>Mardi '.date('d', strtotime($laSemaine->format('d-m-Y') . ' +1 day')).' '.utf8_encode(strftime('%B', mktime(0, 0, 0, date('n', strtotime(date('Y-m-d', strtotime($laSemaine->format('d-m-Y') . '+1 day')))), 1))).'</th>
                        <th>Mecredi '.date('d', strtotime($laSemaine->format('d-m-Y') . ' +2 day')).' '.utf8_encode(strftime('%B', mktime(0, 0, 0, date('n', strtotime(date('Y-m-d', strtotime($laSemaine->format('d-m-Y') . '+2 day')))), 1))).'</th>
                        <th>Jeudi '.date('d', strtotime($laSemaine->format('d-m-Y') . ' +3 day')).' '.utf8_encode(strftime('%B', mktime(0, 0, 0, date('n', strtotime(date('Y-m-d', strtotime($laSemaine->format('d-m-Y') . '+3 day')))), 1))).'</th>
                        <th>Vendredi '.date('d', strtotime($laSemaine->format('d-m-Y') . ' +4 day')).' '.utf8_encode(strftime('%B', mktime(0, 0, 0, date('n', strtotime(date('Y-m-d', strtotime($laSemaine->format('d-m-Y') . '+4 day')))), 1))).'</th>
                        <th>Samedi '.date('d', strtotime($laSemaine->format('d-m-Y') . ' +5 day')).' '.utf8_encode(strftime('%B', mktime(0, 0, 0, date('n', strtotime(date('Y-m-d', strtotime($laSemaine->format('d-m-Y') . '+5 day')))), 1))).'</th>';
                    ?>
                </tr>
            <tr>
                <td class="d-flex flex-column bd-highlight text-center">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid"><small><br>8:00</small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>8:15 </small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>8:30</small></div>
                        <div class="subdivision"><small><br>8:45</small></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="1-8-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-8-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-8-3"></div>
                        <div class="subdivision" id="1-8-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="2-8-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-8-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-8-3"></div>
                        <div class="subdivision" id="2-8-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="3-8-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-8-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-8-3"></div>
                        <div class="subdivision" id="3-8-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="4-8-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-8-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-8-3"></div>
                        <div class="subdivision" id="4-8-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="5-8-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-8-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-8-3"></div>
                        <div class="subdivision" id="5-8-4"></div>
                    </div>
                </td>
                <td style="border-right: unset;">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="6-8-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-8-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-8-3"></div>
                        <div class="subdivision" id="6-8-4"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="d-flex flex-column bd-highlight text-center">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid"><small><br>9:00</small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>9:15 </small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>9:30</small></div>
                        <div class="subdivision"><small><br>9:45</small></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="1-9-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-9-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-9-3"></div>
                        <div class="subdivision" id="1-9-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="2-9-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-9-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-9-3"></div>
                        <div class="subdivision" id="2-9-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="3-9-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-9-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-9-3"></div>
                        <div class="subdivision" id="3-9-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="4-9-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-9-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-9-3"></div>
                        <div class="subdivision" id="4-9-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="5-9-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-9-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-9-3"></div>
                        <div class="subdivision" id="5-9-4"></div>
                    </div>
                </td>
                <td style="border-right: unset;">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="6-9-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-9-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-9-3"></div>
                        <div class="subdivision" id="6-9-4"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="d-flex flex-column bd-highlight text-center">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid"><small><br>10:00</small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>10:15 </small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>10:30</small></div>
                        <div class="subdivision"><small><br>10:45</small></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="1-10-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-10-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-10-3"></div>
                        <div class="subdivision" id="1-10-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="2-10-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-10-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-10-3"></div>
                        <div class="subdivision" id="2-10-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="3-10-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-10-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-10-3"></div>
                        <div class="subdivision" id="3-10-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="4-10-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-10-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-10-3"></div>
                        <div class="subdivision" id="4-10-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="5-10-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-10-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-10-3"></div>
                        <div class="subdivision" id="5-10-4"></div>
                    </div>
                </td>
                <td style="border-right: unset;">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="6-10-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-10-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-10-3"></div>
                        <div class="subdivision" id="6-10-4"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="d-flex flex-column bd-highlight text-center">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid"><small><br>11:00</small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>11:15 </small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>11:30</small></div>
                        <div class="subdivision"><small><br>11:45</small></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="1-11-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-11-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-11-3"></div>
                        <div class="subdivision" id="1-11-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="2-11-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-11-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-11-3"></div>
                        <div class="subdivision" id="2-11-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="3-11-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-11-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-11-3"></div>
                        <div class="subdivision" id="3-11-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="4-11-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-11-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-11-3"></div>
                        <div class="subdivision" id="4-11-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="5-11-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-11-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-11-3"></div>
                        <div class="subdivision" id="5-11-4"></div>
                    </div>
                </td>
                <td style="border-right: unset;">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="6-11-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-11-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-11-3"></div>
                        <div class="subdivision" id="6-11-4"></div>
                    </div>
                </td>
            </tr>
            <tr>
            <td class="d-flex flex-column bd-highlight text-center">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid"><small><br>12:00</small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>12:15 </small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>12:30</small></div>
                        <div class="subdivision"><small><br>12:45</small></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="1-12-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-12-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-12-3"></div>
                        <div class="subdivision" id="1-12-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="2-12-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-12-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-12-3"></div>
                        <div class="subdivision" id="2-12-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="3-12-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-12-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-12-3"></div>
                        <div class="subdivision" id="3-12-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="4-12-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-12-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-12-3"></div>
                        <div class="subdivision" id="4-12-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="5-12-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-12-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-12-3"></div>
                        <div class="subdivision" id="5-12-4"></div>
                    </div>
                </td>
                <td style="border-right: unset;">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="6-12-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-12-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-12-3"></div>
                        <div class="subdivision" id="6-12-4"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="d-flex flex-column bd-highlight text-center">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid"><small><br>13:00</small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>13:15 </small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>13:30</small></div>
                        <div class="subdivision"><small><br>13:45</small></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="1-13-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-13-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-13-3"></div>
                        <div class="subdivision" id="1-13-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="2-13-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-13-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-13-3"></div>
                        <div class="subdivision" id="2-13-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="3-13-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-13-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-13-3"></div>
                        <div class="subdivision" id="3-13-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="4-13-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-13-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-13-3"></div>
                        <div class="subdivision" id="4-13-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="5-13-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-13-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-13-3"></div>
                        <div class="subdivision" id="5-13-4"></div>
                    </div>
                </td>
                <td style="border-right: unset;">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="6-13-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-13-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-13-3"></div>
                        <div class="subdivision" id="6-13-4"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="d-flex flex-column bd-highlight text-center">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid"><small><br>14:00</small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>14:15 </small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>14:30</small></div>
                        <div class="subdivision"><small><br>14:45</small></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="1-14-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-14-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-14-3"></div>
                        <div class="subdivision" id="1-14-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="2-14-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-14-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-14-3"></div>
                        <div class="subdivision" id="2-14-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="3-14-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-14-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-14-3"></div>
                        <div class="subdivision" id="3-14-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="4-14-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-14-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-14-3"></div>
                        <div class="subdivision" id="4-14-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="5-14-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-14-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-14-3"></div>
                        <div class="subdivision" id="5-14-4"></div>
                    </div>
                </td>
                <td style="border-right: unset;">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="6-14-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-14-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-14-3"></div>
                        <div class="subdivision" id="6-14-4"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="d-flex flex-column bd-highlight text-center">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid"><small><br>15:00</small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>15:15 </small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>15:30</small></div>
                        <div class="subdivision"><small><br>15:45</small></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="1-15-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-15-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-15-3"></div>
                        <div class="subdivision" id="1-15-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="2-15-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-15-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-15-3"></div>
                        <div class="subdivision" id="2-15-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="3-15-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-15-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-15-3"></div>
                        <div class="subdivision" id="3-15-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="4-15-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-15-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-15-3"></div>
                        <div class="subdivision" id="4-15-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="5-15-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-15-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-15-3"></div>
                        <div class="subdivision" id="5-15-4"></div>
                    </div>
                </td>
                <td style="border-right: unset;">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="6-15-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-15-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-15-3"></div>
                        <div class="subdivision" id="6-15-4"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="d-flex flex-column bd-highlight text-center">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid"><small><br>16:00</small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>16:15 </small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>16:30</small></div>
                        <div class="subdivision"><small><br>16:45</small></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="1-16-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-16-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-16-3"></div>
                        <div class="subdivision" id="1-16-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="2-16-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-16-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-16-3"></div>
                        <div class="subdivision" id="2-16-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="3-16-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-16-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-16-3"></div>
                        <div class="subdivision" id="3-16-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="4-16-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-16-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-16-3"></div>
                        <div class="subdivision" id="4-16-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="5-16-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-16-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-16-3"></div>
                        <div class="subdivision" id="5-16-4"></div>
                    </div>
                </td>
                <td style="border-right: unset;">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="6-16-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-16-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-16-3"></div>
                        <div class="subdivision" id="6-16-4"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="d-flex flex-column bd-highlight text-center">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid"><small><br>17:00</small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>17:15 </small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>17:30</small></div>
                        <div class="subdivision"><small><br>17:45</small></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="1-17-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-17-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-17-3"></div>
                        <div class="subdivision" id="1-17-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="2-17-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-17-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-17-3"></div>
                        <div class="subdivision" id="2-17-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="3-17-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-17-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-17-3"></div>
                        <div class="subdivision" id="3-17-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="4-17-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-17-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-17-3"></div>
                        <div class="subdivision" id="4-17-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="5-17-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-17-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-17-3"></div>
                        <div class="subdivision" id="5-17-4"></div>
                    </div>
                </td>
                <td style="border-right: unset;">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="6-17-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-17-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-17-3"></div>
                        <div class="subdivision" id="6-17-4"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="d-flex flex-column bd-highlight text-center">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid"><small><br>18:00</small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>18:15 </small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>18:30</small></div>
                        <div class="subdivision"><small><br>18:45</small></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="1-18-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-18-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-18-3"></div>
                        <div class="subdivision" id="1-18-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="2-18-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-18-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-18-3"></div>
                        <div class="subdivision" id="2-18-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="3-18-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-18-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-18-3"></div>
                        <div class="subdivision" id="3-18-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="4-18-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-18-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-18-3"></div>
                        <div class="subdivision" id="4-18-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="5-18-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-18-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-18-3"></div>
                        <div class="subdivision" id="5-18-4"></div>
                    </div>
                </td>
                <td style="border-right: unset;">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="6-18-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-18-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-18-3"></div>
                        <div class="subdivision" id="6-18-4"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="d-flex flex-column bd-highlight text-center">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid"><small><br>19:00</small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>19:15 </small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>19:30</small></div>
                        <div class="subdivision"><small><br>19:45</small></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="1-19-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-19-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-19-3"></div>
                        <div class="subdivision" id="1-19-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="2-19-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-19-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-19-3"></div>
                        <div class="subdivision" id="2-19-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="3-19-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-19-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-19-3"></div>
                        <div class="subdivision" id="3-19-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="4-19-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-19-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-19-3"></div>
                        <div class="subdivision" id="4-19-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="5-19-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-19-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-19-3"></div>
                        <div class="subdivision" id="5-19-4"></div>
                    </div>
                </td>
                <td style="border-right: unset;">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="6-19-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-19-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-19-3"></div>
                        <div class="subdivision" id="6-19-4"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="d-flex flex-column bd-highlight text-center">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid"><small><br>20:00</small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>20:15 </small></div>
                        <div class="subdivision" style="border-bottom: solid"><small><br>20:30</small></div>
                        <div class="subdivision"><small><br>20:45</small></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="1-20-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-20-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="1-20-3"></div>
                        <div class="subdivision" id="1-20-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="2-20-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-20-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="2-20-3"></div>
                        <div class="subdivision" id="2-20-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="3-20-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-20-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="3-20-3"></div>
                        <div class="subdivision" id="3-20-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="4-20-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-20-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="4-20-3"></div>
                        <div class="subdivision" id="4-20-4"></div>
                    </div>
                </td>
                <td>
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="5-20-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-20-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="5-20-3"></div>
                        <div class="subdivision" id="5-20-4"></div>
                    </div>
                </td>
                <td style="border-right: unset;">
                    <div class="container">
                        <div class="subdivision" style="border-bottom: solid" id="6-20-1"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-20-2"></div>
                        <div class="subdivision" style="border-bottom: solid" id="6-20-3"></div>
                        <div class="subdivision" id="6-20-4"></div>
                    </div>
                </td>
            </tr>

            </table>
        </div>
    </div>
</div>
<script>
    function placementEvent()
    {
        let lacarte = "";
        let lequart ="";
        let duree ="";
        let lheure = 0;
        let id_cible = "";
        let description = "-";
        let k = 0;
        let lesEvents = <?php echo $jsonAllEvent; ?>;
        for(let i = 0; i < lesEvents.length; i++)
        {
            if(lesEvents[i]['description']!= ""){
                description=lesEvents[i]['description'];
            }else{
                description = "-";
            }
            lacarte = '<div class="p-2 Card"><small>'+lesEvents[i]['nom']+'<br>'+description+'</small></div>';
            if(lesEvents[i]['minute']<15){
                lequart = 1; 
            }else if(lesEvents[i]['minute']<30){
                lequart = 2; 
            }else if(lesEvents[i]['minute']<45){
                lequart = 3; 
            }else{
                lequart = 4;
            }
            duree=0;
            k=0;
            while(k<lesEvents[i]['duree'])
            {
                duree++
                k=k+0.25;
            }
            lheure= lesEvents[i]['heure'];
            for(let j = 1; j <= duree; j++)
            {

                id_cible= lesEvents[i]['numjour']+'-'+lheure+'-'+lequart;
                lequart++;
                document.getElementById(id_cible).innerHTML = lacarte;
                if(lequart%4==1)
                {
                    lheure++;
                    lequart=1;
                }
            }
        }
        
    }
    placementEvent();

</script>

<style>
    td{
    border-right : 4px solid #3B7476;
    border-bottom : 4px solid #3B7476;

    }
    .table-responsive{
    border : 4px solid #3B7476;  border-radius: 10px;
    
    }


    th{
        font-size: 12px;
    }

    .Card{
        background:#86B9BB;
        width: 100%;
        height:100%;
        color: white;
        border-radius: 15px;
        margin-top : 3px;

    }

    .container {
        display: flex;
        flex-direction: column;
        height: 300px; /* Hauteur de la div container */
    }

    .subdivision {
        flex: 1; /* Partage l'espace disponible en 4 sous-divisions égales */
        padding-bottom: 5.5px;
    }
</style>
