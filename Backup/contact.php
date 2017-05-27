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
    <link href="signin.css" rel="stylesheet">

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
                <li class="nav-item active">
                    <a class="nav-link" href="contact.php">CONTACTS</a>
                </li>
                <li class="nav-item">
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
    
    <?php 
    
    $fh = fopen('contacts.txt','r');
    print('<div class="container">');
    while ($line = fgets($fh)) {
    	if($line!="\n") print "<h4>$line</h4>";
    	else print "</br>";
    }
    print("</div>");
    fclose($fh);
    
    ?>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/tether/dist/js/tether.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
</body>
</html>
