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
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">CONTACTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user.html">USER</a>
                </li>
                <li class="nav-item active">
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
        
        if (!$username || !$password) {
            print( "<p><strong>Please fill in all form fields.</strong></p>" );
            die();
        }
       
	$sign = $_POST['sign'];
	// echo $sign;
        // check if the New User button was clicked
        if ($sign == 'Signup') {
            // open password.txt for writing using append mode
            if (!($file = fopen("users.txt", "a+"))) {
                // print error message and terminate script 
                // execution if file cannot be opened
                print( "<p>Could not open file</p>" );
                die();
            }
            // write username and password to file and 
            // call function userAdded
            fputs( $file, "$username,$password\n" );
            print( "<p><strong>You have been added 
                    to the user list, $username.
                    </br>Enjoy the site.</strong></p>" );
        } else {
            // if a new user is not being added, open file for reading
            if ( !( $file = fopen( "users.txt", "r" ) ) ) {
                print( "<p>Could not open file</p>" );
                die();
            }
            
            // read each line in file and check username and password
            $userVerified = 0;
            while ( !feof( $file ) && !$userVerified ) {
                // read line from file
                $line = fgets($file);
                // remove newline character from end of line
                $line = chop( $line );
                // split username and password
                $field = explode( ",", $line, 2 );
                // verify username
                if ( $username == $field[0] ) {
                    $userVerified = 1;
                    // call function checkPassword to verify
                    // user’s password
                    if (checkPassword( $password, $field ) == true) {
                        if ($username == 'admin') {
                            print('<div class="container">');
                            print("<h1>Current Users<h1>");
                            $fh = fopen('users.txt','r');
                            while ($line = fgets($fh)) {
                                if($line!="\n") {
                                    $line = chop( $line );
                                    $item = explode( ",", $line, 2 );
                                    if ($item[0] != 'admin') {
                                        print "<h4>$item[0]</h4>";
                                    }
                                }
                                else print "</br>";
                            }
                            print("</div>");
                            fclose($fh);
                        } else {
                            print( "<p><strong>Permission has been 
                                    granted, $username. <br />
                                    Enjoy the site.</strong></p>" );
                        }
                    } else {
                        print( "<p><strong>You entered an invalid password.
                                <br />Access has been denied.</strong></p>" );
                    }
                }
            }
            
            // close text file
            fclose( $file );
    
            // call function accessDenied if username has 
            // not been verified
            if ( !$userVerified ) {
                print( "<p><strong>
                    You were denied access to this server.
                    </strong></p>" );
            }
        }
        
        // verify user password and return a boolean
        function checkPassword( $userpassword, $filedata ) {
            //echo $userpassword;
            //echo "</br>";
            //echo $filedata[1];
            if ($userpassword == $filedata[1]) {
                //echo "</br>True";
                return true;
            } else {
                //echo "</br>False";
                return false;
            }
        }
        
    ?>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/tether/dist/js/tether.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>
