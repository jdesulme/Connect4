<?php
    session_start();
    require_once("settings.php");
    $page = new Page();
    $page->html_header();
?>

        <article class="entrance">
            <div class="container">
                <form id="register_form" method="post">
                    <h1>Registration</h1>

                    <input name="username" placeholder="Username" autofocus required> <br>

                    <input id="email" name="email" type="email" placeholder="Email" required> <br>

                    <input id="password" name="password" type="password" placeholder="Password" required> <br>

                    <input name="password-confirm" type="password" placeholder="Confirm Password" required oninput="checkPasswordMatch(this)"> <br>

                    <button name="register-submit" type="submit">Create Account</button>

                    <p class="gravatar-text"><em>*</em> Please use an Email that is linked to Gravatar to have your image display.</p>

                </form>

                <div id="message"></div>
            </div>
        </article>

<?php $page->html_footer(array('login'));  ?>