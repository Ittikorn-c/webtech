<?php
    session_start(); //เปิด session
    $ses_sesid = "";
    $ses_userid = "";
    $ses_username = "";
    $ses_userstatus ="";

    if(isset($_SESSION['ses_userid']) && isset($_SESSION['ses_username']) && isset($_SESSION['ses_status'])){
      $ses_sesid = $_SESSION['ses_sesid'];
      $ses_userid = $_SESSION['ses_userid'];
      $ses_username = $_SESSION['ses_username'];
      $ses_userstatus = $_SESSION['ses_status'];
    }

    include("connect.php");

    if($ses_sesid <> session_id() or $ses_userid =="" or $ses_userstatus == 'user' or $ses_userstatus == 'admin'){
      echo "<div style='margin-left: 10%; margin-top: 2%; padding: 4px 12px; background-color: #ffdddd; border-left: 6px solid #f44336;'>
              <p><strong>YOU CANNOT ACCESS!</strong></p>
            </div>";
    }elseif ($ses_userstatus == 'organizers') {
      $sql = "select * from event_detail WHERE event_detail.user_id = $ses_userid ORDER BY event_detail.event_date ASC, event_detail.event_start ASC ";
      $result = $conn->query($sql);

      if ($result->num_rows <= 0) {

      }else{
        $count = 0;
        $y = date("Y");
        $m = date("m");
        $d = date("d");

        while ($data = $result->fetch_assoc() ) {
          $date = explode("-", $data['event_date']);
          $availale = $data['event_size']-$data['event_seat'];
          $sqlA = "select COUNT(ue.user_status) FROM userevent as ue JOIN event_detail as ed ON ue.event_id = ed.event_id and ed.user_id = $ses_userid and ed.event_id = $data[event_id] WHERE ue.user_status = 'A'";
          $sqlW = "select COUNT(ue.user_status) FROM userevent as ue JOIN event_detail as ed ON ue.event_id = ed.event_id and ed.user_id = $ses_userid and ed.event_id = $data[event_id] WHERE ue.user_status = 'W'";
          $approved = $conn->query($sqlA);
          $waiting = $conn->query($sqlW);

          if (($date[0] > $y) || ($date[0] == $y && $date[1] > $m) || ($date[0] == $y && $date[1] == $m && $date[2] > $d)){
            if ($count%2 == 0) {
              echoLeft($data,$availale,$approved,$waiting);
            }else {
              echoRight($data,$availale,$approved,$waiting);
            }
            $count++;
          }
        }
      }
    }

    function echoLeft($data,$availale,$approved,$waiting){
      echo "
      <div class='container left'>
        <div class='content'>
          <a href='../event/showEvent.html?event=" . $data['event_id'] . "'>
            <div class='row'>
              <div class='col-xs-10'>
                <img src='$data[event_poster]' alt='Card image'>
              </div>
              <div class='col-sm-8'>
                <h5 class='card-title' id='event-name'> " . $data["event_name"] . "</h5>
                <p class='card-text' id='event-details'>Date: " . $data["event_date"] . " <br>Time: " . $data["event_start"] . " - " . $data["event_end"] . " <br>Location: " . $data["event_location"] . "</p>
                <p> Available : $availale " . '/' . " $data[event_size] ";

                if ($approved->num_rows <= 0) {
                  echo "<br> Approved : 0 ";
                }elseif ($waiting->num_rows <= 0) {
                  echo "<br> Waiting : 0 </p>";
                }else {
                  while ($a = $approved->fetch_assoc()) {
                    echo "<br> Approved : " . $a['COUNT(ue.user_status)'] . "";
                  }
                  while ($w = $waiting->fetch_assoc()) {
                    echo "<br> Waiting : " . $w['COUNT(ue.user_status)'] . "</p>";
                  }
                }

      echo "
                <a href='../manage/event_confirmation.html' name='button' type='submit' class='btn btn-xs btn-secondary pull-right event-btn event-btn-small'>Approve the participant</a>
              </div>
            </div>
          </a>
        </div>
      </div>
    ";
    }

    function echoRight($data,$availale,$approved,$waiting){
      echo "
      <div class='container right'>
      <div class='content'>
        <a href='../event/showEvent.html?event=" . $data['event_id'] . "'>
          <div class='row'>
            <div class='col-xs-10'>
              <img src='$data[event_poster]' alt='Card image'>
            </div>
            <div class='col-sm-8'>
              <h5 class='card-title' id='event-name'> " . $data["event_name"] . "</h5>
              <p class='card-text' id='event-details'>Date: " . $data["event_date"] . " <br>Time: " . $data["event_start"] . " - " . $data["event_end"] . " <br>Location: " . $data["event_location"] . "</p>
              <p> Available : $availale " . '/' . " $data[event_size] </p>";

              if ($approved->num_rows <= 0) {
                echo "<br> Approved : 0 ";
              }elseif ($waiting->num_rows <= 0) {
                echo "<br> Waiting : 0 </p>";
              }else {
                while ($a = $approved->fetch_assoc()) {
                  echo "<br> Approved : " . $a['COUNT(ue.user_status)'] . "";
                }
                while ($w = $waiting->fetch_assoc()) {
                  echo "<br> Waiting : " . $w['COUNT(ue.user_status)'] . "</p>";
                }
              }


    echo "
              <a href='../manage/event_confirmation.html' name='button' type='submit' class='btn btn-xs btn-secondary pull-right event-btn event-btn-small'>Approve the participant</a>
            </div>
          </div>
        </a>
      </div>
    </div>
  ";
    }

?>
