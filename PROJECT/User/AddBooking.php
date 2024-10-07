<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST['btn_submit'])){
    $qry="update tbl_booking set coach_no='".$_POST['txt_coach']."', pnr_no='".$_POST['txt_pnr']."', station_id='".$_POST['sel_station']."',booking_fordate='".$_POST['txt_date']."' where booking_id=".$_GET['bid'];
    if($con->query($qry))
    {
      $sel = "select count(*) as totalcount from tbl_booking where booking_status>0 and user_id=".$_SESSION["uid"];
      $res = $con->query($sel);
      $data = $res->fetch_assoc();
      // echo $data["totalcount"];
      if((int)$data["totalcount"] > 0)
      {
        $bookingId=$_GET['bid'];
        header("location: Payment.php?bid=$bookingId");
      } 
      else
      {
        $selbook = "select * from tbl_booking where booking_id=".$_GET["bid"];
        $resbook = $con->query($selbook);
        $databook = $resbook->fetch_assoc();
        if((int)$databook["booking_amount"] > 500)
        {
          $dis = (int)$databook["booking_amount"] * 20;
          $total = $dis / 100;
          $update = "update tbl_booking set discount_amount	='".$total."' where booking_id=".$_GET["bid"];
          if($con->query($update))
          {
            $bookingId=$_GET['bid'];
            header("location: Payment.php?bid=$bookingId");
          }
        }  
        else
        {
          $bookingId=$_GET['bid'];
          header("location: Payment.php?bid=$bookingId");
        } 
      }    
    }
    else{
        echo "Gailed";
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
    <form method="post">
        <table border='1' align='center'>
            <tr>
                <td>Date</td>
                <td><input type="date" name="txt_date" id=""></td>
            </tr>
            <tr>
                <td>District</td>
                <td><select name="sel_dist" id="" onchange="getPlace(this.value)">
                <option value="">Select District</option>
        <?php
        $sel = "SELECT * FROM tbl_district";
        $result = $con->query($sel);
        while($row = $result->fetch_assoc()) {
        ?>
        <option value="<?php echo $row['district_id']; ?>"><?php echo $row['district_name']; ?></option>
        <?php
        }
        ?>
                </select></td>
            </tr>
            <tr>
    <td>Place</td>
    <td><label for="txt_place"></label>
      <label for="sel_place"></label>
      <select name="sel_place" id="sel_place" onchange="getStation(this.value)">
      <option value="">---- Select ----</option>
      </select></td>
  </tr>
            <tr>
                <td>Station</td>
                <td>
                <select name="sel_station" id="sel_station">
                <option value="">---- Select ----</option>
                </select>
                </td>
            </tr>
            <tr>
                <td>PNR Number</td>
                <td><input type="text" name="txt_pnr" id=""></td>
            </tr>
            <tr>
                <td>Coach Number</td>
                <td><input type="text" name="txt_coach" id=""></td>
            </tr>
            <tr>
                <td colspan='2'><input type="submit" name="btn_submit" value="Pay Now"></td>
            </tr>
        </table>
    </form>
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
  function getStation(sid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxStation.php?id=" +sid,
      success: function (result) {
        $("#sel_station").html(result);
      }
    });
  }
</script>
</html>