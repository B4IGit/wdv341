<?php
    /**This program will prove the Events class
     Create an event object from the Events class
     Run ALL methods of the new event object to verify they work as expected
     */

     include 'Event.php';

     //create a new object
     $eventObject = new Event();

     echo $eventObject->get_events_name();
     $eventObject->set_events_name('WDV341');
     echo $eventObject->get_events_name();

     echo '<br>';
     
     $eventObject->set_events_description('Introduction to PHP');
     echo $eventObject->get_events_description();

    echo '<br>';

    $eventObject->set_events_presenter('Jeff Guillion');
    echo $eventObject->get_events_presenter();

    echo '<br>';

    $eventObject->set_events_date('2023-08-29');
    echo $eventObject->get_events_date();

    echo '<br>';

    $eventObject->set_events_time('13:00:00');
    echo $eventObject->get_events_time();

    echo '<br>';

    $eventObject->set_events_date_inserted('2023-09-26');
    echo $eventObject->get_events_date_inserted();

    echo '<br>';

    $eventObject->set_events_date_updated('2023-09-26');
    echo $eventObject->get_events_date_updated();

    echo '<br>';
    echo '<br>';

    echo json_encode($eventObject);

     

     

/*
$eventObject = new stdClass();
     $eventObject -> events_name = $eventRecord['events_name'];
     $eventObject -> events_desc = $eventRecord['events_description'];
     $eventObject -> events_pres = $eventRecord['events_presenter'];
     $eventObject -> events_date = $eventRecord['events_date'];
     $eventObject -> events_time = $eventRecord['events_time'];
     $eventObject -> events_date_insert =$eventRecord['events_date_inserted'];
     $eventObject -> events_date_update = $eventRecord['events_date_updated'];

     var_dump($eventObject);

     echo json_encode($eventObject);

     */
    
    ?>