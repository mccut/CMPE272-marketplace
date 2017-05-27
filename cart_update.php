<?php
    session_start(); //start session
    include_once("mysql.php"); //connect to mysql server
    $debug = 0;
    
    //add product to session or create new one
    if(isset($_POST["type"]) && $_POST["type"]=='add' && $_POST["product_qty"] > 0) {
        foreach($_POST as $key => $value){ //add all post vars to new_product array
            $new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }
        //remove unecessary vars
        unset($new_product['type']);
        unset($new_product['return_url']); 
        
        // Vision products
        if ($new_product['company'] == "Vision") {
            $query = "SELECT title, price FROM Movies WHERE movie_id = \"".$new_product['product_code']. "\"";
            $statement = $conn->query($query);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            
            foreach ($statement as $row) {
                //fetch product name, price from db and add to new_product array
                $new_product["product_name"] = $row['title'];
                $new_product["product_price"] = $row['price'];
                if(isset($_SESSION["cart_products"])){  //if session var already exist
                    if(isset($_SESSION["cart_products"][$new_product['product_code']])) {//check item exist in products array
                        unset($_SESSION["cart_products"][$new_product['product_code']]); //unset old array item
                    }           
                }
                $_SESSION["cart_products"][$new_product['product_code']] = $new_product; //update or create product session with new item  
            }
        } else if ($new_product['company'] == "ECWEB") {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://phpwebsite-chenshuzhongs.c9users.io/product/listen.php");  
            curl_setopt($ch, CURLOPT_HEADER, 0);  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            $output = curl_exec($ch);
            curl_close($ch);
            $arr = json_decode($output, 1);
            
            foreach ($arr as $statement) { // search the json data by id
                if ($statement['id'] == $new_product['product_code']) {
                    break;
                }
            }
            
            $new_product["product_name"] = $statement['name'];
            $new_product["product_price"] = $statement['price'];
            if(isset($_SESSION["cart_products"])){  //if session var already exist
                if(isset($_SESSION["cart_products"][$new_product['product_code']])) {//check item exist in products array
                    unset($_SESSION["cart_products"][$new_product['product_code']]); //unset old array item
                }           
            }
            $_SESSION["cart_products"][$new_product['product_code']] = $new_product; //update or create product session with new item
        } else if ($new_product['company'] == "smile") {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://www.open7smile.us/sendproduct.php");  
            curl_setopt($ch, CURLOPT_HEADER, 0);  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            $output = curl_exec($ch);
            curl_close($ch);
            $arr = json_decode($output, 1);
            
            foreach ($arr as $statement) { // search the json data by id
                if ($statement['product_id'] == $new_product['product_code']) {
                    break;
                }
            }
            
            $new_product["product_name"] = $statement['product_name'];
            $new_product["product_price"] = $statement['price'];
            if(isset($_SESSION["cart_products"])){  //if session var already exist
                if(isset($_SESSION["cart_products"][$new_product['product_code']])) {//check item exist in products array
                    unset($_SESSION["cart_products"][$new_product['product_code']]); //unset old array item
                }           
            }
            $_SESSION["cart_products"][$new_product['product_code']] = $new_product; //update or create product session with new item
        }
    }
    
    //update or remove items 
    if(isset($_POST["product_qty"]) || isset($_POST["remove_code"])) {
        //update item quantity in product session
        if(isset($_POST["product_qty"]) && is_array($_POST["product_qty"])) {
            foreach($_POST["product_qty"] as $key => $value) {
                if(is_numeric($value)) {
                    $_SESSION["cart_products"][$key]["product_qty"] = $value;
                }
            }
        }
        
        //remove an item from product session
        if(isset($_POST["remove_code"]) && is_array($_POST["remove_code"])) {
            foreach($_POST["remove_code"] as $key) {
                unset($_SESSION["cart_products"][$key]);
            }   
        }
    }
    
    //back to return url
    $return_url = (isset($_POST["return_url"]))?urldecode($_POST["return_url"]):''; //return url
    header('Location:'.$return_url);
?>