<?php

	if(!isset($_SESSION)) {
     session_start();
	}
	$user = $_SESSION['ses_userid'];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "getevent_database";

	$name = $_POST['evName'];
	$size = $_POST['evSize'];
	$cat = $_POST['evCat'];
	$type = $_POST['evType'];
	$price = $_POST['price'];
	$location = $_POST['evLo'];
	$date = $_POST['evDate'];
	$start = $_POST['stTimeev'];
	$end = $_POST['endTimeev'];
	$invite = $_POST['evInvite'];
	$evaluation = $_POST['eva'];
	$poster = $_FILES["poster"]["name"];
	$video = $_FILES["evVideo"]["name"];
	$detail = $_POST['detail'];
	$condition = $_POST['pre-condition'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	


	//create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	//check connection
	if ($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}else{
		echo "<script>console.log('Connectioned successfully');</script>";
	}

		$typee = strtolower(pathinfo($_FILES['poster']['name'],PATHINFO_EXTENSION));
		$vidType = strtolower(pathinfo($_FILES['evVideo']['name'],PATHINFO_EXTENSION));
		echo '<script>console.log("image is inserted")</script>';
		$dest="../../Poster/".uniqid().".".$typee;
		move_uploaded_file($_FILES["poster"]["tmp_name"], $dest);
		$vnm = $_FILES["evVideo"]["name"];
		if ($vnm == ""){
			$des = "";
		}else{
			$des = "../Video/".uniqid().".".$vidTypee;
			move_uploaded_file($_FILES["evVideo"]["tmp_name"], $des);
			$des = substr($des,3);
		}

	$sql = "INSERT INTO event_detail (event_name, event_size, event_category, event_type, event_price, event_location, event_date, event_start, event_end, event_invitation, event_poster, event_video, event_detail, evaluation, preCondition, lat, lng, user_id) VALUES ('$name', '$size', '$cat', '$type', '$price', '$location', '$date', '$start', '$end', '$invite', '$dest', '$video', '$detail', '$evaluation', '$condition', '$lat', '$lng', '$user');";
	
	if ($conn->query($sql) === TRUE){
		echo "<script>console.log('Inserting successfully')</script>";
	}else{
		echo "<script>console.log(Error: ".$sql.")<br>".$conn->error."<script>";
	}

	$sql = "Select MAX(event_id) as max_id from event_detail;";
	$order = $conn->query($sql)->fetch_assoc()['max_id'];
	

	$conn->close();

	header('LOCATION: ../showEvent.html?event='.$order);;
	
?>