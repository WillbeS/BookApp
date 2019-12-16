<?php /** @var \App\Data\UserDTO $contentData */ ?>
<div class="jumbotron text-center">
    <div class="row justify-content-md-center" id="login">
        <div class="col-sm-6 col-sm-offset-3 border border-primary p-3 pl-5 pr-5">
            <p class="h3 mb-3">Login</p>
            <form method="post">
                <div class="form-group">
                    <label for="email" class="required">Email</label>
                    <input type="email" id="email" name="email" required="required" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="password" class="required">Password</label>
                    <input type="password" id="password" name="password" required="required" class="form-control" />
                </div>

                <div class="row justify-content-md-center">
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<p class="text-center">If you don't have an account: <a href="register.php">Register</a> from here!</p>