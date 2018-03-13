<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "getevent_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$event = $_GET['q'];
// sql to delete a record
$sql3 = "DELETE FROM userevent WHERE event_id=$event";
$sql6 = "DELETE FROM event_comment WHERE event_id=$event";
$sql5 = "DELETE FROM event_detail WHERE event_id=$event";

if ($conn->query($sql3) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
if ($conn->query($sql6) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
if ($conn->query($sql5) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>