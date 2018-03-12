<?php
    require './dbConnect.php';
//    $ses_userid = $_SESSION['ses_userid'];

    $id = 3;
    if (isset($_POST['submit'])){
    $user_firstname = $_POST['firstName'];
    $user_lastname = $_POST['lastName'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['Address'];
    $email = $_POST['emailAddress'];
    $password = $_POST['NewPassword'];
    $repassword = $_POST['Re-typeNewPassword'];
    $filetemp = $_FILES['fileToUpload']['tmp_name'];
    $filename = $_FILES['fileToUpload']['name'];
    $filetype = $_FILES['fileToUpload']['type'];
    $filepath = "C:/xampp/htdocs/user-organizer_profile/images/".$filename;
    $moved= move_uploaded_file($filetemp,$filepath);
    if ($password!=$repassword){
      echo "<script type='text/javascript'>alert('Password not match');</script>";
      echo "<script>window.location = 'user_profile.php#popup'</script>";
    }elseif ($user_firstname==" " || $user_firstname=="") {
      echo "<script type='text/javascript'>alert('Please fill in Firstname.');</script>";
      echo "<script>window.location = 'user_profile.php#popup'</script>";
    }elseif ($user_lastname==" " || $user_lastname=="") {
      echo "<script type='text/javascript'>alert('Please fill in Lastname. ');</script>";
      echo "<script>window.location = 'user_profile.php#popup'</script>";
    }elseif ($address==" " || $address=="") {
      echo "<script type='text/javascript'>alert('Please fill in Address. ');</script>";
      echo "<script>window.location = 'user_profile.php#popup'</script>";
    }elseif ($email==" " || $email=="") {
      echo "<script type='text/javascript'>alert('Please fill in Email');</script>";
      echo "<script>window.location = 'user_profile.php#popup'</script>";
    }elseif ($phonenumber==" " || $phonenumber=="") {
      echo "<script type='text/javascript'>alert('Please fill in Phone number');</script>";
      echo "<script>window.location = 'user_profile.php#popup'</script>";
    }
    else{
      $phonenumber = "0"+$phonenumber;
      if($moved)
      {
          echo "sucess";
          $filename = "images/".$filename;
          $sql = "update userprofile set user_firstname='$user_firstname' ,
          address='$address',user_lastname='$user_lastname',user_image='$filename',phonenumber=$phonenumber where user_id='$id';";
      }
      else
      {
          echo 'failed';
          $sql = "update userprofile set user_firstname='$user_firstname' ,
          address='$address',user_lastname='$user_lastname',phonenumber=$phonenumber where user_id='$id';";
      }
      $result= mysqli_query($connect,$sql);
      $sql = "update user set user_email='$email',user_password='$password'where user_id='$id';";
      $result= mysqli_query($connect,$sql);
      if ($result){
        echo "<script>window.location = 'user_profile.php'</script>";
      }
      else{
        echo "asdasdsa".mysqli_error($connect);
        }

    }

  }



?>
