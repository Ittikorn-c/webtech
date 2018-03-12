<?php
    session_start(); //เปิด session
    $ses_sesid = "";
    $ses_userid = "";
    $ses_username = "";
    $ses_userstatus ="";
    if(isset($_SESSION['ses_sesid']) && isset($_SESSION['ses_userid']) && isset($_SESSION['ses_username']) && isset($_SESSION['ses_status'])){
        $ses_sesid = $_SESSION['ses_sesid'];  
        $ses_userid =$_SESSION['ses_userid'];                                          //สร้าง session สำหรับเก็บค่า ID
        $ses_username = $_SESSION['ses_username'];   
        $ses_userstatus = $_SESSION['ses_status'];
    }                               //สร้าง session สำหรับเก็บค่า username

    if($ses_sesid <> session_id() or $ses_username ==""){
        echo "<button class='btn btn-success' id='myBtn'>Sign in / Sign up</button>";
    }

    else if ($ses_userstatus =="user"){
        echo "
            <div class='dropdown'>
                <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
                    $ses_username
                </button>
                <div class='dropdown-menu'>
                    <a class='dropdown-item' href='#'>Profile 1</a>
                    <a class='dropdown-item' href='#'>event</a>
                    <a class='dropdown-item' href='logout.php'>Log Out</a>
                </div>
            </div>";
    }
    else if ($ses_userstatus =="organizers"){
        echo "
            <div class='dropdown'>
                <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
                    $ses_username
                </button>
                <div class='dropdown-menu'>
                    <a class='dropdown-item' href='#'>Profile 1</a>
                    <a class='dropdown-item' href='#'>event</a>
                    <a class='dropdown-item' href='logout.php'>Log Out</a>
                </div>
            </div>";
    }
    else if ($ses_userstatus =="admin"){
        echo "
            <div class='dropdown'>
                <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
                    $ses_username
                </button>
                <div class='dropdown-menu'>
                    <a class='dropdown-item' href='admin/admin-dashboard.html'>manage Page</a>
                    <a class='dropdown-item' href='logout.php'>Log Out</a>
                </div>
            </div>";
    }

?>
