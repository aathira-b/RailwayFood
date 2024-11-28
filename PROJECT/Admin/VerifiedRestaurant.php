<?php
include('../Assets/Connection/connection.php');
include('Head.php');

if(isset($_GET['aid'])) {
  $upQry = "update tbl_rest set rest_status = '1' where rest_id =".$_GET['aid'];
  if($con->query($upQry)) {
    echo " <script>
              alert('Approved...');
              window.location = 'AcceptedRestaurant.php';
            </script>";   
  }
}
if(isset($_GET['rid'])) {
  $Qry = "update tbl_rest set rest_status = '0' where rest_id =".$_GET['rid'];
  if($con->query($Qry)) {
    echo " <script>
              alert('Rejected...');
              window.location = 'RejectedRestaurant.php';
            </script>";   
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table width="200" border="1">
  <tr>
    <td>sl.no</td>
    <td>restaurant </td>
    <td>Email </td>
    <td>Address </td>
    <td>District </td>
    <td>Place </td>
    <td>action</td>
  </tr>
  <?php
  $selQry="select * from tbl_rest r inner join tbl_place p on p.place_id=r.place_id inner join tbl_district d inner join d.district_id=p.district_id";
  $result=$con->query($selQry);
  $i=0;
  while($row=$result->fetch_assoc())
  { $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row["rest_name"];?> </td>
      <td><?php echo $row["rest_email"];?> </td>
      <td><?php echo $row["rest_address"];?> </td>
      <td><?php echo $row["district_name"];?> </td>
      <td><?php echo $row["place_name"];?> </td>
      <td><p><a href="VerifiedRestaurant.php?aid=<?php echo $row['rest_id']; ?>">Approve</a></p></td>
      <td><p><a href="VerifiedRestaurant.php?rid=<?php echo $row['rest_id']; ?>">Reject</a></p></td>
     <?php 
  }
  ?>
</table>
</body>
</html>