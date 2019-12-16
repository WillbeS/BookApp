<?php /** @var \App\Data\UserDTO $contentData */ ?>
<div class="jumbotron text-center">
    <div class="row justify-content-md-center" id="login">
        <div class="col-sm-6 col-sm-offset-3 border border-primary p-3 pl-5 pr-5">
            <p class="h3 mb-3">Register</p>
            <form method="post">
                <div class="form-group">
                    <label for="first_name" class="required">First name</label>
                    <input type="text" id="first_name" name="first_name" required="required" class="form-control"
                           value="<?= $contentData->getFirstName() ?>" />
                </div>

                <div class="form-group">
                    <label for="last_name" class="required">Last name</label>
                    <input type="text" id="last_name" name="last_name" required="required" class="form-control"
                           value="<?= $contentData->getLastName() ?>" />
                </div>

                <div class="form-group">
                    <label for="email" class="required">Email</label>
                    <input type="email" id="email" name="email" required="required" class="form-control"
                           value="<?= $contentData->getEmail() ?>" />
                </div>

                <div class="form-group">
                    <label for="password" class="required">Password</label>
                    <input type="password" id="password" name="password" required="required" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="confirm_password" class="required">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required="required" class="form-control" />
                </div>

                <div class="row justify-content-md-center">
                    <button type="submit" class="btn btn-primary" name="register">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
<p class="text-center">If you already have an account: <a href="login.php">Login</a> from here!</p>