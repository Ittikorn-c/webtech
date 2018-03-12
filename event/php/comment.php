<?php  

	if(!isset($_SESSION)) {
     session_start();
	}
	$status = $_SESSION['ses_status'];
	$user = $_SESSION['ses_userid'];
	$type = $_SESSION['type'];

	$id="";

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "getevent_database";
	$table = "event_comment";

	//create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	//check connection
	if ($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}else{
		echo "<script>console.log('Connectioned successfully');</script>";
	}

		$ment = $_POST['ment'];
		$id = $_POST['idEvent'];

		$sql = "INSERT INTO event_comment(event_id, user_id, comment_detail) VALUES('$id', '$user', '$ment');";
		if ($conn->query($sql) === TRUE) {
    		echo "New record created successfully";
    		header('LOCATION: ../showEvent.html?event='.$id);
		} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}


?>