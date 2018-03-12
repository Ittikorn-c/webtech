<!DOCTYPE html>
<?php
require './dbConnect.php';
$id = 3
;/*$_GET['u'];*/
$sql = "select * from userprofile INNER JOIN user ON userprofile.user_id = user.user_id where user.user_id = $id";
$result = mysqli_query($connect,$sql);
$row = mysqli_fetch_assoc($result);
session_start();
$ses_sesid = "";
$ses_userid = "";
$ses_username = "";
$ses_userstatus = "";
if(isset($_SESSION['ses_userid']) && isset($_SESSION['ses_username']) && isset($_SESSION['ses_status']) ){
  $ses_userid = $_SESSION['ses_userid'];
  $ses_username = $_SESSION['ses_username'];
  $ses_userstatus = $_SESSION['ses_status'];
}
if($ses_userid <> session_id() or $ses_username!=$_GET['u'] or $ses_userstatus != "admin"){

}
else{
  require './dbConnect.php';
  $id = 1;/*$_GET['u'];*/
  $sql = "select * from userprofile INNER JOIN user ON userprofile.user_id = user.user_id where user.user_id = $id";
  $result = mysqli_query($connect,$sql);
  $row = mysqli_fetch_assoc($result);
}
?>
<html>
<head>
  <meta charset='utf-8'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="user_profile.css">
  <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>


</head>
<body>
<nav class='navbar navbar-expand-sm bg-dark navbar-dark'>
<a class='navbar-brand' href='../home/index_user.html'>Get Event</a>

<!-- Links -->
<ul class='navbar-nav mr-auto'>
<li class='nav-item'>
    
</li>
</ul>
<div id="buttonUser">

