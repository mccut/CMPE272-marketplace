<?php
    $TITLE="market";
    $style="market";
    require_once "header.php";
    //require_once "mysql.php";
    session_start();
    include_once("mysql.php");
    
    print "<br>";
    print "<br>";
    //print "<br>";
    print "<div class=\"album text-muted\">";
    print "<div class=\"container\">";
    print "<div class=\"row\">";

    $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $query = "SELECT id, name, description, price, image FROM  `Movies`";
    if($debug) echo $query;
    // query Products database
    $data = $conn->query($query);
    $data->setFetchMode(PDO::FETCH_ASSOC);
    if ($data->rowCount() == 0) echo "error";
    foreach ($data as $row) {
        print "<div class=\"card\">";
        
        // print poster
        echo "<a href=\"/vision/getproduct.php?id=".$row['id']."\"><img src=\"img/".$row['image']."\" alt=\"".$row['name']." poster\" height=\"320px\" width=\"220px\"></a>";
        
        // print title
        print "<div class=\"row-height\" id=\"titlerow\">";
        echo "<h5 align=\"left\">".$row['name']."</h5>";
        print "</div>";
        
        // print plot
        print "<div class=\"row-height\" id=\"plotrow\">";
        echo "<p class=\"card-text\">".$row['description']."</p>";
        print "</div>";
        
        // print price
        echo "<h6>Price: $".$row['price']."</h6>";
        
print<<<HERE
<form method="post" action="cart_update.php">
<fieldset>
<label>
    <span>Quantity</span>
    <input type="text" size="2" maxlength="2" name="product_qty" value="1" />
</label>
</fieldset>
HERE;

        echo "<input type=\"hidden\" name=\"product_code\" value=\"".$row['id']."\" />";
        echo "<input type=\"hidden\" name=\"company\" value=\"Vision\" />";
        echo "<input type=\"hidden\" name=\"type\" value=\"add\" />";
        echo "<input type=\"hidden\" name=\"return_url\" value=\"$current_url\" />";
        echo "<div><button type=\"submit\" class=\"add_to_cart btn btn-success\">Add to Cart</button></div>";
        echo "</form>";
        echo "</div>";
    }
    
    $urlArray = array("ECWEB"=>"https://phpwebsite-chenshuzhongs.c9users.io/product/listen.php",
    "smile"=>"http://www.open7smile.us/sendproduct.php",
    "HealthCart"=>"https://www.srivatsamulpuri.me/wp-content/uploads/2017/03/listen.php",
    "aan"=>"http://thenaser.com/productjson.php",
    "WEIYU"=>"http://52.52.18.143/jasonproduct.php"
    );
    foreach($urlArray as $Name =>$Name_value) {
    	//print "<h3>$Name</h3>";
    	printProducts($Name_value, $Name);
    	echo "<br>";
    }
    echo "</div></div></div>";
    
    if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"]) > 0) {
        echo '<div class="shopping-cart">';
        echo '<div class="cart-view-table-front" id="view-cart">';
        echo '<h3>Your Shopping Cart</h3>';
        echo '<form method="post" action="cart_update.php">';
        echo '<table width="100%" cellpadding="6" cellspacing="0">';
        echo '<tbody>';
    
        $total = 0;
        $b = 0;
        foreach ($_SESSION["cart_products"] as $cart_itm) {
            $product_name = $cart_itm["product_name"];
            $product_qty = $cart_itm["product_qty"];
            $product_price = $cart_itm["product_price"];
            $product_code = $cart_itm["product_code"];
            $bg_color = ($b++%2==1) ? 'odd' : 'even'; //zebra stripe
            echo '<tr class="'.$bg_color.'">';
            echo '<td>Qty <input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
            echo '<td>'.$product_name.'</td>';
            echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /> Remove</td>';
            echo '</tr>';
            $subtotal = ($product_price * $product_qty);
            $total = ($total + $subtotal);
        }
        echo '<tr><td colspan="4">';
        echo '<button class="btn btn-md btn-success" type="submit">Update</button><a href="view_cart.php" class="btn btn-md btn-primary">Checkout</a>';
        echo '</td></tr>';
        echo '</tbody>';
        echo '</table>';
        
        $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
        echo '</form>';
        echo '</div>';
    }
    echo "</div>";
    
    require_once "footer.php";
    
    function printProducts($url, $company) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_HEADER, 0);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch);
        curl_close($ch);
        $arr = json_decode($output,1);
        printCard($arr, $company);
    }
    
    function printCard($data, $company) {
        foreach ($data as $row) {
            print "<div class=\"card\">";
            
            // print poster
            echo "<a href=\"/vision/getproduct.php?id=".$row['id']."\"><img src=\"img/".$row['image']."\" alt=\"".$row['name']." poster\" height=\"320px\" width=\"220px\"></a>";
            
            // print title
            print "<div class=\"row-height\" id=\"titlerow\">";
            echo "<h5 align=\"left\">".$row['name']."</h5>";
            print "</div>";
            
            // print plot
            print "<div class=\"row-height\" id=\"plotrow\">";
            echo "<p class=\"card-text\">".$row['description']."</p>";
            print "</div>";
            
            // print price
            echo "<h6>Price: $".$row['price']."</h6>";
            
print<<<HERE
<form method="post" action="cart_update.php">
<fieldset>
<label>
    <span>Quantity</span>
    <input type="text" size="2" maxlength="2" name="product_qty" value="1" />
</label>
</fieldset>
HERE;
    
            echo "<input type=\"hidden\" name=\"product_code\" value=\"".$row['id']."\" />";
            echo "<input type=\"hidden\" name=\"company\" value=\"$company\" />";
            echo "<input type=\"hidden\" name=\"type\" value=\"add\" />";
            echo "<input type=\"hidden\" name=\"return_url\" value=\"$current_url\" />";
            echo "<div><button type=\"submit\" class=\"add_to_cart btn btn-success\">Add to Cart</button></div>";
            echo "</form>";
            echo "</div>";
        }
    }
?>