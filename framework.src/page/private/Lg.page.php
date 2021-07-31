<?php

/*
PAGEINFO
Title: false;
*/

?>
<h1>Login</h1>
<form class="form-session" method="post" target="_parent">
    <div class="form-group">
        <label class="label" for="InputUsername"><i class="fas fa-user"></i> Username</label>
        <input aria-describedby="InputUsername" class="form-control input" id="InputUsername" name="username"
               placeholder="Enter Username"
               required type="text">
        <small id="usernameHelp" class="form-text text-muted">We will never share your data with anyone share.</small>
    </div>
    <div class="form-group">
        <label class="label" for="InputPassword"><i class="fas fa-lock"></i> Password</label>
        <input type="password" name="password" class="form-control input" id="InputPassword" placeholder="Password"
               required>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input check" id="Check" required>
        <label class="label-small form-check-label input" for="Check">Agree to the <a href="/Termsofuse">Terms of Use</a>.</label>
    </div>
    <label hidden>
        <input name="requestMode" value="login" hidden>
    </label>
    <button type="submit" class="btn btn-primary">Confirm</button>
</form>
