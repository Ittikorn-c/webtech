<?php
session_start(); //เปิด seesion เพื่อทำงาน
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
//กำหนดภาษาของเอกสารให้เป็น UTF-8

$username = $_POST['username'];
//ประกาศซตัวแปรชื่อ username โดยการรับค่ามาจากกล่อง username ที่หน้า Login
$password = $_POST['password'];
//ประกาศซตัวแปรชื่อ password โดยการรับค่ามาจากกล่อง password ที่หน้า Login
if($username == "") {                    //ถ้ายังไม่ได้กรอกข้อมูลที่ชื่อผู้ใช้ให้ทำงานดังต่อไปนี้
echo "คุณยังไม่ได้กรอกชื่อผู้ใช้ครับ";
} else if($password == "") {        //ถ้ายังไม่ได้กรอกรหัสผ่านให้ทำงานดังต่อไปนี้
echo "คุณยังไม่ได้กรอกรหัสผ่านครับ";
} else {                                               //ถ้ากรอกข้อมูลทั้งหมดแล้วให้ทำงานดังนี้
include("connect.php");           //เรียก function สำหรับติดต่อฐานข้อมูลจากหน้า connect.php ขึ้นมา
$sql = "select * from user where user_email ='$username' and user_password ='$password' ";

$result = $conn->query($sql);                           //ใช้ภาษา SQL ตรวจสอบข้อมูลในฐานข้อมูล

//ให้เอาค่าที่ได้ออกมาประกาศเป็นตัวแปรชื่อ $num_rows
if($result->num_rows <=0) {                                                           //ถ้าหากค่าที่ได้ออกมามีค่าต่ำกว่า 1
echo "Username หรือ Password อาจจะผิดกรุณา Login ใหม่อีกครั้ง <br /><a href='index.php'>Back</a>";
} else {
while ($data = $result->fetch_assoc() ) {
//ถ้าค่ามีมากกว่า 0 ขึ้นไป ให้ดึงข้อมูลออกมาทั้งหมด
if($data['user_status']=="o"){                          //ตรวจสอบสถานะของผู้ใช้ว่าเป็น Admin
                //สร้าง session สำหรับให้ admin นำค่าไปใช้งาน
    $_SESSION['ses_sesid'] = session_id();            //สร้าง session สำหรับเก็บค่า ID
    $_SESSION['ses_userid'] = $data["user_id"];
    $_SESSION['ses_username'] = $data["user_email"];      //สร้าง session สำหรับเก็บค่า Username
    $_SESSION['ses_status'] = "organizers";                      //สร้าง session สำหรับเก็บค่า สถานะความเป็น Admin
    echo "<meta http-equiv='refresh' content='1;URL=index_user.html'>";
//ส่งค่าจากหน้านี้ไปหน้า index_admin.php

}elseif($data['user_status']=="u"){                              //ตรวจสอบสถานะของผู้ใช้งานว่าเป็น user
    $_SESSION['ses_sesid'] = session_id();            //สร้าง session สำหรับเก็บค่า ID
    $_SESSION['ses_userid'] = $data["user_id"];
    $_SESSION['ses_username'] = $data["user_email"];   
    $_SESSION['ses_status'] = "user";
    echo "<meta http-equiv='refresh' content='1;URL=index_user.html'>";
//ส่งค่าจากหน้านี้ไปหน้า index_user.php

}
elseif($data['user_status']=="a"){                              //ตรวจสอบสถานะของผู้ใช้งานว่าเป็น user
    $_SESSION['ses_sesid'] = session_id();            //สร้าง session สำหรับเก็บค่า ID
    $_SESSION['ses_userid'] = $data["user_id"];
    $_SESSION['ses_username'] = $data["user_email"];   
    $_SESSION['ses_status'] = "admin";
    echo "<meta http-equiv='refresh' content='1;URL=index_user.html'>";
//ส่งค่าจากหน้านี้ไปหน้า index_user.php
}
}
}
}
?>