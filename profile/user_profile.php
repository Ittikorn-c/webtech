<!DOCTYPE html>
<?php
require './dbConnect.php';
$id = $_GET['u'];
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
  $id = $_GET['u'];
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
        <li id="wallet"><a href="#walletView">Credit Card</a></li>
      </ul>
    </div>
    <div id="content-box">
      <div id="profileView" class="profileView">
        <form action="editUserProfile.php" method="POST"name="frm1" id="frm1" enctype="multipart/form-data">
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
                                        <a class="a-cancel" href="user_profile.php">Cancel</a>
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
                                          </script>

                                        </div>
                                      </fieldset>

                                    </div>
                                  </div>
                                </form>
                              </div>


                              <!--My Wallet-->
                              <div id="WalletView" class="walletView" style="display: none;">
                                <form name="frm2" id="frm2" action="editUserProfile.php" method="post">
                                  <!-- credit card-->
                                  <div class="card-r">
                                    <figure class="card__figure">
                                      <img src="https://conta.nubank.com.br/images/nu-white.png" class="card__figure--logo"></img>
                                    </figure>
                                    <p class="card__number" id="cardNumber"> </p>
                                    <script>

                                      var str = "<?php echo $row['cardnumber']?>";
                                      var res = str.substring(0, 4)+" "+str.substring(4, 8)+" "+str.substring(8, 12)+" "+str.substring(12);
                                      document.getElementById("cardNumber").innerHTML = res;
                                    </script>

                                    <div class="card__dates">
                                      <span class="card__dates--first" id="exp_card"></span>
                                      <script>
                                      var month_exp = <?php echo $row['month']?>;
                                      var year_exp = <?php echo $row['year']?>;
                                      if (month_exp<10){
                                        document.getElementById('exp_card').innerHTML = "0"+month_exp+"/"+year_exp;
                                      }else{
                                        document.getElementById('exp_card').innerHTML = +month_exp+"/"+year_exp;
                                      }
                                    </script>
                                  </div>
                                  <p class="card__name"><?php echo $row['holdername']?><p>
                                    <div class="card__flag">
                                      <div class="card__flag--globe"></div>
                                      <div class="card__flag--red"></div>
                                      <div class="card__flag--yellow"></div>
                                    </div>
                                  </div>
                                  <div class="assign">
                                    <!--credit card Made by GABRIEL FERREIRA-->
                                    <!--<p>Made by <a href="https://github.com/gabrielferreiraa" target="_blank">@gabrielferreiraa</a></p>-->
                                  </div>

                                  <a class="edit-button-r" href="#popup1">Edit Credit/Debit card </a>
                                  <div id="popup1" class="overlay1">
                                    <div class="popup1">
                                      <h2>Edit Credit-Debit card </h2>
                                      <div class="container-r">
                                        <div class="row-fluid">
                                          <form class="form-horizontal">
                                            <fieldset>
                                              <legend>Payment</legend>

                                              <!-- Name on Card -->
                                              <div class="control-group">
                                                <label class="control-label"  for="Cardholder">Card Holder's Name</label>
                                                <div class="controls">
                                                  <input type="text" id="cardHolder" name="cardHolder" placeholder=" " class="input-xlarge">
                                                </div>
                                              </div>

                                              <!-- Card Number -->
                                              <div class="control-group">
                                                <label class="control-label" for="Cardnumber" >Card Number</label>
                                                <div class="controls">
                                                  <input type="tel" id="cardNumber" name="cardNumber" maxlength="16" placeholder="XXXXXXXXXXXXXXXX" class="input-xlarge">

                                                </div>
                                              </div>

                                              <!-- Expiry-->
                                              <div class="control-group">
                                                <label class="control-label" for="CardExpiryDate">Card Expiry Date</label>
                                                <div class="controls">
                                                  <select class="span3" name="month_exp" id="month_exp" value=" ">
                                                    <option> </option>
                                                    <option value="01">Jan (01)</option>
                                                    <option value="02">Feb (02)</option>
                                                    <option value="03">Mar (03)</option>
                                                    <option value="04">Apr (04)</option>
                                                    <option value="05">May (05)</option>
                                                    <option value="06">June (06)</option>
                                                    <option value="07">July (07)</option>
                                                    <option value="08">Aug (08)</option>
                                                    <option value="09">Sep (09)</option>
                                                    <option value="10">Oct (10)</option>1
                                                    <option value="11">Nov (11)</option>
                                                    <option value="12">Dec (12)</option>
                                                  </select>
                                                  <select class="span2" name="year_exp">
                                                    <option> </option>
                                                    <option value="18">2018</option>
                                                    <option value="19">2019</option>
                                                    <option value="20">2020</option>
                                                    <option value="21">2021</option>
                                                    <option value="22">2022</option>
                                                    <option value="23">2023</option>
                                                    <option value="20">2024</option>
                                                    <option value="21">2025</option>
                                                    <option value="22">2026</option>
                                                    <option value="23">2027</option>
                                                  </select>
                                                </div>
                                              </div>

                                              <!-- CVV -->
                                              <div class="control-group">
                                                <label class="control-label"  for="Cardcvv">Card CVV</label>
                                                <div class="controls">
                                                  <input type="password" id="Cardcvv" name="Cardcvv" placeholder="" class="span2" maxlength="3" value="">
                                                </div>
                                              </div>

                                            </fieldset>
                                        <!--    <input type="submit" name="submit-frm2" class="a-save" href="user_profile.php">Save</a>
                                            <a class="a-cancel" href="user_profile.php">Cancel</a>-->
                                            <input type="submit" name="submit-frm2" href="#frm2" class="a-save" >Save</a>
                                            <a class="a-cancel" href="#frm2">Cancel</a>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>

                            <script>
                            $(document).ready(function($){
                              $("li").click(
                                function(event) {
                                  $('li').removeClass('active');
                                  $(this).addClass('active');
                                  event.preventDefault()
                                }
                              );
                              var formProfile =  $("#frm1");
                              var formWallet =  $("#frm2");
                              $("#profile").click(function(){
                                var value = this.value;
                                $('.profileView').show();
                                $('.walletView').hide();
                              });
                              $("#wallet").click(function(){
                                $('.walletView').show();
                                $('.profileView').hide();
                              });
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
                            });
                          </script>
                        </div>

                      </body>
                      </html>
