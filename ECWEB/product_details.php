<?php
extract( $_POST );
    if ($HIDDEN_ID == NULL) {
    session_start();
    $HIDDEN_ID = $_SESSION["prev_id"];
    //session_start();
    }
    // Setup the previously visited item array
    // Use json_encode / json_decode to get / set arrays in cookies.
    $cookie = $_COOKIE['prev_visited_set'];
    $cookie = stripslashes($cookie);
    $temp_set = json_decode($cookie, true);
    
    if($temp_set == null) {
    $temp_set = array($HIDDEN_ID);
    
    $json = json_encode($temp_set);
    setcookie('prev_visited_set', $json, time() + (86400 * 30));
    } else {
    $arrlength = count($temp_set);
    for($x = 0; $x < $arrlength; $x++) {
      if ( $temp_set[$x] == $HIDDEN_ID ) {
        unset($temp_set[$x]);
      }
    }
    $temp_set = array_values($temp_set);
    array_push($temp_set, $HIDDEN_ID);
    
    $json = json_encode($temp_set);
    setcookie('prev_visited_set', $json, time() + (86400 * 30));
    }
    
    // Setup the most visited item array
    $cookie = $_COOKIE['most_visited_set'];
    $cookie = stripslashes($cookie);
    $temp_set = json_decode($cookie, true);
    
    if($temp_set == null) {
    $temp_set = [];
    $temp_set[(string)$HIDDEN_ID] = 1;
    $json = json_encode($temp_set);
    setcookie('most_visited_set', $json, time() + (86400 * 30));
    } else {
    if (array_key_exists((string)$HIDDEN_ID, $temp_set)) {
      $temp_set[(string)$HIDDEN_ID] = $temp_set[(string)$HIDDEN_ID] + 1;
    } else {
      $temp_set[(string)$HIDDEN_ID] = 1;
    }
    arsort($temp_set);
    $json = json_encode($temp_set);
    setcookie('most_visited_set', $json, time() + (86400 * 30));
    }

session_start();
//include_once("config.php");

//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

//require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/database.php");
//require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/config.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>ECWeb</title>


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
        
        <!-- Custom CSS -->
        <link href="/product/style/style.css" rel="stylesheet" type="text/css">

        <link type="text/css" rel="stylesheet" href="style/rating_style.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    </head>
        
    <body>
        <nav class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse" id="nav-products">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="/home.php">ECWeb</a>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="/home.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/about.php">About</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/product/index.php">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/news.php">News</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/contacts.php">Contacts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/secure/index.php">Secure</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/user/index.php">User</a>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="/login/login.php" method="post">
              <?php 
                session_start(); 
                if (isset($_SESSION["user"])) {
                    print( "<input type=\"hidden\" name=\"type\" value=\"logout\" />" );
                    print( "<button class=\"btn btn-outline-success my-2 my-sm-0\" type=\"submit\">Logout</button>");
                } else {
                    print( "<input type=\"hidden\" name=\"type\" value=\"login\" />" );
                    print( "<button class=\"btn btn-outline-success my-2 my-sm-0\" type=\"submit\">Login</button>");
                }
              ?>
            </form>
          </div>
        </nav>

<!-- Left bar Start -->
<?php
	echo '<div class="cart-view-table-left" id="view-cart">';
	echo '<h4>Sort</h4>';

	echo '<table width="100%"  cellpadding="6" cellspacing="0">';
	echo '<tbody>';

	echo '<tr>';
	echo '<td><a href="product_fivem.php"> Five most visited item </a></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td><a href="product_fivep.php"> Five previous visited item </a></td>';
	echo '</tr>';
	
	echo '</tbody>';
	echo '</table>';
	
	echo '<h4>Sort</h4>';

	echo '<table width="100%"  cellpadding="6" cellspacing="0">';
	echo '<tbody>';

	echo '<tr>';
	echo '<td><a href="product_fivem.php"> Five most visited item </a></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td><a href="product_fivep.php"> Five previous visited item </a></td>';
	echo '</tr>';
	
	echo '</tbody>';
	echo '</table>';

	echo '</div>';
?>
<!-- Left bar End -->

