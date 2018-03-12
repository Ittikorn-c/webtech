<?php
	$id = $_GET['event'];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "getevent_database";
	$table = "event_comment";

	//create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	//check connection
	// if ($conn->connect_error){
	// 	die("Connection failed: ".$conn->connect_error);
	// }else{
	// 	echo "<script>console.log('Connectioned successfully');</script>";
	// }

	
	$sql = "Select * from event_comment where event_id='".$id."'";
	$result = $conn->query($sql);
	if ($result == TRUE){
		while($row = $result->fetch_assoc()) {
			echo "<div style='background-color: #555; color: white; padding-left: 1em;'>User :  ".$row["user_id"]."<br>";
			echo nl2br($row["comment_detail"])."</div><br>";
    	}
	}else{
		echo "<script>console.log(Error: ".$sql.")<br>".$conn->error."<script>";
	}
 ?>