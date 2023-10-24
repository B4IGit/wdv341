<?php
    require 'dbConnect.php';

    /*
     1. This file will put data from our events database.
     2. Format the events into a PHP object
            make a PHP object
            loaded values into the properties of the object
     3. Convert the PHP object into a JSON formatted object
     4. send the JSON object back to the calling program

     */

     $sql = 'SELECT events_name, events_description, events_presenter, events_date, events_time FROM wdv341_events WHERE events_id = :eventID LIMIT 1';

     $stmt= $conn->prepare($sql);
     
     $eventID = 3;
     $stmt->bindParam(':eventID', $eventID);
     
     $stmt->execute();
     
     $stmt->setFetchMode(PDO::FETCH_ASSOC);  // setting ALL fetch commands to return associative 

     $eventRecord = $stmt->fetch();     //return an associative array from database
     //echo $eventRecord['events_name'];        testing purposes

     echo '<br>';
     echo '<br>';

     //create class Event with every property from wdv341 column
     class Event {
        public $events_name;
        public $events_description;
        private $events_presenter;
        private $events_date;
        private $events_time;

        public function set_events_date($inDate) {
            $this->events_date = $inDate;
        }

        public function get_events_date() {
            return $this->events_date;
        }

               public function set_events_description($inDesc) {
                    $this->events_description = $inDesc;
                }

                public function get_events_description() {
                    return $this->events_description;
                }

                        public function set_events_name($inName) {
                                $this->events_name = $inName;
                        }

                        public function get_events_name() {
                                return $this->events_name;
                        }

                                public function set_events_presenter($preSent) {
                                    $this->events_presenter = $preSent;
                                }

                                public function get_events_presenter() {
                                    return $this->events_presenter;
                                }

                                        public function set_events_time($inTime) {
                                            $this->events_time = $inTime;
                                        }

                                       public  function get_events_time() {
                                            return $this->events_time;
                                        }

            public function getEvent () {
                $event = [];
                $event['inDate']=$this->get_events_date();
                $event['inDescription']= $this->get_events_description();
                $event['inName']=$this->get_events_name();
                $event['inPresenter']=$this->get_events_presenter();
                $event['inTime']=$this->get_events_time();
                return json_encode($event);
            }

     }

     // create instance event class
     $outputObj = new Event();

     //assign properties from DB
    $outputObj->events_name = $eventRecord['events_name'];
    $outputObj->events_description = $eventRecord['events_description'];
    $outputObj->set_events_presenter = $eventRecord['events_presenter'];
    $outputObj->set_events_date = $eventRecord['events_date'];
    $outputObj->set_events_time = $eventRecord['events_time'];

    $convertToJSON = json_encode($outputObj);


    // echo the JSON object
    echo $convertToJSON;

    echo '<br>';
    echo '<br>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
       .container {
        padding: 20px;
       }
        #padding {
            padding: .5em;
        }

        h2 {
            text-align: center;
        }

        table {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1em 0;
        }
    </style>
</head>
<body>
    <div class="container">
    <h2>Deliver Event Object</h2>
<?php
    $arr = json_decode($convertToJSON, true);

    echo '<table border="1">
        <tr>
            <th>Event Name</th>
            <th>Event Description</th>
            <th>Presenter</th>
            <th>Date</th>
            <th>Time</th>
        </tr>';

    echo '<tr>';
    echo '<td id="padding">' . $arr['events_name'] . '</td>';
    echo '<td id="padding">' . $arr['events_description'] . '</td>';
    echo '<td id="padding">' . $arr['set_events_presenter'] . '</td>';
    echo '<td id="padding">' . $arr['set_events_date'] . '</td>';
    echo '<td id="padding">' . $arr['set_events_time'] . '</td>';
    echo '</tr>';

    echo '</table>';
?>

<p>Above the h1 heading is a JSON formatted object using json_encode. I then used json_decode to pull the data back into a table using PHP.</p>
</div>


    
</body>
</html>