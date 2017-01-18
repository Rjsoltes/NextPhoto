<?php require_once("resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "loginHeader.php"); ?>
<br><br>
    <div class="container">
        <img class="center-block img-responsive" src="resources/img/NPlogo1.png" alt="logo">
    </div>
    <div class="container">

        <form class="form-signin" method="post" autocomplete="off">
            <h4 class="text-center bg-danger"><?php display_message(); ?></h4>
            <?php login_user(); ?>
            <label for="inputUsername" class="sr-only">Username</label>
            <input type="text" name="inputUsername" class="form-control" placeholder="Username" autocomplete="off" required autofocus><br>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="inputPassword" class="form-control" placeholder="Password" autocomplete="off" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
        </form>
    </div>
</body>
<?php require_once("resources/close_conn.php"); ?>
</html>
