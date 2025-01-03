<?php
include("../Assets/Connection/connection.php");
include("Head.php");
if(isset($_POST["btn_submit"]))
{
	$id=$_SESSION["rid"];
	$title=$_POST["txt_title"];
	$content=$_POST["txt_complaint"];
	$insQry="insert into tbl_complaint(complaint_title,complaint_content,rest_id) values('".$title."','".$content."','".$_SESSION['rid']."')";
	
		if($con->query($insQry))
		{ 
			?>
            <script>
                alert("Inserted");
                window.location="PostComplaint.php?id=<?php echo $_GET['id'] ?>";
            </script>
            <?php
		}
    else {
      ?>
      <script>
        alert("Not Inserted");
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
  <table  width="391" height="185" align='center'>
    <tr>
      <td>Title</td>
      <td><label for="txt_title"></label>
      <input type="text" name="txt_title" id="txt_title" /></td>
    </tr>
    <tr>
      <td>Complaint</td>
      <td><label for="txt_complaint"></label>
      <input type="text" name="txt_complaint" id="txt_complaint" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Send" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table class='table table-dark table-striped'>
  <tr>
    <td>Sl.No</td>
    <td>Title</td>
    <td>Complaint</td>
    <td>Reply</td>
  </tr>
  <?php
  $selQry="select * from tbl_complaint where rest_id=".$_SESSION['rid']." and user_id=''";
  $result=$con->query($selQry);
  $i=0;
  while($row=$result->fetch_assoc())
  { $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row["complaint_title"];?> </td>
      <td><?php echo $row["complaint_content"];?> </td>
      <td><?php 
      if($row["complaint_reply"]==""){
        echo "Admin hasn't reviewed your complaint";
      }
      else{
        echo $row["complaint_reply"]; 
      }
      ?> </td>
    </tr>
     <?php 
  }
  ?>
</table>
</form>
</body>
</html>
<?php
  include("foot.php");
  ob_flush(); 
?>