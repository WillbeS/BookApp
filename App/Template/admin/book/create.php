<?php /** @var \App\Data\BookDTO $contentData */ ?>
<div class="jumbotron text-center">
    <div class="row justify-content-md-center">
        <div class="col-sm-8 col-sm-offset-2 border border-primary p-3 pl-5 pr-5">
            <p class="h3 mb-3">Create Book</p>
            <form method="post" novalidate="novalidate">
                <div class="form-group">
                    <label for="name" class="required">Name</label>
                    <input type="text" id="name" name="name" required="required" class="form-control"
                           value="<?= $contentData->getName() ?>" />
                </div>

                <div class="form-group">
                    <label for="isbn" class="required">ISBN</label>
                    <input type="text" id="isbn" name="isbn" required="required" class="form-control"
                           value="<?= $contentData->getIsbn() ?>" />
                </div>

                <div class="form-group">
                    <label for="description" class="required">Description</label>
                    <textarea id="description" name="description" required="required" class="form-control" rows="3"><?= $contentData->getDescription() ?></textarea>
                </div>

                <div class="form-group">
                    <label for="image" class="required">Image Url</label>
                    <input type="text" id="image" name="image" required="required" class="form-control"
                           value="<?= $contentData->getImage() ?>" />
                </div>

                <div class="row justify-content-md-center">
                    <button type="submit" class="btn btn-primary" name="create">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<p class="text-center">If you don't have an account: <a href="register.php">Register</a> from here!</p>