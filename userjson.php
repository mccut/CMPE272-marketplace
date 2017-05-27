<?php
    include_once("mysql.php");
    $debug = 0;

    // Connect to MySQL
    try {
        $query = "SELECT customer_id, firstname, lastname, email, address, cellphone, homephone FROM  `Customers` WHERE customer_id > 0 ";
        if($debug) echo $query;
        // query Products database
        $data = $conn->query($query);
        $data->setFetchMode(PDO::FETCH_ASSOC);
        
        $i=0;
        While($RowResultSqlUsers=$data->fetch(PDO::FETCH_NUM)) {
        	$UserArray[$i++]=array(
        	    'id'=>$RowResultSqlUsers[0],
        		'firstname'=>$RowResultSqlUsers[1],
        		'lastname'=>$RowResultSqlUsers[2],
        		'email'=>$RowResultSqlUsers[3],
        		'address'=>$RowResultSqlUsers[4],
        		'cellphone'=>$RowResultSqlUsers[5],
        		'homephone'=>$RowResultSqlUsers[6]);
        }
        echo json_encode($UserArray);
    } catch(PDOException $ex) {
    echo 'ERROR: '.$ex->getMessage();
    }
?>