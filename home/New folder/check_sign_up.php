<?php
include("connect.php");

$email = $_POST["email"];
$password = $_POST["password"];
$hash = password_hash( $password, PASSWORD_DEFAULT);
$firstname = $_POST["fname"];
$lastname = $_POST["lname"];
$birthday = $_POST["year"] . "-" . $_POST["month"] . "-" . $_POST["day"];
$gender = $_POST["gender"];

$query = "select * from user where user_email = '$email'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    $query = "INSERT INTO userprofile (user_id, user_firstname, user_lastname, phonenumber, birthday, gender, user_image, address, cardnumber, holdername, month, year, cvv) VALUES (NULL, '$firstname', '$lastname', '', '$birthday', '$gender', '', '', NULL, NULL, NULL, NULL, NULL)";
    $conn->query($query);
    $query = "INSERT INTO user (user_id, user_email, user_password, user_status) VALUES (NULL, '$email', '$hash', 'u')";
    $conn->query($query);
    echo 'complete';
    echo "<meta http-equiv='refresh' content='1;URL=../index_user.html'>";
} else {
    echo '<script>alert("used")</script>';
    echo "<meta http-equiv='refresh' content='1;URL=../index_user.html'>";
}

$conn->close();


?>