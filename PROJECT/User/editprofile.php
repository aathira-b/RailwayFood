<?php
include("../Assets/Connection/connection.php");
session_start();

$selQry="select * from tbl_user where user_id=".$_SESSION['uid'];
$resultone = $con->query($selQry);
$dataone = $resultone->fetch_assoc();

if(isset($_POST["btn_update"]))
{
    $name=$_POST["txt_name"];
	$email=$_POST["txt_email"];
	$contact=$_POST["txt_contact"];
	$upQry="update tbl_user set user_name='".$name."',user_email='".$email."' ,user_contact='".$contact."' where user_id=".$_SESSION["uid"];
	if($con->query($upQry))
	{
	
		//echo "updated";
		$aid=0;
		?>
        <script>
		alert("Profile Updated...")
		window.location="myprofile.php";
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
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" value="
	  <?php echo $dataone["user_name"]?>" id="txt_name" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" value="<?php echo $dataone["user_email"]?>" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input type="text" name="txt_contact" values="<?php echo $dataone["user_contact"]?>" id="txt_contact"></td>
    </tr>
    
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_update" id="btn_update" value="update" />
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>