<?php
 
session_start(); //Setting the required sessions if not set already
 require 'dbconnect.php';
 require 'setsessionfortest2.php';
 
 
 // if session is not set this will redirect to login page
// if ( !isset($_SESSION['Users'])!="" ) 
////{
//	$user1=$_SESSION['Users'];
//	exit;
//}
$_SESSION['start']=date("i");
if($_SESSION['start']==0)
	$_SESSION['end']%=60;
if($_SESSION['end']>=$_SESSION['start']){
	//echo $_SESSION['start'];
	//echo $_SESSION['end'];
if($_SESSION['count']== ($_SESSION['totalNoOfQuestionsAvailableInDatabase'])) {
	if($_POST['selectedOpt']==$_SESSION['questionObject']->rightChoice)
         {
             $_SESSION['score']++;//right answer
         }
  header("Location: myscore.php");
  exit;
 }
class FetchQuestion
   {
        function FetchQuestion($receivedQuesNumber, mysqli $scon)
        {
            $result = mysqli_query($scon,"SELECT * FROM questions WHERE qno=".$receivedQuesNumber);
            $quesRow = mysqli_fetch_array($result);
            $this->question = $quesRow['question'];
            $this->op1 = $quesRow['ans1'];
            $this->op2 = $quesRow['ans2'];
            $this->op3 = $quesRow['ans3'];
            $this->op4 = $quesRow['ans4'];
            $this->rightChoice = $quesRow['rightans'];
        }
   }
 
  // $qnoCopy=0;  //Do get the question number out of scope
 //if alrdy set, increment the qestion number count

       $_SESSION['questionObject'] = new FetchQuestion($_SESSION['count'],$scon);
     if($_SESSION['count'] <($_SESSION['totalNoOfQuestionsAvailableInDatabase']+1) && isset($_POST['submit']))
     {//echo $_SESSION['score'].'-'.$_POST['selectedOpt'].'-'.$_SESSION['questionObject']->rightChoice;
         if($_POST['selectedOpt']==$_SESSION['questionObject']->rightChoice)
         {
             $_SESSION['score']++;//right answer
         }
		 $_SESSION['count']++;
	
		  $_SESSION['questionObject'] = new FetchQuestion($_SESSION['count'],$scon);
	 }
}
else
{
	header("Location: myscore.php");
	exit;
}

?>

<html>
    <head>
		<link rel="stylesheet" type="text/css" href="css/style2.css" />


<link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>

		<style>
img {
    opacity: 0.5;
    filter: alpha(opacity=50); /* For IE8 and earlier */
}
</style>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <title>Sjce</title>
        <style>
        body{
            background: url("images/newbg.jpg");  /*Library background*/
            background-size:auto;
            overflow-x: hidden;
        }
        .jumbotron{
            background: rgb(0, 0, 0); /* This is for ie8 and below */
            background: rgba(0, 0, 0, 0.5); 
        }
       </style>
    </head>
	
    <body style="color: white" class="container">
<p id="demo"></p>
<script>
var deadline = new Date().getTime();
var x = setInterval(function() {
var now = new Date().getTime();
var t = deadline - now;
//var days = Math.floor(t / (1000 * 60 * 60 * 24));
//var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((t % (1000 * 60)) / 1000);
document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";
    if (t < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);
</script>
		<h1>Choose the best option </h1>
        <h3>
            <?php echo $_SESSION['count'].'.  ';?> 
            <?php echo $_SESSION['questionObject']->question ;?>
        </h3>
        <h3 class="jumbotron">
            <form action="taketest.php" method="POST">
                <input type="radio" name="selectedOpt" value="<?php echo $_SESSION['questionObject']->op1 ?>" required> <label><?php echo $_SESSION['questionObject']->op1 ?></label><br><br>
                <input type="radio" name="selectedOpt" value="<?php echo $_SESSION['questionObject']->op2 ?>" > <label><?php echo $_SESSION['questionObject']->op2 ?></label><br><br>
                <input type="radio" name="selectedOpt" value="<?php echo $_SESSION['questionObject']->op3 ?>"> <label><?php echo $_SESSION['questionObject']->op3 ?></label><br><br>
                <input type="radio" name="selectedOpt" value="<?php echo $_SESSION['questionObject']->op4 ?>">  <label><?php echo $_SESSION['questionObject']->op4 ?></label><br><br>
                <input type="submit" name="submit" value="Next">
           </form>
        </h3>
    </body>
</html>