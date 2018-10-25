<?php
session_start();
$ajax=$_GET['scores'];
require "dbconnect.php";



if (!$scon) {
    die('Could not connect: ' . mysqli_error($scon));
}

$sql="INSERT INTO score VALUES ('".$_SESSION['Users']."','".$ajax."');";
mysqli_query($scon,$sql);
$id=mysqli_insert_id($scon);
header("Location: index1.php");

?>
