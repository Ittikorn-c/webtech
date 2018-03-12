<?php
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $detail = $_POST['detail'];

        include("connect.php"); 
        $sql = "insert into mailbox_support(user_mail, mail_title, mail_detail, mail_status) VALUES ('$email','$subject','$detail','n')";

        if ($conn->query($sql) === TRUE) {
            echo "successfully";
        } else {
            echo "Error" . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    
    echo "<meta http-equiv='refresh' content='1;URL=../index_user.html'>";
?>