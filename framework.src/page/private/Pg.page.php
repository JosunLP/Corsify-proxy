<?php

/*
PAGEINFO
Title: false;
*/

?>
<h1>Registration</h1>
<form class="form-session" method="post" target="_parent">
    <div class="form-group">
        <label class="label" for="InputEmail"><i class="far fa-envelope"></i> E-Mail</label>
        <input type="email" name="email" class="form-control input" id="InputEmail" aria-describedby="eMail"
               placeholder="Enter Email" required>
    </div>
    <div class="form-group">
        <label class="label" for="InputUsername"><i class="fas fa-user-tie"></i> Username</label>
        <input type="text" name="username" class="form-control input" id="InputUsername" aria-describedby="userName"
               placeholder="Enter Username" required>
    </div>
    <div class="form-group">
        <label class="label" for="InputFirstName">First name</label>
        <input type="text" name="firstName" class="form-control input" id="InputFirstName" aria-describedby="firstName"
               placeholder="Enter first Name" required>
    </div>
    <div class="form-group">
        <label class="label" for="InputLastName">Surname</label>
        <input type="text" name="lastName" class="form-control input" id="InputLastName" aria-describedby="lastName"
               placeholder="Enter last Name" required>
    </div>
    <div class="form-group">
        <label class="label" for="InputAge"><i class="fas fa-birthday-cake"></i> Age</label>
        <input type="date" name="age" class="form-control input" id="InputAge"
               aria-describedby="age"
               placeholder="Enter Age" required>
    </div>
    <div class="form-group">
        <label class="label" for="InputPassword"><i class="fas fa-key"></i> Password</label>
        <input type="password" name="pw" class="form-control input" id="InputPassword" placeholder="Enter Password"
               required>
        <small id="password" class="form-text text-muted">Please make sure that your password is at least 10 characters long!</small>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input check" name="check" id="Check" required>
        <label class="label-small form-check-label" for="Check">I agree with the <a
                    href="/Termsofuse">Terms of Use</a>!</label>
    </div>
    <label hidden>
        <input name="requestMode" value="add" hidden>
    </label>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
