<?php
require_once("settings.php");

//start the session
session_start();

new dBug($_COOKIE);
new dBug($_SESSION);

/*
//if not logged in, re-direct to login.php
if (empty($_SESSION['username']) ) {
    header("location: index.php");
}
*/

$page = new Page();
$page->html_header(null,'Connect 4 - Game');


?>




<section>

</section>

<?php


$page->html_footer();

?>