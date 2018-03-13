<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "getevent_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$id = $_GET['q'];
// sql to delete a record

$sql2 = "DELETE FROM mailbox_support WHERE user_id=$id";
$sql3 = "DELETE FROM userevent WHERE user_id=$id";
$sql4 = "DELETE FROM userprofile WHERE user_id=$id";
$sql5 = "DELETE FROM event_detail WHERE user_id=$id";
$sql6 = "DELETE FROM event_comment WHERE user_id=$id";
$sql1 = "DELETE FROM user WHERE user_id=$id";

if ($conn->query($sql2) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
if ($conn->query($sql3) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
if ($conn->query($sql4) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
if ($conn->query($sql5) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
if ($conn->query($sql6) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
if ($conn->query($sql1) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>