<?php
    session_name("JeanGame");
    session_start();

    require_once("settings.php");

    Page::html_header();
?>

        <section class="main-outside-container">
            <div class="container">
                <form id="login_form" method="post">
                    <h1>Login <a href="register.php"><span class="new-account">Create an account</span></a></h1>

                    <input name="username" placeholder="Username" autofocus required> <br>

                    <input name="password" type="password" placeholder="Password" required> <br>

                    <button name="sign-in" type="submit">Sign in</button>
                </form>

                <div id="message"></div>
            </div>
        </section>

<?php

    $js = array('login');
    Page::html_footer($js);

    new dBug($_SESSION);
    new dBug($_COOKIE);
?>
