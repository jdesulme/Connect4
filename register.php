<?php
    session_name("JeanGame");
    session_start();

    require_once("settings.php");

    Page::html_header();
?>

        <section class="main-outside-container">
            <div class="container">
                <form id="register_form" method="post">
                    <h1>Registration</h1>

                    <input name="username" placeholder="Username" autofocus required> <br>

                    <input id="email" name="email" type="email" placeholder="Email" required> <br>

                    <input id="password" name="password" type="password" placeholder="Password" required> <br>

                    <input name="password-confirm" type="password" placeholder="Confirm Password" oninput="checkPasswordMatch(this)" required> <br>

                    <button name="register-submit" type="submit">Create Account</button>

                    <p class="gravatar-text"><em>*</em> Please use an Email that is linked to Gravatar to have your image display.</p>

                </form>

                <div id="message"></div>
            </div>
        </section>

<?php Page::html_footer(array('login'));  ?>