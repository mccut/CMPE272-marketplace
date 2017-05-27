<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css?v1.1">

    <!-- custom CSS, add ?v=1.1 to force css reload -->
    <link href="user.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.html">VISION</a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.html">PRODUCT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="news.html">NEWS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">CONTACTS</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="user.html">USER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="secure.html">SECURE</a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <br>
    <br>
    <br>
	
    <?php
        extract($_POST);
        
        $database = "cmpe272";
        $username = "syrhuang";
        $password = "";
        
        $debug = 0;

        // Connect to MySQL
        try {
            // Connect to the database.
            $conn = new PDO("mysql:host=localhost; dbname=$database", "$username", "$password");
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if($debug) echo "Connected successfully";
            if($debug) echo $_POST['choice'];
            if ($_POST['choice'] == "search") {
                // Constrain the query.
                if (strlen($name) == 0 && strlen($email) == 0 && strlen($phone) == 0) {
                    echo "Please enter search criteria!";
                } else {
                    $query = "SELECT * FROM Customers ";
                    if (strlen($name) > 0) {
                      $query .= "WHERE firstname = '$name' OR lastname = '$name' ";
                    }
                    if (strlen($email) > 0) {
                        if (strpos("$query", "WHERE")) $query .= "AND email = '$email' ";
                        else $query .= "WHERE email = '$email' ";
                    }
                    if (strlen($phone) > 0) {
                        if (strpos("$query", "WHERE")) $query .= "AND homephone = '$phone' OR cellphone = '$phone' ";
                        else $query .= "WHERE homephone = '$phone' OR cellphone = '$phone' ";
                    }
                }
                if($debug) echo $query;
                // query Products database
                $data = $conn->query($query);
                $data->setFetchMode(PDO::FETCH_ASSOC);
                
                if ($data->rowCount() == 0) print "<p>Not found!</p>";
                print "<div class=\"container\">\n";
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
            } else {
                $query = "SELECT customer_id FROM  `Customers` ORDER BY customer_id DESC LIMIT 1";
                $data = $conn->query($query);
                $data->setFetchMode(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    foreach ($row as $name => $value) {
                        $id = $value + 1;
                        if($debug) echo $id;
                    }
                }
                $sql = "INSERT INTO Customers VALUES ('$id', '$firstname', '$lastname', '$email', '$address', '$cellphone', '$homephone')";
                if($debug) echo $sql;
                if ($conn->query($sql) == TRUE) {
                    echo "Your information have been successfully added into the database";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            
        } catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }
        
    ?>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/tether/dist/js/tether.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>
