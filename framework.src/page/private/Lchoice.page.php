<?php

/*
PAGEINFO
Title: false;
*/


if (isset($_SESSION['login_User'])) {
    echo '<h2>You are already logged in!</h2>';
} else {
    echo '
    <div class="login">
    <div class="choice">
    <form class="formular login-form" target="_self" method="post">
        <input type="hidden" name="pagename" value="Login">
        <button type="submit" class="btn button" name="st" value="login">Login</button>
    </form>
    <form class="formular register-form" target="_self" method="post">
        <input type="hidden" name="pagename" value="Login">
        <button type="submit" class="btn button" name="st" value="register">Register</button>
    </form>
    </div>
    <hr>
    <div class="description">
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et
        dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet
        clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,
        consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed
        diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea
        takimata sanctus est Lorem ipsum dolor sit amet.
    </div>
</div>
    ';
}
