<?php
//start the session
session_start();

require_once("settings.php");

//if not logged in, re-direct to login.php
if (empty($_SESSION['user_name']) && empty($_COOKIE['token'])) {
    header("location: index.php");
}

$page = new Page();
$page->html_header(null,'Connect 4 - Game');
?>




<section>

</section>

<?php


$page->html_footer();

?>