<?php /** @var \App\Data\UserDTO $data */ ?>
<h2>Edit Profile</h2>
<form method="post">
    First name:
    <input type="text" name="first_name" value="<?= $data->getFirstName() ?>" /><br>
    Last name:
    <input type="text" name="last_name" value="<?= $data->getLastName() ?>" /><br>
    Email:
    <input type="email" name="email" value="<?= $data->getEmail() ?>" /><br>

    <input type="checkbox" name="change_password" value="0">Change password<br>

    <input type="submit" name="edit" value="Edit" />
</form>
