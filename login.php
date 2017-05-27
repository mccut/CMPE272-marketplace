<?php
$TITLE="user";
$style="signin";
require_once "header.php";
session_start();
include_once("mysql.php");

    echo "<br>";
    echo "<br>";
    
    extract($_POST);
    if ($sign == 'signin') {
        if (!$username || !$password) {
            print( "<p><strong>Please fill in all form fields.</strong></p>" );
            die();
        }
           
    	/*$sign = $_POST['sign'];
    	$query = "SELECT * FROM  `Customers`";
        if($debug) echo $query;
        // query Products database
        $data = $conn->query($query);
        $data->setFetchMode(PDO::FETCH_ASSOC);
        printTable($data);*/
            
        // Constrain the query.
        $query = "SELECT * FROM Customers WHERE firstname = '$username' OR lastname = '$username' AND password = '$password'";
        if($debug) echo $query;
        
        // query Products database
        $data = $conn->query($query);
        $data->setFetchMode(PDO::FETCH_ASSOC);
        if ($data->rowCount() == 0) $userVerified = 0;
        else $userVerified = 1;
        if($debug) echo $userVerified;
        
        $urlArray = array(
        //"ECWEB"=>"https://phpwebsite-chenshuzhongs.c9users.io/product/listen.php",
        "smile"=>"http://open7smile.us/send.php",
        //"HealthCart"=>"https://www.srivatsamulpuri.me/wp-content/uploads/2017/03/listen.php",
        //"aan"=>"http://thenaser.com/productjson.php",
        //"WEIYU"=>"http://52.52.18.143/userjson.php"
        );
        foreach($urlArray as $Name =>$Name_value) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $Name_value);  
            curl_setopt($ch, CURLOPT_HEADER, 0);  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            $output = curl_exec($ch);
            curl_close($ch);
            $arr = json_decode($output, 1);
            
            foreach ($arr as $statement) { // search the json data by id
                if (strtolower($statement['firstname']) == $username) {
                    if ($statement['password'] == $password) {
                        $userVerified = 1;
                        break;
                    }
                }
            }
            if ($userVerified) break;
        }
        
        if ($userVerified) {
            $_SESSION["user"] = $username;
            if ($username == 'admin') { // admin login 
                $query = "SELECT customer_id, firstname, lastname, email, address, cellphone, homephone FROM  `Customers` WHERE customer_id > 0";
                if($debug) echo $query;
                // query Products database
                $data = $conn->query($query);
                $data->setFetchMode(PDO::FETCH_ASSOC);
                printTable($data);
            } else { // other users login
                print( "<p>Permission has been granted, <strong>$username</strong>. <br>
                        Enjoy the site.</p>" );
            }
        } else {
            print( "<p><strong>Username or password is wrong. <br/>
            Access has been denied.</strong></p>" );
        }
    } else if ($sign == "signout") {
        setcookie("username", $_SESSION['user'], time() - 60 * 60 * 24 * 5);
        echo "<h3>Bye, ".$_SESSION['user']."</h3>";
        session_destroy();
    }
    
    function printTable($data) {
        print "<div class=\"container\">\n";
        print "<h3>Vision Users</h3>";
        print "<table class=\"table table-sm table-hover table-striped\">\n";
        // Construct the HTML table row by row.
        // Start with a header row.
        $doHeader = true;
        foreach ($data as $row) {
            // The header row before the first data row.
            if ($doHeader) {
                print "    <tr>\n";
                foreach ($row as $name => $value) {
                    print "    <th align=\"center\">$name</th>\n";
                }
                print "    </tr>\n";
                $doHeader = false;
            }
            // Data row.
            print "    <tr>\n";
            foreach ($row as $name => $value) {
                print "        <td>$value</td>\n";
            }
            print "        </tr>\n";
        }
        print "    </table>\n";
        print "</div>\n";
    }
    echo "<br>";
require_once "footer.php";    
?>