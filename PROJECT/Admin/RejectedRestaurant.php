<?php
include('../Assets/Connection/Connection.php');
ob_start();
include("Head.php");


if(isset($_GET['aid'])) {
  $upQry="update tbl_rest set rest_status=1  where rest_id=".$_GET["aid"];
	if($con->query($upQry))
	{
	
	
		?>
        <script>
		alert("Restaurant Accepted...")
		window.location="RejectedRestaurant.php";
		</script>
        <?php
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
<table align='center' class='table table-dark table-striped'>
  <tr>
    <td>Sl.No</td>
    <td>Restaurant </td>
    <td>Email </td>
    <td>Address </td>
    <td>District </td>
    <td>Place </td>
    <td>Action</td>
  </tr>
  <?php
  $selQry="select * from tbl_rest r inner join tbl_place p on p.place_id=r.place_id inner join tbl_district d on  d.district_id=p.district_id where r.rest_status = 2";
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
      <td><p>
        <a href="NewRestaurant.php?aid=<?php echo $row["rest_id"]; ?>">Accept</a></p>
    </td>
     <?php 
  }
  ?>
</table>
</body>
</html>
<?php
include("Foot.php");
?>