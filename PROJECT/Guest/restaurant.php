<?php
include('../Assets/Connection/connection.php');
if(isset($_POST['btn_submit'])){
	$restaurant=$_POST['txt_name'];
	$email=$_POST['txt_email'];
	$contact=$_POST['txt_contact'];
	$address=$_POST['txt_address'];
	
		$photo=$_FILES['file_photo']["name"];
			 $temp=$_FILES['file_photo']["tmp_name"];
			 move_uploaded_file($temp,"../Assets/Files/Restaurant/".$photo);
		$proof=$_FILES['file_proof'] ["name"];
			  $temp2=$_FILES['file_proof']["tmp_name"];
			 move_uploaded_file($temp2,"../Assets/Files/Restaurant/".$proof);
	$place=$_POST['sel_place'];
	$password=$_POST['txt_pswd'];
$insQry="insert into tbl_rest(rest_name,rest_contact,rest_email,rest_address,rest_photo,rest_proof,place_id,rest_password)values('".$restaurant."','".$contact."','".$email."','".$address."','".$photo."','".$proof."','".$place."','".$password."')";
	if($con->query($insQry))
	{
		?>
        <script>
		alert("data inserted..")
		//window.location="restaurant.php"
		</script>
      <?php
	}
	
}
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
  
  <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">
<table width="200" border="1">
 <tr>
    <td>name</td>
    <td><p>
      <label for="txt_name"></label>
      <input type="text" name="txt_name" />
    </p>
   
</tr>
  <tr>
    <td>contact</td>
    <td><p>
      <label for="txt_contact"></label>
      <input type="text" name="txt_contact" />
    </p></td>
  
  </tr>
  
  <tr>
    <td>email</td>
    <td>
      <label for="txt_email"></label>
      <input type="text" name="txt_email" /></td>
  </tr>
  <tr>
    <td>address</td>
    <td>
      <label for="txt_address"></label>
      <textarea name="txt_address" id="txt_address" cols="21" rows="5"></textarea></td>
    
  </tr>
  <tr>
    <td>photo</td>
    <td>
    <label for="file_photo"></label>
      <input type="file" name="file_photo" id="file_photo" />
    </tr>
   <tr>
    <td>proof</td>
    <td><label for="file_proof"></label>
      <input type="file" name="file_proof" id="file_proof" /></td>
  </tr>
   <tr>
    <td>district</td>
    <td><label for="txt_dist"></label>
      <label for="sel_district"></label>
      <select name="sel_district" id="sel_district"  onchange="getPlace(this.value)">
        <option value="">Select District</option>
      <?php
	  $sel="select* from tbl_district";
	  $result=$con->query($sel);
	  while($row=$result->fetch_assoc())
	  {
	  ?>
     <option value="<?php echo $row["district_id"];?>"><?php echo $row["district_name"];?></option>
       <?php
	  }
	  ?>
      </select></td>
  </tr>
   <tr>
    <td>place</td>
    <td><label for="txt_place"></label>
      <label for="sel_place"></label>
      <select name="sel_place" id="sel_place">
      <option value="">Select</option>
      </select></td>
  </tr>
   <tr>
    <td>password</td>
    <td><label for="txt_pswd"></label>
      <input type="text" name="txt_pswd" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="btn_submit"
    id="btn_submit" value="REGISTER" /></td>
    
  </tr>
</table>
</body>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getPlace(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
      success: function (result) {
        $("#sel_place").html(result);
      }
    });
  }
</script>
</html>