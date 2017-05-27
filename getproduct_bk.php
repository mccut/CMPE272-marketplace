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

    $database = "cmpe272";
    $username = "root";
    $password = "";

    // Connect to MySQL
    try {
        if (isset($_GET["movie_id"]) || isset($_GET["title"])) {
            if (isset($_GET["title"])) {
                $title = $_GET["title"];
                $query = "SELECT movie_id FROM Movies WHERE title LIKE '%$title%' ";
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
            
            if (isset($_GET["movie_id"])) $id = $_GET["movie_id"];
            
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

            $query = "SELECT poster, title, year, rated, genre, directors, writers, actors, released, runtime, language, country, awards, plot FROM Movies WHERE movie_id='$id' ";
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
                    if ($name == "poster") { // for poster dispaly
                        print "        <td><img src=\"$value\"  width=\"300\" height=\"400\"/></td>";
                    } else {
                        print "    <tr>\n";
                        print "        <td>$name</td>\n"; 
                        print "        <td>$value</td>\n";
                        print "        </tr>\n";
                    }
                }
            }
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
                    $query = "SELECT title FROM Movies WHERE movie_id='$array[$i]' ";
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
                    $query = "SELECT title FROM Movies WHERE movie_id='$key' ";
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
    }
    
    require_once "footer.php";
    ?>