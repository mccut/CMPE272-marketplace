<?php
$TITLE="user";
$style="user";
require_once "header.php";
?>
    
    <br>
    <br>
    <div class="container">
        <form class="form-signin" action="getuser.php" method="post">
            <h2 class="form-signin-heading">Please enter your information</h2>
            <label>First name</label>
                <input type="text" name="firstname" class="form-control" placeholder="Firstname">
            <label>Last name</label>
                <input type="text" name="lastname" class="form-control" placeholder="Lastname" required autofocus>
            <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="example@example.com" required autofocus>
            <label>Home address</label>
                <input type="text" name="address" class="form-control" placeholder="Road, city, states, zip code" required autofocus>
            <label>Home phone</label>
                <input type="text" name="homephone" class="form-control" placeholder="xxx-xxx-xxxx" required autofocus>
            <label>Cell phone</label>
                <input type="text" name="cellphone" class="form-control" placeholder="xxx-xxx-xxxx" required autofocus>
            <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="password" required autofocus>
            <button class="btn btn-md btn-primary btn-block" type="submit" name="choice" value="create">Create</button>
        </form>
    
    </div>

<?php require_once "footer.php"; ?>
