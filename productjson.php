<?php
    include_once("mysql.php");
    $debug = 0;

    // Connect to MySQL
    try {
        $query = "SELECT id, name, image, price, description FROM  Movies ";
        if($debug) echo $query;
        // query Products database
        $data = $conn->query($query);
        $data->setFetchMode(PDO::FETCH_ASSOC);
        
        $i=0;
        While($RowResultSqlUsers=$data->fetch(PDO::FETCH_NUM)) {
        	$UserArray[$i++]=array(
        	    'id'=>$RowResultSqlUsers[0],
        		'name'=>$RowResultSqlUsers[1],
        		'image'=>$RowResultSqlUsers[2],
        		'price'=>$RowResultSqlUsers[3],
        		'description'=>$RowResultSqlUsers[4]
        	);
        }
        echo json_encode($UserArray);
    } catch(PDOException $ex) {
    echo 'ERROR: '.$ex->getMessage();
    }
?>