</div>
</nav>

  <div id="menuNform">
    <div id='menu'>
      <ul>
        <li id="profile" class='active'><a href="#profileView">Profile</a></li>
      </ul>
    </div>
    <div id="content-box">
      <div id="profileView" class="profileView">
        <form action="editOrganizerProfile.php" method="POST"name="frm1" id="frm1" enctype="multipart/form-data">
          <div class="current-profile">
            <div class="pic">
              <img id="show-profile-pic" width="200" height="200" style="display: center; border-radius: 10%;"
              src="<?php echo $row['user_image']?>" class="img-responsive img-thumbnail" ><br>
              <p style="text-align:center;">Profile Picture</p>
            </div>
            <div class="information">

              <div class="left-information">
                <label id="firstname-info">Firstname</label><br>
                <label id="laststname-info">lastname</label><br>
                <!--    <label id="address1">Address</label><br>
                <label id="mail1">e-mail</label><br>-->
                <label id="birthday-info">Birthday</label><br>
                <label id="gender-info">Gender</label><br>
                <label id="mail1">e-mail</label><br>
                <label id="tel-info">Tel.</label><br>
                <label id="address1">Address</label><br>


              </div>
              <div class="field-information">
                <label id="field-firstname-info"><?php echo $row['user_firstname']?></label><br>
                <label id="field-lastname-info"><?php echo $row['user_lastname']?></label><br>
                <label id="field-birthday-info"></label><br>
                <script>
                  var str = '<?php echo $row['birthday']?>';
                  var d = str.substring(8);
                  var m = str.substring(5, 7);
                  var y = str.substring(0, 4);
                  switch (m) {
                    case "01":
                      m ="January";
                      break;
                    case "02":
                      m ="Febuary";
                      break;
                    case "03":
                      m ="March";
                      break;
                    case "04":
                      m ="April";
                      break;
                    case "05":
                      m ="May";
                      break;
                    case "06":
                      m ="June";
                      break;
                    case "07":
                      m ="July";
                      break;
                    case "08":
                      m ="August";
                      break;
                    case "09":
                      m ="Septembder";
                      break;
                    case "10":
                      m ="October";
                      break;
                    case "11":
                      m ="November";
                      break;
                    case "12":
                      m ="Decenber";
                                break;
                    default:

                  }
                  document.getElementById('field-birthday-info').innerHTML = d+" "+m+" "+y;
                </script>
                <label id="field-gender-info"></label><br>
                <script>
                if (<?php echo $row['gender']?> ==0) {
                  document.getElementById('field-gender-info').innerHTML = 'Female';
                }
                else{
                  document.getElementById('field-gender-info').innerHTML = 'Male';
                }
              </script>
              <label id="field-mail-info"><?php echo $row['user_email']?></label><br>
              <label id="field-tel-info"><?php echo "0".$row['phonenumber']?></label><br>
              <label id="field-address-info"><?php echo $row['address']?></label><br>


            </div>
          </div>
        </div>
        <a class="edit-button-r" href="#popup">Edit Profile</a>
        <div id="popup" class="overlay">
          <div class="popup">
            <fieldset>
              <legend><h2>Edit Profile</h2></legend>
              <div class="container-r">
                <div class="col-md-4">
                  <!--input NAME-->
                  <div class="form-group">
                    <label class="col-md-12 control-label" for="First Name">First Name</label>
                    <div class="col-md-12">
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input id="firstName" width="20px" name="firstName" type="text" placeholder="" class="form-control input-md" value="<?php echo $row['user_firstname']?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12 control-label" for="Last Name">Last Name</label>
                    <div class="col-md-12">
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input id="lastName" width="20px" name="lastName" type="text" placeholder="" class="form-control input-md" value="<?php echo $row['user_lastname']?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-12 control-label col-xs-12" for="Address">Address</label>
                    <div class="col-md-12  col-md-12">
                      <textarea name="Address" id="Address" type="text" placeholder="" class="form-control input-md" style="resize=none;"><?php echo $row['address']?></textarea>
                    </div>
                  </div>
                  <!--input PHONE-->
                  <div class="form-group">
                    <label class="col-md-12 control-label" for="Phonenumber">Phone number </label>
                    <div class="col-md-12">
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-phone"></i>
                        </div>
                        <input id="phonenumber" minlength="10" maxlength="10" name="phonenumber" type="text" placeholder="" class="form-control input-md" value=<?php echo "0".$row['phonenumber']?>>
                      </div>
                      <div class="input-group othertop">
                        <div class="input-group-addon">
                          <i class="fa fa-mobile fa-1x" style="font-size: 20px;"></i>

                        </div>
                      </div>

                    </div>
                  </div>
                <!--  <div class="form-group">
                    <label class="col-md-12 control-label" for=""></label>
                    <label class="col-md-12 control-label" for="Career">Career</label>
                    <div class="col-md-12">
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-envelope-o"></i></div>
                          <input id="Career" name="Career" type="text" placeholder="" class="form-control input-md" value="
                          ">
                        </div></div></div>-->

                      </div>
                      <div class="right-container-r">
                        <!--input image-->
                        <img id="profile-pic" src="http://websamplenow.com/30/userprofile/images/avatar.jpg" class="img-responsive img-thumbnail" >
                        <input type="file" name="fileToUpload" id="fileToUpload"  onchange="readURL(this);">

                        <!-- input EMAIL-->
                        <div class="form-group">
                          <label class="col-md-12 control-label" for="Email Address">Email Address</label>
                          <div class="col-md-12">
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-envelope-o"></i>
                              </div>
                              <input id="emailAddress" name="emailAddress" type="email" value="<?php echo $row['user_email']?>" placeholder="" class="form-control input-md">
                            </div></div></div>

                            <!--input Password-->
                            <div class="form-group">
                              <label class="col-md-12 control-label" for="New Password">New Password</label>
                              <div class="col-md-12">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-envelope-o"></i></div>
                                    <input id="NewPassword" minlength="6"name="NewPassword"  value="<?php echo $row['user_password']?>" type="password" placeholder="New Password" class="form-control input-md">
                                  </div></div></div>

                                  <div class="form-group">
                                    <label class="col-md-12 control-label" for="Re-type New Passwords">Re-type New Password</label>
                                    <div class="col-md-12">
                                      <div class="input-group">
                                        <div class="input-group-addon">
                                          <i class="fa fa-envelope-o"></i></div>
                                          <input id="Re-typeNewPassword"minlength="6" name="Re-typeNewPassword" type="password" value="<?php echo $row['user_password']?>" placeholder="Re-type New Password" class="form-control input-md">
                                          <label class="col-md-12 control-label" for=""><p id='message'></p></label>

                                        </div></div></div>
                                        <script>$('#NewPassword, #Re-typeNewPassword').on('keyup', function () {
                                          if ($('#NewPassword').val() == $('#Re-typeNewPassword').val()) {
                                            $('#message').html('Matching').css('color', 'green');
                                          } else{
                                            $('#message').html('Not Matching').css('color', 'red');
                                          }


                                        });</script>
                                        <input type="submit" name="submit" class="a-save" >Save</a>

                                      <!--  <input type="submit" name="submit" class="a-save" href="user_profile.php">Save</a>-->
                                    <!--    <a class="a-cancel" href="user_profile.php">Cancel</a>-->
                                        <a class="a-cancel" href="#frm1">Cancel</a>
                                      </div>
                                      <script>
                                      function readURL(input) {
                                        if (input.files && input.files[0]) {
                                          var reader = new FileReader();
                                          reader.onload = function (e) {
                                            $('#profile-pic')
                                            .attr('src', e.target.result)
                                            .width(200)
                                            .height(200);};
                                            reader.readAsDataURL(input.files[0]);}}

                                            //header
                              function showHead(str) {
                                  $.ajax({
                                      type: "GET",
                                      url: "getHead.php",
                                      success: function(response){
                                          if (str=="") {
                                              return;
                                            }
                                          else{
                                              $('#buttonUser').html(response);
                                          }
                                      }
                                  });
                              }
                              showHead();
                                          </script>

                                        </div>
                                      </fieldset>

                                    </div>
                                  </div>
                                </form>
                              </div>

                            </div>


                        </div>

                      </body>
                      </html>