<!-- View Cart Box Start -->
<?php
if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
{
	echo '<div class="cart-view-table-front" id="view-cart">';
	echo '<h4>Shopping Cart</h4>';
	echo '<form method="post" action="cart_update.php">';
	echo '<table width="100%"  cellpadding="6" cellspacing="0">';
	echo '<tbody>';

	$total =0;
	$b = 0;
	foreach ($_SESSION["cart_products"] as $cart_itm)
	{
		$name = $cart_itm["name"];
		$product_qty = $cart_itm["product_qty"];
		$price = $cart_itm["price"];
		$product_code = $cart_itm["product_code"];
		$bg_color = ($b++%2==1) ? 'odd' : 'even'; //zebra stripe
		echo '<tr class="'.$bg_color.'">';
		echo '<td>Qty <input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
		echo '<td>'.$name.'</td>';
		echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /> Remove</td>';
		echo '</tr>';
		$subtotal = ($price * $product_qty);
		$total = ($total + $subtotal);
	}
	echo '<td colspan="4">';
	echo '<button type="submit">Update</button><a href="view_cart.php" class="button">Checkout</a>';
	echo '</td>';
	echo '</tbody>';
	echo '</table>';
	
	$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
	echo '</form>';
	echo '</div>';

}
?>
<!-- View Cart Box End -->

        <section id="product_content" style="margin:100px 0px">
          <div class="container"  style="width: 60%">
            <div class="row">
                  <?php
                      // build SELECT query
                      /*$query = "SELECT * FROM product WHERE id = ". $HIDDEN_ID ;  
                      $result = mysqliConnect($query);
                      
                      if(mysqli_num_rows($result) > 0)  
                      {
                          $row = mysqli_fetch_array($result);
                          $rating = number_format($row["rating"] / $row["rating_times"], 1, '.', '');
                          $rating_compare = number_format($row["rating"] / $row["rating_times"]);
                          $half_star = 0;
                          if ($rating < $rating_compare) {
                              $half_star = 1;
                          }
                  ?>
                        <div class="col" style="max-width: 50%">
                          <img class="card-img-top img-fluid" src="<?php echo $config["paths"]["img"]."product/".$row["image"]; ?>">
                        </div>
                        <div class="col" style="max-width: 50%;">
                          <h2><?php echo $row["name"]; ?></h2>
                          <br>
                          <p style="color:rgb(100,100,100); max-width: 60%;"><?php echo $row["description"]; ?></p>
                          
                          <div class="rate-ex3-cnt">
                              <div id="1" class="rate-btn-fixed1 rate-btn-fixed"></div>
                              <div id="2" class="rate-btn-fixed2 rate-btn-fixed"></div>
                              <div id="3" class="rate-btn-fixed3 rate-btn-fixed"></div>
                              <div id="4" class="rate-btn-fixed4 rate-btn-fixed"></div>
                              <div id="5" class="rate-btn-fixed5 rate-btn-fixed"></div>
                              <br>
                              <p><?php echo "rating: ".$rating; ?></p>
                          </div>*/
                          ?>

                          
                          
                          <div class='row' style=" position: absolute; bottom: 2px; left:20%;">
                        	  <form method="post" action="cart_update.php">
                        	  <input type="hidden" name="product_code" value="<?php echo $HIDDEN_ID ?>" />
                        	  <input type="hidden" name="type" value="add" />
                        	  <input type="hidden" name="product_qty" value="1" />
                        	  <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
                        	  <input type="submit" name="ADD" style="margin-bottom: 0px;" class="btn btn-success" value="Add To Cart" />
                        	  </form>
                        	 </div>
                        </div>
                  <?php    
                  
                      }
                  ?>
            </div>
          </div>
        </section>
          
<div class="container" style="margin:0px auto; max-width:800px">
    <div class="row">
		<div class="col-md-12">
		    <div class="blog-comment">
				<h3 class="text-success">Reviews</h3>
                <hr/>
				<ul class="comments">
				<?php
