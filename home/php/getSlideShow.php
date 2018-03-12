<?php
    include("connect.php");
    // Create connection
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "select * from event_detail order by event_date ASC, event_start ASC";
    
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
        echo "<div class='row'>
        <div class='col-md-12'>
            <div id='slide-show' class='carousel slide' data-ride='carousel'>
            <ul class='carousel-indicators'>
            <li data-target='#slide-show' data-slide-to='0' class='active'></li>
            <li data-target='#slide-show' data-slide-to='1'></li>
            <li data-target='#slide-show' data-slide-to='2'></li>
            <li data-target='#slide-show' data-slide-to='3'></li>
        </ul>
        <div class='carousel-inner'>";
        while($event = $result->fetch_assoc()) {
            $date = explode("-", $event['event_date']);
            if (($date[0] > $y) || ($date[0] == $y && $date[1] > $m) || ($date[0] == $y && $date[1] == $m && $date[2] > $d)){
                if($count == 0){
                echo "<div class='carousel-item active'>
                    <a href='../event/showEvent.html?event=" . $event['event_id'] . "'><img src=" .$event['event_poster'] . " height='40%' width='100%'></a>
                    </div>";
                }
                else {
                    echo "<div class='carousel-item'>
                    <a href='../event/showEvent.html?event=" . $event['event_id'] . "'><img src=" .$event['event_poster'] . " height='40%' width='100%'></a>
                    </div>";
                }
                $count++;
            }

            if ($count==4){
                break;
            }
        }
        echo "</div>
                    <a class='carousel-control-prev' href='#slide-show' data-slide='prev'>
                        <span class='carousel-control-prev-icon'></span>
                    </a>
                    <a class='carousel-control-next' href='#slide-show' data-slide='next'>
                        <span class='carousel-control-next-icon'></span>
                    </a>
                </div>
            </div>
        </div>";
    }
       
?>