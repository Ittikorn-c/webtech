<?php
session_start(); //เปิด session
$ses_sesid = "";
$ses_userid = "";
$ses_username = "";
$ses_userstatus ="";
if(isset($_SESSION['ses_sesid']) && isset($_SESSION['ses_userid']) && isset($_SESSION['ses_username']) && isset($_SESSION['ses_status'])){
    $ses_sesid = $_SESSION['ses_sesid'];  
    $ses_userid =$_SESSION['ses_userid'];                                          
    $ses_username = $_SESSION['ses_username'];   
    $ses_userstatus = $_SESSION['ses_status'];
}     

if($ses_sesid <> session_id() or $ses_userstatus !="organizers"){
    
}
else{

include("../home/php/connect.php"); 


$organizer_id = $ses_userid;

if ($_POST['request'] === 'requesting') {

	$query = "SELECT userevent.user_id, user.user_email, userevent.event_id, event_detail.event_name FROM (userevent INNER JOIN event_detail) INNER JOIN user ON event_detail.event_id = userevent.event_id WHERE event_detail.user_id = '$organizer_id' and userevent.user_status = 'W' and userevent.user_id = user.user_id ORDER BY userevent.event_id";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
        $event_id = "0";
    	while($row = $result->fetch_assoc()) {
            if ($row['event_id'] != $event_id) {
                $count = 1;
                if ($event_id != 0) {
                    echo "  </tbody>
                    </table>
                    <div class='text-right'>
                        <button type='button' style='margin-right: 10px' class='btn btn-success' id='accept-btn-".$event_id."'><h5>Accept</h5></button>
                        <button type='button' class='btn btn-danger' id='decline-btn-".$event_id."'><h5>Decline</h5></button>
                    </div>";
                }
                echo "<h2>".$row['event_name']."</h2>"."
                <table class='table table-hover text-center'>
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>E-mail</th>
                            <th>Status</th>
                            <th><input type='checkbox' class='select-all' id='select-all-".$row['event_id']."'><label for='select-all-'".$row['event_id'].">Select All</label></th>
                        </tr>
                    </thread>
                    <tbody>";
                $event_id = $row['event_id'];
            }
            $id = $row['event_id'].'-'.$row['user_id'];
            echo "<tr class='select-row' id='select-row-".$id."'>
                        <td><b>".$count."</b></td>
                        <td><b>".$row['user_id']."</b></td>
                        <td><b>".$row['user_email']."</b></td>
                        <td id='status-".$id."'>
                            <b class='text-primary'>Waiting</b>
                        </td>
                        <td id='checkbox-cell-".$id."'>
                            <input type='checkbox' class='select-".$row['event_id']."' name='select-".$row['event_id']."' value='select-".$id."' id='select-".$id."'>
                        </td>
                  </tr>";
    	    $count++;
        }
        echo "  </tbody>
            </table>
            <div class='text-right'>
                <button type='button' style='margin-right: 10px' class='btn btn-success' id='accept-btn-".$event_id."'><h5>Accept</h5></button>
                <button type='button' class='btn btn-danger' id='decline-btn-".$event_id."'><h5>Decline</h5></button>
            </div>";
	} else {
    	echo "<p class='text-center display-4'>No New Applying Request</p>";
    }
 

} else {

    // $query = "SELECT user_email FROM user WHERE user_id = '$user_id'";
    // $result = $conn->query($query);
    // $row = $result->fetch_assoc();
    // $to = $row['user_email'];
    // $subject = $event_id;
    // $headers = "From: jutinapas@gmail.com" . "\r\n" . "CC: event.organizer@company.com";

    foreach ($_POST['selectedId'] as $id) {
        $arr = explode('-', $id);
        $event_id = $arr[0];
        $user_id = $arr[1];

        echo $user_id, $event_id;

        if ($_POST['isAccept'] === 'yes') {
        $query = "UPDATE userevent SET user_status = 'A' WHERE user_id = '$user_id' and event_id = '$event_id'";
        // $txt = "CONFIRM!";
        } else {
        $query = "UPDATE userevent SET user_status = 'D' WHERE user_id = '$user_id' and event_id = '$event_id'";
        // $txt = "DECLINE!";
        }
        $conn->query($query);
    }

    // mail($to,$subject,$txt,$headers);

}
$conn->close();
}
?>