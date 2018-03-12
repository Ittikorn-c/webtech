<?php
$q = $_GET['q'];

include("connect.php");
// Create connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "select * from event_detail where event_category='$q' order by event_date ASC, event_start ASC";

$result = $conn->query($sql); 

$count = 0;
$is_outofdate = 0;
$y = date("Y");
$m = date("m");
$d = date("d");

if($result->num_rows == 0){
    echo "Coming Soon...";
}
else{
    while($event = $result->fetch_assoc()) {
        $date = explode("-", $event['event_date']);
        if (($date[0] > $y) || ($date[0] == $y && $date[1] > $m) || ($date[0] == $y && $date[1] == $m && $date[2] > $d)){
            if ($count%2 == 0) {
                echo "
                <div class='container left'>
                  <div class='content'>
                  <a href='../event/showEvent.html?event=" . $event['event_id'] . "'>
                  <div class='row'>
                      <div class='col-sm-4'>
                          <img src='" . $event["event_poster"] . "' alt='Card image' style='width:100%'>
                      </div>
                      <div class='col-sm-6'>
                          <h5 class='card-title' id='event-name'>" . $event["event_name"] . "</h5>
                          <p class='card-text' id='event-details'>" . $event["event_date"] . " " . $event["event_start"] . "<br>" . $event["event_location"] . "</p>
                          <button name='button' id='showeventbtn' type='submit' class='btn btn-xs btn-block btn-secondary pull-right event-btn event-btn-small'>View Detail</button>
                      </div>
                    </div>
                    </a>
                  </div>
                </div>
              ";}else {
                  echo "
                  <div class='container right'>
                    <div class='content'>
                    <a href='../event/showEvent.html?event=" . $event["event_id"] . "'>
                    <div class='row'>
                        <div class='col-sm-4'>
                            <img src='" . $event["event_poster"] . "' alt='Card image' style='width:100%'>
                        </div>
                        <div class='col-sm-6'>
                            <h5 class='card-title' id='event-name'>" . $event["event_name"] . "</h5>
                            <p class='card-text' id='event-details'>" . $event["event_date"] . " " . $event["event_start"] . "<br>" . $event["event_location"] . "</p>
                            <button name='button' id='showeventbtn' type='submit' class='btn btn-xs btn-block btn-secondary pull-right event-btn event-btn-small'>View Detail</button>
                        </div>
                    </div>
                    </a>
                    </div>
                  </div>
                ";}
              $count++;
              $is_outofdate = 0;
            }else{
                $is_outofdate = 1;
            }
        }
        if ($is_outofdate == 1){
            echo "Coming Soon...";
        }
    } 
$conn->close();
?>