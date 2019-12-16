<?php /** @var \App\Data\UserDTO $contentData */ ?>
<div class="jumbotron text-center">
    <div class="row justify-content-md-center mb-4">
        <div class="col-sm-6 col-sm-offset-3 border border-primary p-3 pl-5 pr-5">
            <p class="h3 mb-3">Edit Profile</p>
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

                <div class="row justify-content-md-center">
                    <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                </div>
            </form>
        </div>
    </div>

    <hr />

    <div class="row justify-content-md-center">
        <div class="col-sm-6 col-sm-offset-3 border border-primary p-3 pl-5 pr-5">
            <p class="h3 mb-3">Change Password</p>
            <form method="post">
                <div class="form-group">
                    <label for="old_password" class="required">Old Password</label>
                    <input type="password" id="old_password" name="old_password" required="required" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="new_password" class="required">New Password</label>
                    <input type="password" id="new_password" name="new_password" required="required" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="confirm_new_password" class="required">Confirm New Password</label>
                    <input type="password" id="confirm_new_password" name="confirm_new_password" required="required" class="form-control" />
                </div>

                <div class="row justify-content-md-center">
                    <button type="submit" class="btn btn-primary" name="change_password">Change</button>
                </div>
            </form>
        </div>
    </div>
</div>