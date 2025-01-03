<?php
include('../assets/connection/connection.php');
ob_start();
include("Head.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form>
    <h1>User Complaints</h1>
<table class='table table-dark table-striped'>
  
  <tr>
  <td>SL.NO</td>
   
    <td>CONTENT</td>
    <td>USER</td>
    <td>ACTION</td>
  </tr>
  <?PHP
  $i=0;
  $selQry1="select * from tbl_complaint c inner join tbl_user u on c.user_id=u.user_id where rest_id=".$_SESSION['rid'];
  $result1=$con->query($selQry1);
  while($row1=$result1->fetch_assoc())
  {
    
   $i++;
    ?>
  <tr>
    <td><?php echo $i;?></td>
    <td><?php echo $row1["complaint_content"];?></td>
    <td><?php echo $row1["user_name"];?></td>
    
     <td>
      <?php
    if($row1['complaint_reply']==""){
      ?>
      <a href="reply.php?sid=<?php echo $row1["complaint_id"]?>">Reply</a>
      <?php
    }
    else{
      echo $row1['complaint_reply'];
    }
      ?>
     </td>  
  </tr>
  <?php
  }
  ?>
  </table>
</form>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
            ?>