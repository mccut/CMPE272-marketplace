<?php
$TITLE="product";
$style="../css/product";
require_once "../header.php";

    echo "<br>";
    echo "<br>";
    echo "<br>";
    $debug = 0;
    $post_id = '1'; 

    // Connect to MySQL
    try {
        if (isset($_GET["movie_id"])) {
            $id = $_GET["movie_id"];
            
            // set cookies
            setcookie("'$id'", $id, time() + 60 * 60 * 24 * 5);
            $visitcount = "$id"."count";
            if ($debug) echo $visitcount;
            if (!isset($_COOKIE["$visitcount"])) {
                $_COOKIE["$visitcount"] = 0;
            }
            $_COOKIE["$visitcount"] = 1 + (int) max(0, $_COOKIE["$visitcount"]);
            setcookie("$visitcount", $_COOKIE["$visitcount"], time() + 60 * 60 * 24 * 5);
            if($debug) {
		        echo $_COOKIE['idrecord'];
            	echo ": ".$_COOKIE["$visitcount"];
	        }
            
            // query the product json
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "vision-syrhuang.c9users.io/productjson.php");  
            curl_setopt($ch, CURLOPT_HEADER, 0);  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            $output = curl_exec($ch);
            curl_close($ch);
            $arr = json_decode($output, 1);
            
            foreach ($arr as $statement) { // search the json data by id
                if ($statement['id'] == $id) {
                    break;
                }
            }
            
            // print table
            print "<div class=\"container\">\n";
            print "<table class=\"table table-sm table-hover table-striped\">\n";
            // Construct the HTML table row by row.
            foreach ($statement as $name => $value) {
                if ($name == "poster") { // for poster dispaly
                    print "        <td><img src=\"$value\"  width=\"300\" height=\"400\"/></td>";
                } else {
                    print "    <tr>\n";
                    print "        <td>$name</td>\n"; 
                    print "        <td>$value</td>\n";
                    print "        </tr>\n";
                }
            }
            print "    </table>\n";
            print "</div>\n";
        }

    } catch(PDOException $ex) {
        echo 'ERROR: '.$ex->getMessage();
    }
    
    require_once "../footer.php";
    ?>