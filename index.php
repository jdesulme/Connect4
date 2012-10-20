<?php
session_start();
require_once("settings.php");

$page = new Page();
$page->html_header();

?>
<article class="entrance">
    <div class="container">
        <form id="login_form" action="lobby.php" method="post">
            <h1>Login <a href="register.php"><span class="new-account">Create an account</span></a></h1>

            <input name="username" placeholder="Username" autofocus required> <br>

            <input name="password" type="password" placeholder="Password" required> <br>

            <button name="sign-in" type="submit">Sign in</button>
        </form>
        <div id="message"></div>
    </div>
</article>
<?php

$page->html_footer();

?>