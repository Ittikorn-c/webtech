<?php
	$id = $_GET['event'];
	$myObj = new stdClass();

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "getevent_database";

	if(!isset($_SESSION)) {
     		session_start();
	}

	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "Select * from event_detail where event_id='".$id."';";
	$query = mysqli_query($conn, $sql);

	if ($query){
		$row = mysqli_fetch_array($query);
		$myObj->name = $row['event_name'];
		$myObj->size = $row['event_size'];
		$myObj->cat = $row['event_category'];
		$myObj->location = $row['event_location'];
		$myObj->date = $row['event_date'];
		$myObj->start = $row['event_start'];
		$myObj->end = $row['event_end'];
		$myObj->invite = $row['event_invitation'];
		$myObj->poster = $row['event_poster'];
		$myObj->video = $row['event_video'];
		$myObj->type = $row['event_type'];
		$myObj->price = $row['event_price'];

		$myObj->detail = $row['event_detail'];
		$myObj->condition = $row['preCondition'];
		$myObj->lat = $row['lat'];
		$myObj->lng = $row['lng'];
		
		$_SESSION['type'] = $row['event_type'];
		$_SESSION['condition'] = $row['preCondition'];
	}

	$conn->close();


	$myJSON = json_encode($myObj);

	echo $myJSON;
?>