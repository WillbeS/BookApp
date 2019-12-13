<?php /** @var \App\Data\UserDTO $data */ ?>

<h2>Register</h2>
<form method="post">
    First name:
    <input type="text" name="first_name" value="<?= $data->getFirstName() ?>" /><br>
    Last name:
    <input type="text" name="last_name" value="<?= $data->getLastName() ?>" /><br>
    Email:
    <input type="email" name="email" value="<?= $data->getEmail() ?>" /><br>
    Password:
    <input type="password" name="password" /><br>
    Confirm password:
    <input type="password" name="confirm_password" /><br>

    <input type="submit" name="register" value="Register" />
</form>
