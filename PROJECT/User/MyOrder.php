<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include('Head.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table cellpadding='10' align='center' cellspacing='5'>
        <tr>
            <td>Sl.No</td>
            <td>Image</td>
            <td>Food</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Total</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
        <?php
        $qry="select * from tbl_booking b inner join tbl_cart c on c.booking_id=b.booking_id inner join tbl_food p on p.food_id=c.food_id inner join tbl_rest r on r.rest_id=p.rest_id where user_id=".$_SESSION['uid'];
        $res=$con->query($qry);
        $i=0;
        while($data=$res->fetch_assoc()){
            $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $data['food_photo'] ?></td>
            <td><?php echo $data['food_name'] ?></td>
            <td><?php echo $data['food_price'] ?></td>
            <td><?php echo $data['cart_qty'] ?></td>
            <td><?php echo $data['cart_qty']*$data['food_price'] ?></td>
            <td><?php 
             if($data['cart_status']==1){
          
                echo "New Order";
              }
              else if($data['cart_status']==2){
                echo "Order Prepared";
              }
              else if($data['cart_status']==3){
                echo "Out for Delivery";
              }
              else if($data['cart_status']==4){
                echo "Completed";
              }
            ?></td>
            <td>
               <?php
               if($data['cart_status']==4){
          ?>
            <a href="Rating.php?id=<?php echo $data['food_id'] ?>">Rating</a> || <a href="PostComplaint.php?id=<?php echo $data['rest_id'] ?>">Post Complaint</a>
          <?php
              }
              ?> 
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
<?php
include('Foot.php');
ob_flush();
?>
</html>