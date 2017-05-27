<?php
    $TITLE="user";
    $style="user";
    require_once "header.php";
    include_once("mysql.php");
    extract($_POST);
    $debug = 0;
    echo "<br>";
    echo "<br>";
    echo "<br>";

    // Connect to MySQL
    try {
        if($debug) echo $_POST['choice'];
        if (isset($_GET["choice"]) && $_GET["choice"] == "list") {
	        $query = "SELECT customer_id, firstname, lastname, email, address, cellphone, homephone FROM  `Customers` WHERE customer_id > 0 ";
            if($debug) echo $query;
            // query Products database
            $data = $conn->query($query);
            $data->setFetchMode(PDO::FETCH_ASSOC);
            printTable($data);
        }
        if (isset($_POST['choice'])) {
            if ($_POST['choice'] == "search") {
                // Constrain the query.
                if (strlen($name) == 0 && strlen($email) == 0 && strlen($phone) == 0) {
                    echo "Please enter search criteria!";
                } else {
                    $query = "SELECT customer_id, firstname, lastname, email, address, cellphone, homephone FROM Customers WHERE customer_id > 0 ";
                    if (strlen($name) > 0) {
                      $query .= "AND firstname = '$name' OR lastname = '$name' ";
                    }
                    if (strlen($email) > 0) {
                        //if (strpos("$query", "WHERE")) $query .= "AND email = '$email' ";
                        $query .= "WHERE email = '$email' ";
                    }
                    if (strlen($phone) > 0) {
                        $query .= "WHERE homephone = '$phone' OR cellphone = '$phone' ";
                    }
                }
                if($debug) echo $query;
                // query Products database
                $data = $conn->query($query);
                $data->setFetchMode(PDO::FETCH_ASSOC);

                if ($data->rowCount() == 0) {
                    print "<h3>Not found!</h3>";
                    print "<br>";
                }
                else printTable($data);
            } else if ($_POST['choice'] == "list") {
                $query = "SELECT customer_id, firstname, lastname, email, address, cellphone, homephone FROM  `Customers` WHERE customer_id > 0";
                if($debug) echo $query;
                // query Products database
                $data = $conn->query($query);
                $data->setFetchMode(PDO::FETCH_ASSOC);
                printTable($data);
                
                // decode json type data
                echo "<br>";
                $urlArray = array("Singleyefish Comics's Users"=>"www.open7smile.us/send.php",
                "WEIYU RESTAURANT's Users"=>"http://52.52.18.143/userjson.php"
                //,"http://www.shuzhongchen.com/user/show_user.php"
                );
                foreach($urlArray as $Name =>$Name_value) {
                    print "<div class=\"container\">\n";
                	print "<h3>$Name</h3>";
                	printUsers($Name_value);
                	print "</div>";
                	echo "<br>";
                }
            } else if ($_POST['choice'] == "create") {
                $query = "SELECT customer_id FROM  `Customers` ORDER BY customer_id DESC LIMIT 1";
                $data = $conn->query($query);
                $data->setFetchMode(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    foreach ($row as $name => $value) {
                        $id = $value + 1;
                        if($debug) echo $id;
                    }
                }
                $sql = "INSERT INTO Customers VALUES ('$id', '$firstname', '$lastname', '$email', '$address', '$cellphone', '$homephone', '$password')";
                if($debug) echo $sql;
                if ($conn->query($sql) == TRUE) {
                    echo "Your information have been successfully added into the database";
                    echo "<br>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    } catch(PDOException $ex) {
        echo 'ERROR: '.$ex->getMessage();
    }
    require_once "footer.php";
    
    function printTable($data) {
        print "<div class=\"container\">\n";
        print "<h3>Vision's Users</h3>";
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

    function printUsers($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_HEADER, 0);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch);
        curl_close($ch);
        $arr = json_decode($output,1);
        
        print "<table class=\"table table-sm table-hover table-striped\">\n";
        // Construct the HTML table row by row.
        // Start with a header row.
        print "    <th align=\"center\">ID</th>\n";
        print "    <th align=\"center\">Firstname</th>\n";
        print "    <th align=\"center\">Lastname</th>\n";
        print "    <th align=\"center\">Email</th>\n";
        print "    <th align=\"center\">Address</th>\n";
        print "    <th align=\"center\">Cellphone</th>\n";
        print "    <th align=\"center\">Homephone</th>\n";
        foreach ($arr as $Person) {
            // Data row.
            print "    <tr>\n";
            echo "        <td>".$Person['id']."</td>\n";
            echo "        <td>".$Person['firstname']."</td>\n";
            echo "        <td>".$Person['lastname']."</td>\n";
            echo "        <td>".$Person['email']."</td>\n";
            echo "        <td>".$Person['address']."</td>\n";
            echo "        <td>".$Person['cellphone']."</td>\n";
            echo "        <td>".$Person['homephone']."</td>\n";
            print "    </tr>\n";
        }
        print "</table>\n";
        print "</div>\n";
    }
?>
