<?php
include("../Connection/Connection.php");

    if (isset($_GET["action"])) {

        $sqlQry = "SELECT * FROM tbl_food f inner join tbl_rest r on f.rest_id=r.rest_id inner join tbl_category c on c.category_id=f.category_id where r.rest_id=".$_GET['rid'];
       
        if ($_GET["category"]!=null) {

            $category = $_GET["category"];

            $sqlQry = $sqlQry." AND c.category_id IN(".$category.")";
        }
       
		
		if ($_GET["name"]!=null) {

            $name = $_GET["name"];

            $sqlQry = $sqlQry." AND food_name LIKE '%".$name."%'";
        }

        if ($_GET["type"]!=null) {

            $type = $_GET["type"];

            $sqlQry = $sqlQry." AND food_type IN('".$type."')";
        }
        $resultS = $con->query($sqlQry);
        
       

        if ($resultS->num_rows > 0) {
            while ($rowS = $resultS->fetch_assoc()) {
                $query2 = "SELECT SUM(rating_count) as rating, COUNT(*) as count FROM tbl_rating WHERE food_id =".$rowS['food_id'];
                $result3 = $con->query($query2);
                
                // Check if the query returned a resultS
                    $row3 = $result3->fetch_assoc();
                    $totalRating = $row3['rating'];
                    $ratingCount = $row3['count'];
                
                    // Avoid division by zero
                    if ($ratingCount > 0) {
                        $averageRating = $totalRating / $ratingCount;
                    } else {
                        $averageRating = 0;
                    }
?>

<div class="col-md-3 mb-2">
                            <div class="card-deck">
                                <div class="card border-secondary">
                                    <img src="../Assets/Files/Food/<?php echo $rowS["food_photo"]; ?>" class="card-img-top" height="250">
                                    <div class="card-img-secondary">
                                        <h6  class="text-light bg-info text-center p-1"><?php echo $rowS["food_name"]; ?></h6>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title text-danger" align="center">
                                            Price : <?php echo $rowS["food_price"]; ?>/-
                                        </h4>
                                        <p align="center">
                                            <?php echo $rowS["category_name"]; ?><br>
                                        </p><p align="center">
                                            <?php echo $rowS["food_type"]; ?><br>
                                        </p>
                                        <a href="ViewRating.php?id=<?php echo $rowS['food_id'] ?>"
                                        <div class='star-rating' style="
    color: #DEAD6F;font-size:30px;
">
		<?php
for ($i = 1; $i <= 5; $i++) {
	if ($i <= $averageRating) {
		echo "<span>&#9733;</span>"; // Filled star
	} else {
		echo "<span>&#9734;</span>"; // Empty star
	}
}
		?>
		</div></a>
                                        <a href="javascript:void(0)" onclick="addCart(<?php echo $rowS['food_id']; ?>)" class="btn btn-success btn-block">Add to Cart</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

<?php
            }
        } else {
             echo "<h4 align='center'>Products Not Found!!!!</h4>";
        }
    }

?>