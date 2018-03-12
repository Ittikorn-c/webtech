<?php
	$id="";

	if(!isset($_SESSION)) {
     session_start();
	}
	$status = $_SESSION['ses_status'];
	$user = $_SESSION['ses_userid'];
	$type = $_SESSION['type'];
	$condition = $_SESSION['condition'];


	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "getevent_database";


	//create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	//check connection
	if ($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}else{
		echo "<script>console.log('Connectioned successfully');</script>";
	}

	if (isset($_POST["submit3"])){
		$id = $_POST['join'];


		if ($status != "user"){
			echo "<script>alert('You cannot access the event.')</script>";
		}else{
			if ($type == "free" && $condition != ""){
				$sql = "INSERT INTO userevent(event_id, user_id, user_payment) VALUES('$id', '$user', 'T');";
			}
			else if ($type == "free" && $condition == ""){
				$sql = "INSERT INTO userevent(event_id, user_id, user_status, user_payment) VALUES('$id', '$user', 'A', 'T');";
			}
			else if ($type != "free" && $condition != ""){
				$sql = "INSERT INTO userevent(event_id, user_id) VALUES('$id', '$user');";
			}
			else if ($type != "free" && $condition == ""){
				$sql = "INSERT INTO userevent(event_id, user_id, user_status) VALUES('$id', '$user', 'A');";
			}
			
			if ($conn->query($sql) === TRUE) {
    			echo "New record created successfully";
    			header('LOCATION: ../showEvent.html?event='.$id);
			} else {
    			echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}
?>