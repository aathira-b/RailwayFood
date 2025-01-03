<?php
ob_start();
include('../Assets/Connection/Connection.php');
include("Head.php");
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="container">
<table class="table table-hover table-dark">
  <tr>
    <td>Sl.No</td>
    <td>Booking Amount</td>
    <td>To Date</td>
    <td>Discount Amount</td>
    <td>Station</td>
    <td>Platform</td>
    <td>Coach No</td>
    <td>Status</td>
    <td>Action</td>
    
  </tr>
  <?php
  $selQry="select * from tbl_booking b inner join tbl_user u on u.user_id=b.user_id inner join tbl_cart c on c.booking_id=b.booking_id inner join tbl_food p on p.food_id=c.food_id inner join tbl_station s on b.station_id=s.station_id  where p.rest_id='".$_SESSION['rid']."' group by c.booking_id ";
  $result=$con->query($selQry);
  $i=0;
  while($row=$result->fetch_assoc())
  { $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row["booking_amount"];?> </td>
      <td><?php echo $row["booking_fordate"];?> </td>
      <td><?php echo $row["discount_amount"];?> </td>
      <td><?php echo $row["station_name"];?> </td>
      <td><?php echo $row["pnr_no"];?> </td>
      <td><?php echo $row["coach_no"];?> </td>
      
        <?php
        $Cart="SELECT count(*) as count from tbl_cart where booking_id=".$row['booking_id'];
        $resCart=$con->query($Cart);
        $dataCart=$resCart->fetch_assoc();
        $cartCount=$dataCart['count'];
        $CompleteCart="SELECT count(*) as count from tbl_cart where cart_status='4' and booking_id=".$row['booking_id'];
        $resComp=$con->query($CompleteCart);
        $dataComp=$resComp->fetch_assoc();
        $compCount=$dataComp['count'];
        ?>
     
      <td>
        <?php 
          if($cartCount==$compCount){
            echo "Completed";
          }
        ?>
      </td>
      <td><a href="viewbookproduct.php?bid=<?php echo $row["booking_id"]?>">VIEW PRODUCT</a></td>
    </tr>
     <?php 
  }
  ?>
 
</table>
</div>
</body>
</html>
<?php
  include("Foot.php");
  ob_flush();
   ?>