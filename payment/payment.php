<?php

session_start();
$ses_sesid = "";
$ses_userid = "";
$ses_username = "";
$ses_userstatus = "";

if (isset($_SESSION['ses_sesid']) && isset($_SESSION['ses_userid']) && isset($_SESSION['ses_username']) && isset($_SESSION['ses_userstatus'])) {
	$ses_sesid = $_SESSION['ses_sesid'];
	$ses_userid = $_SESSION['ses_userid'];
	$ses_username = $_SESSION['ses_username'];
	$ses_userstatus = $_SESSION['ses_userstatus'];
} if ($ses_sesid <> session_id() or $ses_username == "") {
	echo "ERROR";
} else {
	
	include("connect.php");

	$event_id = $_GET['event'];
	$fname = $_POST['fname'];
	$lnaem = $_POST['lname'];
	$email = $_POST['email'];
	$tel = $_POST['tel'];
	$cc_num = $_POST['cc-num'];
	$cc_name = $_POST['cc-name'];
	$cc_exp_date = $_POST['cc-exp-date'];
	$cc_ccv = $_POST['cc-ccv'];

	$ses_sesid = $_SESSION['ses_sesid'];
	$event_id = 8;

	$query = "UPDATE userevent SET user_payment = 'T' WHERE user_id = '$ses_sesid' AND event_id = '$event_id'";
	$conn->query($query);

	echo "<script>alert('Payment Successful')</script>";
	echo "<meta http-equiv='refresh' content='1;URL=../index_user.html'>";

	$conn->close();
}

function getUserInfo() {

}

?>