<?php
session_start();
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

$username = $_POST['username'];
$password = $_POST['password'];

if($username == "") {                    
    echo "คุณยังไม่ได้กรอกชื่อผู้ใช้ครับ";
    echo "<meta http-equiv='refresh' content='1;URL=../index_user.html'>";
} else if($password == "") {        
    echo "คุณยังไม่ได้กรอกรหัสผ่านครับ";
    echo "<meta http-equiv='refresh' content='1;URL=../index_user.html'>";
} else {                                               
include("connect.php");   
$ssql = "select * from user where user_email ='$username'";
$result = $conn->query($ssql);
if($result->num_rows <=0) {
    echo "Username หรือ Password อาจจะผิดกรุณา Login ใหม่อีกครั้ง";
    echo "<meta http-equiv='refresh' content='1;URL=../index_user.html'>";
}
else{
    while ($data = $result->fetch_assoc() ) {
    if(password_verify( $password, $data['user_password'] )){
        if($data['user_status']=="o"){                          
            $_SESSION['ses_sesid'] = session_id();            
            $_SESSION['ses_userid'] = $data["user_id"];
            $_SESSION['ses_username'] = $data["user_email"];      
            $_SESSION['ses_status'] = "organizers";                      
            echo "<meta http-equiv='refresh' content='1;URL=../index_user.html'>";
        
        
        }elseif($data['user_status']=="u"){                              
            $_SESSION['ses_sesid'] = session_id();            
            $_SESSION['ses_userid'] = $data["user_id"];
            $_SESSION['ses_username'] = $data["user_email"];   
            $_SESSION['ses_status'] = "user";
            echo "<meta http-equiv='refresh' content='1;URL=../index_user.html'>";
        
        }
        elseif($data['user_status']=="a"){                              
            $_SESSION['ses_sesid'] = session_id();            
            $_SESSION['ses_userid'] = $data["user_id"];
            $_SESSION['ses_username'] = $data["user_email"];   
            $_SESSION['ses_status'] = "admin";
            echo "<meta http-equiv='refresh' content='1;URL=../index_user.html'>";
        
        }
    }}
}
}
?>