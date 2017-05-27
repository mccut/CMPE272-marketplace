<?php
    $database = "cmpe272";
    $susername = "root";
    $spassword = "";
    
    $debug = 0;
    $shipping_cost = 1.50; //shipping cost
    $taxes = array( //List your Taxes percent here.
        'VAT' => 12,
        'Service Tax' => 5);
                            
    // Connect to MySQL
    try {
        // Connect to the database.
        $conn = new PDO("mysql:host=localhost; dbname=$database", "$susername", "$spassword");
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($debug) echo "Connected successfully";
    } catch(PDOException $ex) {
        echo 'ERROR: '.$ex->getMessage();
    }
?>