<?php
    $TITLE="product";
    $style="product";
    require_once "header.php";
    require_once "mysql.php";

print<<<HERE
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">VISION</h1>
            <p class="lead">VISION provides information of popular movies. If you like a movie, sign in and buy a DVD easily. </p>
            <div>
                <a href="#prod" class="btn btn-info">Products</a>
                <a href="getproduct.php?action=last" class="btn btn-secondary">5 last visited movies</a>
                <a href="getproduct.php?action=most" class="btn btn-success">5 most visited movies</a>
            </div>
        </div>
    </section>
    
    <a name="prod"></a>
    <div class="album text-muted">
        <div class="container">
            
            <div class="row">
HERE;

    $query = "SELECT id, name, description, image FROM  `Movies`";
    if($debug) echo $query;
    // query Products database
    $data = $conn->query($query);
    $data->setFetchMode(PDO::FETCH_ASSOC);
    if ($data->rowCount() == 0) echo "error";
    foreach ($data as $row) {
        print "<div class=\"card\">";
        echo "<a href=\"getproduct.php?id=".$row['id']."\"><img src=\"img/".$row['image']."\" alt=\"".$row['name']." poster\" height=\"300px\" width=\"235px\"></a>";
        echo "<p class=\"card-text\">".$row['description']."</p>";
        print "</div>";
    }

print "</div></div></div>";
require_once "footer.php"; 
?>