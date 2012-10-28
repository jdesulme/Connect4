<?php
/**
 * Created by JetBrains PhpStorm.
 * User: student
 * Date: 10/27/12
 * Time: 2:55 PM
 * To change this template use File | Settings | File Templates.
 */
session_start();

//if not logged in, re-direct to login.php
if (empty($_SESSION['user_name']) && empty($_COOKIE['token'])) {
    header("location: index.php");
}

session_destroy();


require_once("settings.php");
$page = new Page();
$page->html_header();


new dBug($_COOKIE);
new dBug($_SESSION);

?>

    <section class="main-outside-container">
        <div class="container">
            <p>Thanks for playing the game. You are now logged out.</p>
            <p>We hope to see you soon.</p>
        </div>
    </section>


<?php $page->html_footer(); ?>
