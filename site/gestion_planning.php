<?php
    $lesEvents = array();
    if(isset($_POST['Afficher']))
    {

        $num_semaine = $_POST['semaine']; // Numéro de la semaine recherchée
        $year =  $_POST['annee'];
        $month = $_POST['mois'];
        $weekInMonth = $_POST['semaine'];
        $firstDayOfMonth = new DateTime("$year-$month-01");
        $firstDayOfWeek = $firstDayOfMonth->modify('first day of this month')->modify('+' . ($weekInMonth - 1) . ' week');
        $lundi = clone $firstDayOfWeek->modify('next monday');
        $samedi = clone $firstDayOfWeek->modify('next saturday');
        $_SESSION['jour'] = clone $lundi;
    }
    if(isset($_POST['prevWeek']))
    {
        $_SESSION['jour']->modify('last monday');
    }
    if(isset($_POST['nextWeek']))
    {
      $_SESSION['jour']->modify('next monday');
    }
    if(isset($_POST['thisWeek']))
    {
        $date = new DateTime();
        $date->setISODate($date->format('o'), $date->format('W'), 1);
        $_SESSION['jour'] = $date;
    }
    if(isset($lundi)){
      $laSemaine = $lundi;
    }else{
      $laSemaine = $_SESSION['jour'];
      $lundi = clone $_SESSION['jour'];
      $samedi = clone $_SESSION['jour'];
      $samedi->modify('next saturday');
    }
    if (setlocale(LC_TIME, 'fr_FR') == '') {
      setlocale(LC_TIME, 'FRA');
    }



      // Création d'un objet DateTime à partir de la date saisie
      $lundi->setTime(8, 0, 0, 0);
      $samedi->setTime(21, 0, 0, 0);
      $formatted_lundi = $lundi->format('Y-m-d\TH:i:s.v\Z');
      $formatted_samedi = $samedi->format('Y-m-d\TH:i:s.v\Z');
      // Chargez la bibliothèque cliente PHP de Google à l'aide de Composer
      require_once __DIR__ . '/vendor/autoload.php';

      // Initialisez la bibliothèque avec votre clé API
      $client = new Google_Client();
      $client->setDeveloperKey('AIzaSyCarDGV9tZuQLV8PVu5_CrPj4fa_YV2pm4');

      // Créez un service Google Calendar
      $service = new Google_Service_Calendar($client);

      // Récupérez les événements entre deux dates
      $calendarId = 'medicoolagenda@gmail.com'; // Id du calendrier (par défaut, il s'agit du calendrier principal)
      $optParams = array(
          'timeMin' => $formatted_lundi, // Date de début de la plage de temps au format ISO 8601
          'timeMax' => $formatted_samedi, // Date de fin de la plage de temps au format ISO 8601
          'maxResults' => 10, // Nombre maximum d'événements à récupérer
          'orderBy' => 'startTime', // Ordonner les événements par date de début
          'singleEvents' => true, // Récupérer les événements récurrents en tant qu'occurrences individuelles
      );
      try {
          $results = $service->events->listEvents($calendarId, $optParams);
      } catch (Google_Service_Exception $e) {
          echo "Erreur : " . $e->getMessage();
      }
      // Parcourir les résultats pour afficher les informations des événements
      if (count($results->getItems()) != 0){
        foreach ($results->getItems() as $event) {
          $start = $event->getStart()->dateTime;
          $end = $event->getEnd()->dateTime;
          if (empty($start)) {
            $start = $event->getStart()->date;
            $end = $event->getEnd()->date;
          }
          $dureeEvent = strtotime($end) - strtotime($start);
          $dureeEvent = $dureeEvent/3600; 
          $jsonevent="{\"nom\": \"".$event->getSummary()."\",";
          $jsonevent.="\"numjour\": \"".date('N', strtotime($start))."\",";
          $jsonevent.="\"heure\": \"".date('H', strtotime($start))."\",";
          $jsonevent.="\"minute\": \"".date('i', strtotime($start))."\",";
          $jsonevent.="\"duree\": \"".$dureeEvent."\",";
          $jsonevent.="\"description\": \"".$event->getDescription()."\"";
          $jsonevent.="}";
          $lesEvents[count($lesEvents)] = $jsonevent;
        }
        $jsonAllEvent ="[".implode(',',$lesEvents)."]";
      }


require_once ("vue/les_plannings.php"); 

?>

