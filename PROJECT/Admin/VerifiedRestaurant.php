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
      <td><p><a href="#<?php echo $row["rest_id"]; ?>">Delete</a></p></td>
     <?php 
  }
  ?>
</table>
</body>
</html>