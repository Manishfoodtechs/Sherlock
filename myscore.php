<?php
 session_start(); //Setting the required sessions if not set already
 require 'dbconnect.php';
 
if ( !isset($_SESSION['Users'])!="" ) 
{
    exit;
}
 
 //if session is not set already, redirect to home page
 if (!isset($_SESSION['count'])) 
 { 
  header("Location: logout.php");
 }
 else
 {
    $percent = ($_SESSION['score']/$_SESSION['count'])*100 ;
    $query = "INSERT INTO score VALUES('".$_SESSION['Users']."','".$percent."');";
    mysqli_query($scon, $query);
 }  
 header("Location: logout.php");
?>

<?php
  
  unset($_SESSION['score']);
  unset($_SESSION['count']); //if its already set, unset it
  unset($_SESSION['totalNoOfQuestionsAvailableInDatabase']); //if its already set, unset it
 // unset($_SESSION['questionNumbersAskedSoFar']); //if its already set, unset it
  
 ?>