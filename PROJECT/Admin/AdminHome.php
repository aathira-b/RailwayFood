<?php
ob_start();
include('../Assets/Connection/Connection.php');
include("Head.php");
?>
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Sale</p>
                                <h6 class="mb-0">
                                    <?php
                                       $checkQry = "SELECT SUM(booking_amount) as sum from tbl_booking WHERE booking_id = 1";  
                                       $checkResult = $con->query($checkQry);
                                       $checkData = $checkResult->fetch_assoc();
                                       echo $checkData['sum'];
                                    ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Users</p>
                                <h6 class="mb-0">
                                    <?php 
                                        $checkQry1 = "SELECT COUNT(*) as count FROM tbl_user";
                                        $checkResult1 = $con->query($checkQry1);
                                        $checkData1 = $checkResult1->fetch_assoc();
                                        echo $checkData1['count']; 
                                    ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Restaurants</p>
                                <h6 class="mb-0">
                                    <?php
                                        $checkQry2 = "SELECT COUNT(*) as rest FROM tbl_rest WHERE rest_status = 1 ";
                                        $checkResult2 = $con->query($checkQry2);
                                        $checkData2 = $checkResult2->fetch_assoc();
                                        echo $checkData2['rest'];
                                    ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Bookings</p>
                                <h6 class="mb-0">
                                    <?php
                                        $checkQry3 = "SELECT COUNT(*) as bookings FROM tbl_booking";
                                        $checkResult3 = $con->query($checkQry3);
                                        $checkData3 = $checkResult3->fetch_assoc();
                                        echo $checkData3['bookings'];
                                    ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->
            <?php
            include("Foot.php");
            ob_flush();
            ?>