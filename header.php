<?php
if (!isset($TITLE)) {
  $TITLE = "UNTITLED PAGE";
}

function setActive($currentPage, $compare) {
  if(strcmp ($currentPage, $compare) == 0) {
    echo "class=\"nav-item active\"";
  }
}

function setCss($currentStyle) {
    if (isset($currentStyle)) {
        echo "<link href=\"css/$currentStyle.css?v=1.1\" rel=\"stylesheet\">";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> <?php echo $TITLE; ?> </title>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css?v1.1">

    <!-- custom CSS, add ?v=1.1 to force css reload -->
    <?php setCss($style); ?>

</head>

<body>
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.php">VISION</a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li <?php setActive($TITLE, "home"); ?>>
                    <a class="nav-link" href="index.php">HOME</a>
                </li>
                <li <?php setActive($TITLE, "about"); ?>>
                    <a class="nav-link" href="about.php">ABOUT</a>
                </li>
                <li <?php setActive($TITLE, "product"); ?>>
                    <a class="nav-link" href="product.php">PRODUCT</a>
                </li>
                <li <?php setActive($TITLE, "news"); ?>>
                    <a class="nav-link" href="news.php">NEWS</a>
                </li>
                <li <?php setActive($TITLE, "contact"); ?>>
                    <a class="nav-link" href="contact.php">CONTACTS</a>
                </li>
                <li <?php setActive($TITLE, "user"); ?>>
                    <a class="nav-link" href="user.php">USER</a>
                </li>
                <li <?php setActive($TITLE, "market"); ?>>
                    <a class="nav-link" href="http://www.shuzhongchen.com/market/index.php">MARKET</a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0" action="getproduct.php" method="get">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" name="title">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>