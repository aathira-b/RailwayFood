<?php
include('../Assets/Connection/connection.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
    <form action="" method="post">
        <table border='1' align='center'>
            <tr>
                <td>District</td>
                <td><select name="sel_dist" id="" onchange="getStation(this.value)">
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
                <td>Station</td>
                <td><select name="sel_station" id="sel_station">
                <option value="">Select Station</option>
                </select></td>
            </tr>
            <tr colspan='2'>
                <td align='center'><input type="submit" value="Search" name="btn_search"></td>
            </tr>
        </table>
    </form>
    <br>
    <br>
    <?php
    
    if(isset($_POST['btn_search'])){
        $selQry="SELECT * from tbl_rest";
        $resRest=$con->query($selQry);
        if($resRest->num_rows>0){
            ?>
            <table border='1' cellspacing='10' cellpadding='10' align='center'><tr>
            <?php
            $i=0;
            while($resData=$resRest->fetch_assoc()){
                $i++;
?>
<td>
<p>
    <img src="../Assets/Files/Restaurant/<?php echo $resData['rest_photo']?>" width="200px" alt=""><br>
<?php echo $resData['rest_name'] ?> <br>
<?php echo $resData['rest_contact'] ?><br>
<a href="ViewFood.php?rid=<?php echo $resData['rest_id'] ?>">Select Resterunt</a>
</p>
</td>
<?php
if($i%4==0){
    echo "</tr><tr>";
}
            }

            ?>
            </tr>
        </table>
            <?php
        }
    }
    
    ?>
</body>
<script src="../Assets/JQ/jquery.js"></script>

<script>

function getStation(pid)
{
	$.ajax({
	url: "../Assets/AjaxPages/AjaxStation.php?pid="+pid,
	  success: function(result){
		$("#sel_station").html(result);
	  }
	});
}
</script>
</html>