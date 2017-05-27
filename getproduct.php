<?php
$TITLE="product";
$style="product";
require_once "header.php";
require_once 'mysql.php';

    echo "<br>";
    echo "<br>";
    echo "<br>";
    $debug = 0;
    $post_id = '1'; 
    
    try {
        if (isset($_GET["id"]) || isset($_GET["name"])) {
            if (isset($_GET["name"])) {
                $title = $_GET["name"];
                $query = "SELECT id FROM Movies WHERE name LIKE '%$title%' ";
                if($debug) echo $query;
    
                // query Products database
                $data = $conn->query($query);
                $data->setFetchMode(PDO::FETCH_ASSOC);
                //if ($data->rowCount() == 0) print "<p>Sorry no information. We will update soon.</p>";
                
                foreach ($data as $row) {    
                    foreach ($row as $name => $value) {
                        $id = $value;
                        if($debug) echo $id;
                    }
                }
            }
            
            if (isset($_GET["id"])) $id = $_GET["id"];
            
            // set cookies
            setcookie("'$id'", $id, time() + 60 * 60 * 24 * 5);
            $visitcount = "$id"."count";
            if ($debug) echo $visitcount;
            if (!isset($_COOKIE["$visitcount"])) {
                $_COOKIE["$visitcount"] = 0;
            }
            $_COOKIE["$visitcount"] = 1 + (int) max(0, $_COOKIE["$visitcount"]);
            setcookie("$visitcount", $_COOKIE["$visitcount"], time() + 60 * 60 * 24 * 5);
            // setcookie("idrecord", $id, time() - 60 * 60 * 24 * 5); //unset or set expire time before will delete cookie 
            if($debug) {
		        echo $_COOKIE['idrecord'];
            	echo ": ".$_COOKIE["$visitcount"];
	        }

            $query = "SELECT image, name, year, rated, genre, directors, writers, actors, released, runtime, language, country, awards, description FROM Movies WHERE id='$id' ";
            if($debug) echo $query;

            // query Products database
            $data = $conn->query($query);
            $data->setFetchMode(PDO::FETCH_ASSOC);
            if ($data->rowCount() == 0) print "<p>Sorry no information. We will update soon.</p>";
            
            // print table
            print "<div class=\"container\">\n";
            print "<table class=\"table table-sm table-hover table-striped\">\n";
            // Construct the HTML table row by row.
            foreach ($data as $row) {    
                // Data row.
                foreach ($row as $name => $value) {
                    if ($name == "image") { // for poster dispaly
                        print "        <td><img src=\"img/$value\"  width=\"300\" height=\"400\"/></td>";
print<<<HERE
<td>
    <div class="tuto-cnt">
        <div class="rate-ex1-cnt">
            <form id="form" name="form">
            <label for="rating">Please rate our product:</label>
                <div id="1" class="rate-btn-1 rate-btn"></div>
                <div id="2" class="rate-btn-2 rate-btn"></div>
                <div id="3" class="rate-btn-3 rate-btn"></div>
                <div id="4" class="rate-btn-4 rate-btn"></div>
                <div id="5" class="rate-btn-5 rate-btn"></div>
                <br>
            <label for="review">Please give your review:</label>
                 <textarea class="form-control" style="max-width:600px" rows="5" id="review"></textarea>
                <br>
                <input id="submit" onclick="myFunction()" class="btn btn-success " value="Submit">
            </form>
        </div>
    </div><!-- /tuto-cnt -->
    
    
</td>
HERE;
                    } else {
                        print "    <tr>\n";
                        print "        <td>$name</td>\n"; 
                        print "        <td>$value</td>\n";
                        print "        </tr>\n";
                    }
                }
            }
                print "    <tr>\n";
                print "        <td>rating</td>";
                print "        <td>";
                print "<div class=\"box-result-cnt\">\n";

                //$query = mysql_query("SELECT * FROM wcd_rate"); 
                $rate = $conn->query("SELECT rating FROM Ratings WHERE movie_id=\"$id\"");
                $rate->setFetchMode(PDO::FETCH_ASSOC);
                if ($rate->rowCount() != 0) {
                    $rate_times = $rate->rowCount();
                    $sum_rates = 0;
                    foreach ($rate as $row) {
                        $sum_rates += $row["rating"];
                    }
                    $rate_value = $sum_rates/$rate_times;
                    $rate_bg = (($rate_value)/5)*100;
                } else{
                    $rate_times = 0;
                    $rate_value = 0;
                    $rate_bg = 0;
                }
                print '<p>The content was rated <strong>';
                echo $rate_times;
                print '</strong> times. ';
                print 'The rating is at <strong>';
                echo $rate_value;
                print '</strong> .</p>';
                
                print "<div class=\"rate-result-cnt\">\n"; //??
                print '    <div class="rate-bg" style="width:';
                echo $rate_bg;
                print '</div>';
                print '<div class="rate-stars"></div>';
                print '</div>';
                print '</div><!-- /rate-result-cnt -->';
                
                print "        </td>";
                print "        </tr>\n";
                print "    </table>\n";
                print "</div>\n";
        }

        if (isset($_GET["action"])) {
            print "<section id=\"result\">\n";
            print "<div class=\"section-content\">\n";
            print "<div class=\"container\">\n";
            print "<table class=\"table table-sm table-hover table-striped\" style=\"width:800px\">\n";
            if ($_GET["action"] == "last") {
                print "<tr><th>Last five previously visited movies</th></tr>\n";
                $i = 0;
                foreach ( $_COOKIE as $key => $value ) {
                    if (strpos($key,'count') == false) {
                        $array[$i] = $value;
                        $i++;
                    }
                }
                $count = 5;
                for ( $i = count($array) - 1; $i >= 0; $i--) {
                    if ($count == 0) break;
                    if ($debug) {
                        echo $array[$i];
                        echo "<br>";
                    }
                    $query = "SELECT name FROM Movies WHERE id='$array[$i]' ";
                    if ($debug) {
                        echo $query;
                        echo "<br>";
                    }
                    $count--;
                    // query Products database
                    $data = $conn->query($query);
                    $data->setFetchMode(PDO::FETCH_ASSOC);

                    if ($data->rowCount() == 0) print "<tr><td>Sorry no information. We will update soon.</td></tr>";

                    // Construct the HTML table row by row.
                    foreach ($data as $row) {    
                        // Data row.
                        foreach ($row as $name => $value) {                    
                            print "    <tr>\n";
                            print "        <td><a href=\"https://vision-syrhuang.c9users.io/getproduct.php?movie_id=$array[$i]\">$value</a></td>\n";
                            print "    </tr>\n";
                        }
                    }
                }
            }
            if ($_GET["action"] == "most") {
                print "<tr><th>Five most visited movies</th></tr>\n";
                foreach ( $_COOKIE as $key => $value ) {
                    if (strpos($key,'count') != false) {
                        $len = strpos($key,'count') - 0;
                        $k = substr($key, 0, 9);
                        $count["$k"] = $value;
                    }
                }
		if ($debug) var_dump($count);
                arsort($count);
                $c = 0;
                foreach ( $count as $key => $value) {
                    if ($c == 5) break;
                    if ($debug) {
                        echo $key;
                        echo $value;
                        echo "<br>";
                    }
                    $query = "SELECT name FROM Movies WHERE id='$key' ";
                    if ($debug) {
                        echo $query;
                        echo "<br>";
                    }
                    $c++;
                    // query Products database
                    $data = $conn->query($query);
                    $data->setFetchMode(PDO::FETCH_ASSOC);

                    if ($data->rowCount() == 0) print "<tr><td>Sorry no information. We will update soon.</td></tr>";

                    // Construct the HTML table row by row.
                    foreach ($data as $row) {    
                        // Data row.
                        foreach ($row as $name => $v) {                    
                            print "    <tr>\n";
                            print "        <td><a href=\"https://vision-syrhuang.c9users.io/getproduct.php?movie_id=$key\">$v</td>\n";
                            print "    </tr>\n";
                        }
                    }
                }
            }
            print "    </table>\n";
            print "</div>\n";
        }

    } catch(PDOException $ex) {
        echo 'ERROR: '.$ex->getMessage();
    }?>

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
      

      return false;

      }
      
</script>
    <?php
    require_once "footer.php";
    ?>