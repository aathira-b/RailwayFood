<?php
include("../Assets/Connection/Connection.php");

if (isset($_POST["btn_submit"])) {
    $name = $_POST["txt_name"];
    $contact = $_POST["txt_contact"];
    $email = $_POST["txt_email"];  
    $pwd = ($_POST["txt_pwd"]);
    $photo = $_FILES["File_photo"]["name"];
    $temp = $_FILES["File_photo"]["tmp_name"];

    // Moving the uploaded file
    if(!empty($photo) && !empty($temp)) {
      $photoPath = "../Assets/Files/User/" . $photo;
      move_uploaded_file($temp, $photoPath);
    } else {
        $photoPath = "../Assets/Files/User/Default_avatar_photo_icon.jpeg"; 
    }

    //Check for duplicate values
    $checkQry = "select * from tbl_user where user_email = '$email' ";
    $checkResult = $con->query($checkQry);

    if($checkResult->num_rows > 0) {
      //If User Already Exists
      echo "<script>
              alert('Unsuccessful, User Already Exists...');
              window.location = 'userRegistration.php';
            </script>";
    } else {
        //If no duplicate values found, proceed with insertion
        $insQry = "INSERT INTO tbl_user(user_name, user_contact, user_email, user_password, user_photo)
                   VALUES ('$name', '$contact', '$email', '$pwd', '$photoPath')";
        if ($con->query($insQry)) {
          echo "<script>
                  alert('Registration Successful');
                  window.location = 'userRegistration.php' 
                </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Registration</title>
</head>
<style>
 input[type="submit"]{
 background-color: #CCC;
 font:"Arial, Helvetica, sans-serif";
 font-size:14px;
 }

.btn{
 padding:10px;
 } 

#UserRegistration table tr td strong {
 font-family: "Georgia", "Times New Roman", "Times", "serif";
 font-size: 14px;
 font-weight: bold;
}
#userInfoTable th, #userInfoTable td {
  text-align: center; 
  border: 1px solid black;
}
#userGetInfo{
  border-spacing: 0 10px;
}

</style>

<body>
<form id="UserRegistration" name="UserRegistration" method="post" action="" enctype="multipart/form-data">
<table width="500" align='center' id='userGetInfo'>
  <th height='33' colspan=2 >USER REGISTRATION</th>
  <tr>
    <td><strong>Name</strong></td>
    <td><label for='txt_name'></label>
      <input type="text" name="txt_name" id="txt_name" pattern="^[A-Z]+[a-zA-Z ]*$" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" placeholder='Enter your Full Name' required />
    </td>
  </tr>
  <tr>
    <td><strong>Contact</strong></td>
    <td><label for='txt_contact'></label>
      <input type="text" name="txt_contact" id="txt_contact" placeholder='Enter your phone number' pattern="[7-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaing 9 digit with 0-9" required />
    </td>
  </tr>
  <tr>
    <td><strong>Email</strong></td>
    <td><label for='txt_email'></label>
      <input type="email" name="txt_email" id="txt_email" placeholder='Enter your Email Address' pattern="[a-z0-9.]+@[a-z]+\.[a-z]{2,}$" required />
    </td>
  </tr>
  <tr>
    <td><strong>Password</strong></td>
    <td><label for='txt_pwd'></label>
      <input type="password" name="txt_pwd" id="txt_pwd" pattern="(?=.\d)(?=.[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder='Password' required />
    </td>
  </tr>
  <tr>
    <td><strong>Photo</strong></td>
    <td><label for='File_photo'></label>
      <input type="file" name="File_photo" id="File_photo" accept="image/*"/>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="CREATE" />
      <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel"  />
    </td>
  </tr>
</table>
</form>
</body>
</html>