$results = $mysqli->query("SELECT * FROM user_rate WHERE product_id = ". $HIDDEN_ID ." 
ORDER BY ID DESC      
LIMIT 3" );
if($results){ 
$review_item = '';
//fetch results set as object and output HTML
while($obj = $results->fetch_object())
{				

$review_item .= <<<EOT
  				<li class="row">
  				  <img src="http://bootdey.com/img/Content/user_1.jpg" class="avatar" alt="">
  				  <div class="col">
  				      <p class="meta">{$obj->date}  <font class="text-success">$obj->username</font></p>
  				      <p>
  				          {$obj->review}
  				      </p>
  				  </div>
  			  </li>
  			  <hr/>
EOT;
}
echo $review_item;
}
?>
				</ul>
			</div>
		</div>
	</div>
</div>

<br>
<br>


<!-- Star Rating Start --> 
<?php 
if(!isset($_SESSION["rating"][$HIDDEN_ID])) {
  
$comment_item .= <<<EOT
    <div class="container" style="text-align:center; margin-right: auto; margin-left: auto;">
      <form id="form" name="form">
        <div class="form-group">
          <label for="rating">Please rate our product:</label>
          <div class="rate-ex1-cnt" style="margin-right: auto; margin-left: auto;">
              
              <div id="1" class="rate-btn-1 rate-btn"></div>
              <div id="2" class="rate-btn-2 rate-btn"></div>
              <div id="3" class="rate-btn-3 rate-btn"></div>
              <div id="4" class="rate-btn-4 rate-btn"></div>
              <div id="5" class="rate-btn-5 rate-btn"></div>
          </div>
        </div>
        <br>
        <div class="form-group">
          <label for="comment">Please give your review:</label>
          <textarea class="form-control" style="max-width:600px; margin:0px auto" rows="5" id="comment"></textarea>
        </div>
        <br>
        <input id="submit" onclick="myFunction()" class="btn btn-success " value="Submit">
        <br><br><br><br>
      </form>
        <div class="box-result-cnt">
EOT;
}
echo $comment_item;            
                $post_id = '1'; 
                if($row["rating_times"] > 0){
                    $rate_times = $row["rating_times"];
                    $rate_value = $row["rating"];
                }else{
                    $rate_value = 0;
                    $rate_times = 0;
                }

            ?>
          <br>

        </div><!-- /rate-result-cnt -->

    </div><!-- /tuto-cnt -->
    
<!-- Star Rating End -->


    
<script type="text/javascript">
    function codeAddress() {
      var rating = parseInt('<?php echo $rating; ?>');
      var j = parseInt(rating);
      $('.rate-btn-fixed').removeClass('rate-btn-fixed-hover');
      for (var i = j; i >= 0; i--) {
          $('.rate-btn-fixed'+i).addClass('rate-btn-fixed-active');
      };
      var half_star = parseInt('<?php echo $half_star; ?>');
      if ( half_star > 0) {
        j = j + 1;
        $('.rate-btn-fixed'+j).addClass('rate-btn-fixed-half');
      };
    }
    window.onload = codeAddress;


    var therate = 1;
    

    $('.rate-btn').hover(function(){
        $('.rate-btn').removeClass('rate-btn-hover');
        var therating = $(this).attr('id');
        for (var i = therating; i >= 0; i--) {
            $('.rate-btn-'+i).addClass('rate-btn-hover');
        };
    });
                    
    $('.rate-btn').click(function(){   
        therate = $(this).attr('id');
        $('.rate-btn').removeClass('rate-btn-active');
        for (var i = therate; i >= 0; i--) {
            $('.rate-btn-'+i).addClass('rate-btn-active');
        };
    });

    
    function myFunction() {

      var comment = document.getElementById("comment").value;
      var dataRate = 'act=rate&return_url=<?php echo $current_url; ?>&product_id=<?php echo $HIDDEN_ID; ?>&comment='+comment+'&rate='+therate;
      // Returns successful data submission message when the entered information is stored in database.

      // AJAX code to submit form.
      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: dataRate,
        cache: false,
        success:function(){alert("Data was succesfully captured");}
      });
      
      location.reload();
      return false;

      }
      
</script>


 
        
        <footer id="footer-main">
            <div class="container">
                <p style="text-align: center;">Copyright &copy; 2017 Shuzhong Chen</p>
            </div>
        </footer>
      

    </body>
</html>