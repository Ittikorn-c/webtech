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
}
if($ses_sesid <> session_id() or $ses_userid =="" or $ses_userstatus != 'admin'){
    echo "<meta http-equiv='refresh' content='1;URL=../home/index_user.html'>";
}
else{
$connection = new PDO(
   'mysql:host=localhost:3306;dbname=getevent_database;charset=utf8mb4',
   'root',
   '');
$statement = $connection->query('SELECT * FROM event_detail');
$count=0;
while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $count+=1;
    echo "<tr id='event-". $row['event_id'] . "'>";
    echo "<td><input type='checkbox' class='child' />" ." $count."."</td>";
    echo "<td>" . $row['event_id'] . "</td>";
    echo "<td>" . $row['event_name'] . "</td>";
    echo "<td>" . $row['event_category'] . "</td>";
    echo "<td>" . $row['event_date'] . "</td>";
    echo "<td>" . $row['event_start']."-".$row['event_end']  . "</td>";
    echo "<td>" . $row['event_price'] . "</td>";
    echo "<td>" . $row['event_seat'] . "</td>";
    echo "<td>" . $row['event_size'] . "</td>";
    echo "<td>" . $row['user_id'] . "</td>";
    echo "</tr>";
}
}
?>
