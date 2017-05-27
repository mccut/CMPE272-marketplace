<?php
$TITLE="user";
$style="user";
require_once "header.php";
session_start();
include_once("fbscript.php");
?>
    <br>
    <br>
    <div class="container">
        <h2 class="form-signin-heading">Welcome to VISION</h2>
        <form class="form-signin" action="searchuser.php">
        <button class="btn btn-md btn-primary btn-block" type="submit" name="choice" value="search">Search users</button>
        </form>
        
	    <form class="form-signin" action="getuser.php" method="get">
        <button class="btn btn-md btn-primary btn-block" type="submit" name="choice" value="list">List users of my company</button>
        </form>
        
        <form class="form-signin" action="getuser.php" method="post">
        <button class="btn btn-md btn-primary btn-block" type="submit" name="choice" value="list">List users of all companies</button>
        </form>
        
        <form class="form-signin" action="createuser.php">
        <button class="btn btn-md btn-primary btn-block" type="submit" name="choice" value="create">Sign up</button>
        </form>
        <?php
        if (isset($_COOKIE["username"])) {
          $_SESSION["user"] = $_COOKIE["username"];
        }
        if (!isset($_SESSION["user"])) {
            print '<form class="form-signin" action="secure.php">';
            print '<button class="btn btn-md btn-primary btn-block" type="submit" name="choice" value="secure">Secure login in</button>';
            print '</form>';
            print '<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">';
            print '</fb:login-button>';
        } else {
            print '<form class="form-signin" action="login.php" method="post">';
            print '<button class="btn btn-md btn-primary btn-block" type="submit" name="sign" value="signout">Secure sign out</button>';
            print '</form>';
        } ?>
        
    </div>
    <br>

<?php require_once "footer.php"; ?>
