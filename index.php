<?php
session_start();
require "dbconnect.php";
if(isset($_POST['login']))
{
if ( isset($_SESSION['Users'])!="" ) 
    {
     header("Location: taketest.php");
     exit;
    }



        $errMSG='';
     $name = $_POST['username'];
     $password = $_POST['password'];
	if($name=="admin"&& $password=" ")
    {
        header("Location:adminlogin.php");
    }
    
    $res=mysqli_query($scon,"SELECT * FROM details WHERE Agent_No='$name'");
    $row=mysqli_fetch_array($res);
    $count = mysqli_num_rows($res);                
      if( $count == 1 && $row['Secret_Code']==$password ) 
            {
             $_SESSION['Users'] = $row['Agent_No'];
		  		if($row['id']==1){
				$_SESSION['end'] = (date("i")+1);
             header("Location: taketest.php");
				}
		  		else if($row['id']==2){
			 header("Location:taketest2.php");
					
				} 
            else 
            {
             $errMSG = "Invalid data <br>";

            
            }                
}
}

?>

<html lang="en">
<head>
	<title>Sherlock</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
</head>
<body>
	<form action="index.php" method="post">
	<div class="agile-login">
		<h1>221B</h1>
		<div class="wrapper">
			<h2>Sherlock</h2>
			<div class="w3ls-form">
			
					<label>Agent_Number</label>
					<input type="text" name="username" placeholder="Agentno" required/>
					<label>Secret_code</label>
					<input type="password" name="password" placeholder="Secretcode" required />
				<button type="submit" name="login" >Login</button>
				
			</div>
		</div>
		<br>
		</div>
	</form>
		<?php if(isset($errMSG)) echo $errMSG; ?>
				
		<a href="logout.php">Logout</a>
		
		<div class="copyright">
		<p>© 2018 Bakers Street. All rights reserved | Design by CSE</p> 
	</div>
</body>
</html>