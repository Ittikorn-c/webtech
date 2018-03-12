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
$statement = $connection->query('SELECT * FROM user');
$statement2 = $connection->query('SELECT * FROM event_detail');
$User=0;
$Admin=0;
$Organizer=0;
$All=0;
$Event=0;
while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    if ($row['user_status'] == "u"){
        $User+=1;
    }
    if ($row['user_status'] == "a"){
        $Admin+=1;
    }
    if ($row['user_status'] == "o"){
        $Organizer+=1;
    }
    $All+=1;
}
while($row = $statement2->fetch(PDO::FETCH_ASSOC)) {
    $Event+=1;
}
echo "<h3>จำนวนสมาชิกทั้งหมด = $All</h3>";
echo "<a id='dashboard-all'></a>";

echo "<h3>จำนวนสมาชิกที่เป็น User = $User</h3>";
echo "<a id='dashboard-user'></a>";

echo "<h3>จำนวนสมาชิกที่เป็น Organizer = $Organizer</h3>";
echo "<a id='dashboard-organzier'></a>";

echo "<h3>จำนวนสมาชิกที่เป็น Admin = $Admin</h3>";
echo "<a id='dashboard-admin'></a>";

echo "<h3>จำนวน Event = $Event</h3>";
echo "<a id='dashboard-event'></a>";
}
?>
