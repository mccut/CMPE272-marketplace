<?php
$TITLE="user";
$style="signin";
require_once "header.php";
?>
    
    <br>
    <br>
    <div class="container">
        <form class="form-signin" action="login.php" method="post">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label class="sr-only">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="sign" value="signin">Sign in</button>
        </form>
    </div>

<?php require_once "footer.php"; ?>