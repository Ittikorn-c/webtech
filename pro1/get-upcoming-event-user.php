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
    include("phpqrcode/qrlib.php");

    if ($ses_sesid <> session_id() or $ses_userid =="" or $ses_userstatus == 'organizers' or $ses_userstatus == 'admin'){
      echo "<div style='margin-left: 10%; margin-top: 2%; padding: 4px 12px; background-color: #ffdddd; border-left: 6px solid #f44336;'>
              <p><strong>YOU CANNOT ACCESS!</strong></p>
            </div>";
    }elseif ($ses_userstatus == 'user'){
      $sql = "select * from userevent join event_detail ON userevent.user_id = $ses_userid WHERE userevent.event_id = event_detail.event_id ORDER BY event_detail.event_date ASC, event_detail.event_start ASC";
      $result = $conn->query($sql);
      $result2 = $conn->query($sql);

      if ($result->num_rows <= 0 || $result2->num_rows <= 0) {

      }else{
        $count = 0;
        $y = date("Y");
        $m = date("m");
        $d = date("d");

        echo "<div>
                <nav class='navbar navbar-expand-sm bg-dark navbar-dark'>
                    <a class='navbar-brand' href='#'>Approved</a>
                </nav>
                <div id='approved'>";

        while ($data = $result->fetch_assoc()) {
          $date = explode("-", $data['event_date']);

          if (($date[0] > $y) || ($date[0] == $y && $date[1] > $m) || ($date[0] == $y && $date[1] == $m && $date[2] > $d)){
            if ($data['user_status'] == "W") {
              if ($count%2 == 0) {
                echoRight($data);
              }else {
                echoLeft($data);
              }
              $count++;
            }
          }
        }
        echo "
                </div>
            </div>";

        echo "<div>
                <nav class='navbar navbar-expand-sm bg-dark navbar-dark'>
                    <a class='navbar-brand' href='#'>Waiting</a>
                </nav>
                <div id='waiting'>";

        while ($data = $result2->fetch_assoc()) {
          $date = explode("-", $data['event_date']);
          $forqr = $conn->query("select up.user_firstname as fn ,up.user_lastname as ln,up.gender as gender ,ue.user_status as status FROM userprofile as up JOIN userevent as ue on up.user_id = ue.user_id and ue.event_id = $data[event_id] WHERE ue.user_id = $ses_userid");

          if (($date[0] > $y) || ($date[0] == $y && $date[1] > $m) || ($date[0] == $y && $date[1] == $m && $date[2] > $d)){
            if ($data['user_status'] == "A") {
                if ($count%2 == 0) {
                  rApproved($data,$forqr, $data['user_payment']);
                }else {
                  lApproved($data,$forqr,$data['user_payment']);
                }
                $count++;
            }
          }
        }
        echo "
                </div>
            </div>";
    }
  }

    function echoRight($data){
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
              ";

        echo "
              </div>
            </div>
          </a>
        </div>
      </div>
    ";}

    function echoLeft($data){
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
              ";

        echo "
              </div>
            </div>
          </a>
        </div>
      </div>
    ";}

    function rApproved($data,$forqr,$status)
    {
      echo "<div class='container left'>
              <div class='content'>
                <a href='../event/showEvent.html?event=" . $data['event_id'] . "'>
                  <div class='row'>
                    <div class='col-xs-10'>
                      <img src='$data[event_poster]' alt='Card image'>
                    </div>
                    <div class='col-sm-8'>
                    <h5 class='card-title' id='event-name'> " . $data["event_name"] . "</h5>
                    <p class='card-text' id='event-details'>Date: " . $data["event_date"] . " <br>Time: " . $data["event_start"] . " - " . $data["event_end"] . " <br>Location: " . $data["event_location"] . "</p>";

                    if ($status == 'F'){
                      echo "
                    <p style='text-align: right; margin-right: 25%; margin-top: 5%;'>
                      <a href='payment.html?event=$data[event_id]' name='button' type='submit' class='btn btn-xs btn-secondary pull-right event-btn event-btn-small'>Pay</a>
                    </p>";
                  }else{
                    if ($forqr->num_rows <= 0) {
                      echo "0";
                    }else {
                      while ($text = $forqr->fetch_assoc()) {
                        $qrtext = $text['fn'] . " " . $text['fn'] . " " . $text['gender'] . " " . $text['status'];
                        QRcode::png($qrtext, 'checkin.png');
                        echo '<img src="checkin.png" />';
                      }
                    }
                  }

      echo "        </div>
                  </div>
                </a>
              </div>
            </div>";
    }
    function lApproved($data,$forqr,$status)
    {
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
            <p class='card-text' id='event-details'>Date: " . $data["event_date"] . " <br>Time: " . $data["event_start"] . " - " . $data["event_end"] . " <br>Location: " . $data["event_location"] . "</p>";

            if ($status == 'F'){
              echo "
            <p style='text-align: right; margin-right: 25%; margin-top: 5%;'>
              <a href='payment.html?event=$data[event_id]' name='button' type='submit' class='btn btn-xs btn-secondary pull-right event-btn event-btn-small'>Pay</a>
            </p>";
          }else{
            if ($forqr->num_rows <= 0) {
              echo "0";
            }else {
              while ($text = $forqr->fetch_assoc()) {
                $qrtext = $text['fn'] . " " . $text['fn'] . " " . $text['gender'] . " " . $text['status'];
                QRcode::png($qrtext, 'checkin.png');
                echo '<img src="checkin.png" />';
              }
            }
          }

echo "        </div>
          </div>
        </a>
      </div>
    </div>";
    }
?>
