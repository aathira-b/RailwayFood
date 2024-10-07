<?php
session_start();
if(!isset($_SESSION['rid'])){
    header("location: ../Guest/Login.php");
}
?>