<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "getevent_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$email = $_POST["email"];
$password = $_POST["pwd"];
$hash = password_hash( $password, PASSWORD_DEFAULT);
$status = $_POST["status"];

$firstname = $_POST["fn"];
$lastname = $_POST["ln"];
$phone = $_POST["ph"];
$birthday = $_POST["bd"];
$address = $_POST["ad"];
$gender = $_POST["gender"];


$sql = "INSERT INTO user (user_email, user_password, user_status)
VALUES ('$email', '$hash', '$status')";

$sql2 = "INSERT INTO userprofile (user_firstname, user_lastname, phonenumber, birthday, address, gender)
VALUES ('$firstname', '$lastname', '$phone', '$birthday', '$address', $gender)";

if ($conn->query($sql) === TRUE) {
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
if ($conn->query($sql2) === TRUE) {
    
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}

$conn->close();
echo"<meta http-equiv='refresh' content='1;URL=../admin-users.html'>";
?>