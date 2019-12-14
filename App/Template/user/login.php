<!--<div class="row justify-content-md-center mt-3">-->
<!--    <div class="col-md-9">-->
<!--    </div>-->
<!--</div>-->
<!---->
<!--<div class="jumbotron text-center">-->
<!--    <div class="row justify-content-md-center" id="login">-->
<!--        <div class="col-sm-6 col-sm-offset-3 border border-primary p-3 pl-5 pr-5">-->
<!--            <p class="h3 mb-3">Register</p>-->
<!--            <form name="appbundle_user" method="post" novalidate="novalidate">-->
<!--                <div id="appbundle_user"><div class="form-group"><label for="appbundle_user_firstName" class="required">First name</label><input type="text" id="appbundle_user_firstName" name="appbundle_user[firstName]" required="required" maxlength="60" class="form-control" /></div><div class="form-group"><label for="appbundle_user_lastName" class="required">Last name</label><input type="text" id="appbundle_user_lastName" name="appbundle_user[lastName]" required="required" maxlength="60" class="form-control" /></div><div class="form-group"><label for="appbundle_user_email" class="required">Email</label><input type="email" id="appbundle_user_email" name="appbundle_user[email]" required="required" class="form-control" /></div><div class="form-group"><label for="appbundle_user_password_first" class="required">Password</label><input type="password" id="appbundle_user_password_first" name="appbundle_user[password][first]" required="required" class="password-field form-control" /></div><div class="form-group"><label for="appbundle_user_password_second" class="required">Repeat Password</label><input type="password" id="appbundle_user_password_second" name="appbundle_user[password][second]" required="required" class="password-field form-control" /></div><input type="hidden" id="appbundle_user__token" name="appbundle_user[_token]" value="_TZxLVtsW6hvkd0_6BtM1MYED_iC217MvMfL1vOs57w" /></div>-->
<!---->
<!--                <div class="row justify-content-md-center">-->
<!--                    <button type="submit" class="btn btn-primary" formnovalidate>Register</button>-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--<p class="text-center">If you already have an account: <a href="/login">Login</a> from here!</p>-->



<h2>Login</h2>
<form method="post">
    Email:
    <input type="email" name="email" /><br>
    Password:
    <input type="password" name="password" /><br>

    <input type="submit" name="login" value="Login" />
</form>