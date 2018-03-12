<?php
    session_start(); //เปิด session
    $ses_sesid = "";
    $ses_userid = "";
    $ses_username = "";
    $ses_userstatus ="";

    if(isset($_SESSION['ses_userid']) && isset($_SESSION['ses_username']) && isset($_SESSION['ses_status'])){
      $ses_sesid = $_SESSION['ses_sesid'];
      $ses_userid = $_SESSION['ses_userid'];            //สร้าง session สำหรับเก็บค่า ID
      $ses_username = $_SESSION['ses_username'];
      $ses_userstatus = $_SESSION['ses_status'];
    }                       //สร้าง session สำหรับเก็บค่า username

    include("connect.php");

    $count = 0;
    $y = date("Y");
    $m = date("m");
    $d = date("d");

    if($ses_sesid <> session_id() or $ses_userid =="" or $ses_userstatus == 'admin' or $ses_userstatus == 'user'){
      echo "<div style='margin-bottom: 15px; padding: 4px 12px; width: 200%; background-color: #ffdddd; border-left: 6px solid #f44336;'>
              <p><strong>YOU CANNOT ACCESS!</strong></p>
            </div>";
    }elseif ($ses_userstatus == 'organizers') {
      $sql = "select * from event_detail WHERE event_detail.user_id = $ses_userid ORDER BY event_detail.event_date DESC, event_detail.event_start DESC ";
      $result = $conn->query($sql);

      while ($data = $result->fetch_assoc() ) {
        $date = explode("-", $data['event_date']);
        if (($date[0] < $y) || ($date[0] == $y && $date[1] < $m) || ($date[0] == $y && $date[1] == $m && $date[2] <= $d)){
          if ($count%2 == 0) {
            echo "
              <div class='left'>
                <div class='card'>
                  <div class='card-body' style='padding-bottom: 10px;'>
                    <a href='../event/showEvent.html?event=" . $data['event_id'] . "'>
                      <div class='row'>
                        <div class='col-xs-10'>
                          <img src='$data[event_poster]' alt='Event image' style='width: 50%;'>
                        </div>
                        <div class='col-sm-8' style='position: absolute; right: -2.5%;'>
                          <h5 class='card-title' id='event-name'> " . $data["event_name"] . "</h5>
                          <p class='card-text' id='event-details'>Date: " . $data["event_date"] . " <br>Time: " . $data["event_start"] . " - " . $data["event_end"] . " <br>Location: " . $data["event_location"] . "</p>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
          ";}else {
              echo "
              <div class='right'>
                <div class='card'>
                  <div class='card-body' style='padding-bottom: 10px;'>
                    <a href='../event/showEvent.html?event=" . $data['event_id'] . "'>
                      <div class='row'>
                        <div class='col-xs-10'>
                          <img src='$data[event_poster]' alt='Event image' style='width: 50%;'>
                        </div>
                        <div class='col-sm-8' style='position: absolute; right: -2.5%;'>
                          <h5 class='card-title' id='event-name'> " . $data["event_name"] . "</h5>
                          <p class='card-text' id='event-details'>Date: " . $data["event_date"] . " <br>Time: " . $data["event_start"] . " - " . $data["event_end"] . " <br>Location: " . $data["event_location"] . "</p>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            ";}
          $count++;
        }
      }
    }

?>
