<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/page1.css">
</head>
<?php
    session_start();
    error_reporting(0);
    if (isset($_GET['Submit']))
    {
        if(!empty($_GET['name']))
        {
            $_SESSION['name']= $_GET['name'];
            $name= $_SESSION['name'];
        }
    }
?>
<body>
    <div>
        <form action="page2.php" method="get">
        <input type="text" name="name" placeholder="Enter your name" required><br>
        &emsp;&emsp;&emsp;&emsp;<input type="submit" value="Submit" name="Submit">
        </form> 
    </div>
</body>
 