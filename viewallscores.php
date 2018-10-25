<?php
 session_start();
 require 'dbconnect.php';
 
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <title> View All Scores</title>
        <style>
            body{
                background: url("images/newbg4.jpg");  /*Library background*/
                background-size:auto;
                overflow-x: hidden;
            }
            .btn-space {
               margin-left: 75%;
            }
        </style>
    </head>
    <body class="container"><br>
        <div class="text-left">
            
        </div>
		<div class="text-right">
                <a href="clear_data.php"><button class="btn pull-right btn-danger">Clear Data</button></a>  
            </div>

    <?php
        $query = "SELECT *"
                ." FROM score ORDER BY scores DESC";
        $res = mysqli_query($scon,$query);
        if(mysqli_num_rows($res)==0)  
        {
            echo "Nobody has taken the test so far :( ";
        }
        else
        {
            $html ="<h1><center>Scores obtained so far</center></h1>";
            $html.="<table border='1' class='table table-bordered table-active'>";
            $html.="<tr>"
                . "<th>User</th>"
                . "<th>Score</th>"
                . "</tr>";
          /* For Loop for all entries */
            while($row = mysqli_fetch_assoc($res))
            {
              $html.="<tr>";
              $html.="<td>".$row["Agent_No"]."</td>";
              $html.="<td>".$row["scores"]."%</td>";
              $html.="</tr>";
            }
         $html.="</table>";
         echo $html;
        }    
    ?>
		<button type="button" name="Export" class="btn btn-block btn-success" onclick="window.location.href = 'export.php'">Download</button>
    </body>
</html>