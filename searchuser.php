<?php
$TITLE="user";
$style="user";
require_once "header.php";
?>

    <br>
    <br>
    <div class="container">
        <form class="form-signin" action="getuser.php" method="post">
            <h2 class="form-signin-heading">Search by</h2>
            <label class="sr-only">Name</label>
            <input type="text" name="name" class="form-control" placeholder="names">
            <label class="sr-only">Email</label>
            <input type="text" name="email" class="form-control" placeholder="email">
            <label class="sr-only">Phone</label>
            <input type="text" name="phone" class="form-control" placeholder="phone numbers">
            </br>
            <button class="btn btn-md btn-primary btn-block" type="submit" name="choice" value="search">Search</button>
        </form>
    </div>

<?php require_once "footer.php"; ?>
