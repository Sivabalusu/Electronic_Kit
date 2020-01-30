<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/page2.css">
    </head>
    <?php session_start();
        error_reporting(0);
        $_SESSION['name']= $_GET['name'];
        $name= $_SESSION['name'];
    ?>
    <div class="nav">
        <h1><strong>Electronic Kit<sub>Expect the Unexpected</sub></strong></h1>
            <form action="index.php"  method="get">
                <?php  echo "Welcome ".$name; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="logout" name="logout"><br>
            </form> 
    </div>
    <div class="pages">
            <ul><li><a href="page2.php">Laptops Section</a>&emsp;&emsp;&emsp;<a href="page3.php">Tabs Section</a>&emsp;&emsp;&emsp;</li><li><a href="page4.php">Mobile Section</a></li></ul>
    </div>
    <?php
    $products = array("Acer", "HP Pavilion", "Windows","Dell Inspiron","Samsung", "Acer", "Windows","Apple","Samsung", "Apple", "Honor","Vivo");
    $prices = array("749", "869", "901","949","350", "449", "349","949","300", "100", "700","549");
    $images = array("images/page1/laptop0.jpg","images/page1/laptop1.jpg","images/page1/laptop2.jpg","images/page1/laptop3.jpg","images/page2/tab0.jpg","images/page2/tab1.jpg","images/page2/tab2.jpg","images/page2/tab4.jpg","images/page3/samsung.jpg","images/page3/apple.jpg","images/page3/honor.jpg","images/page3/vivo.jpg");
    if (!isset($_SESSION["total"])) 
        {
            $_SESSION["total"] = 0;
            for ($i=0; $i< count($products); $i++) 
            {
                $_SESSION["quantity"][$i] = 0;
                $_SESSION["prices"][$i] = 0;
            }
        }

    if (isset($_GET['reset']))
    {
        if ($_GET["reset"] == 'true')
        {
            unset($_SESSION["quantity"]); 
            unset($_SESSION["prices"]); 
            unset($_SESSION["total"]); 
            unset($_SESSION["cart"]); 
        }
    }

    if (isset($_GET["add"]) )
    {
        $i = $_GET["add"];
        $quantity = $_SESSION["quantity"][$i] + 1;
        $_SESSION["prices"][$i] = $prices[$i] * $quantity;
        $_SESSION["cart"][$i] = $i;
        $_SESSION["quantity"][$i] = $quantity;
    }

    if ( isset($_GET["delete"]) )
    {
        $i = $_GET["delete"];
        $quantity = $_SESSION["quantity"][$i];
        $quantity--;
        $_SESSION["quantity"][$i] = $quantity;
        if ($quantity == 0) 
        {
            $_SESSION["prices"][$i] = 0;
            unset($_SESSION["cart"][$i]);
        }
        else
        {
            $_SESSION["prices"][$i] = $prices[$i] * $quantity;
        }
    }
    ?>
<body>
    <div class="main">
    <h2>Mobiles Section</h2>
    <table class="productTable">
        <tr class="headerRow">
            <th>Product</th>
            <th>Price</th>
            <th>Add to Cart</th>
        </tr>
        <?php
        for($i=8;$i<12;$i++) 
        {
        ?>
        <tr>
            <td><?php echo $products[$i];?><br> 
                <?php echo '<img src="'.$images[$i].'" width="120px" height="100px">';
             ?></td>
            <td><?php echo $prices[$i]; ?></td>
            <td><a href="?add=<?php echo($i); ?>">YES</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
    </div>
    <div class="right">
        <?php
        
            if ( isset($_SESSION["cart"]) ) 
            {
                ?>
                <br/><br/><br/>
                <h2>Cart</h2>
                <table class="cartTable">
                    <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th colspan="3">Action</th>
                </tr>
    <?php
            $total = 0;
            foreach ( $_SESSION["cart"] as $i ) 
            {
    ?>
            <tr>
                <td><?php echo( $products[$_SESSION["cart"][$i]] ); ?></td>
                <td><?php echo( $_SESSION["quantity"][$i] ); ?></td>
                <td><?php echo( $_SESSION["prices"][$i] ); ?></td>
                <td colspan="3"><a href="?delete=<?php echo($i); ?>">Delete from cart</a></td>
            </tr>
    <?php
                $total = $total + $_SESSION["prices"][$i];
            }
                $_SESSION["total"] = $total;
    ?>
                    <tr>
                    <td colspan="7">Total : <?php echo($total); ?></td>
                    </tr>
                </table>
                <table class="resetTable">
                    <tr>
                        <td colspan="5"><a href="?reset=true"><button>Reset Cart</button></a></td>
                    </tr>
                </table>
    <?php
            }
    ?>
    </div>
</body>
</html>