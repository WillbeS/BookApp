<?php /** @var \App\Data\Template\BookDetailsData $contentData */ ?>
<?php /** @var \App\Data\Template\AppData $appData */ ?>

<div class="row">
    <div class="col-sm-4">
        <div class="card mr-3 mb-3 p-3">
            <div class="card-body">
                <img class="img-fluid" src="<?= $contentData->getBook()->getImage() ?>" />
            </div>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="card mr-3 mb-3 p-3">
            <h3 class="h5 text-center">Book Details</h3>
            <div class="card-body">
                <table class="table table-responsive">
                    <tr>
                        <th>Title:</th>
                        <td><?= $contentData->getBook()->getName() ?></td>
                    </tr>
                    <tr>
                        <th>ISBN:</th>
                        <td><?= $contentData->getBook()->getIsbn() ?></td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td><?= nl2br($contentData->getBook()->getDescription()) ?></td>
                    </tr>
                </table>
            </div>
            <?php if ($appData->getSession()->getUserId()): ?>
                <div class="card-footer mt-2">
                    <?php if ($appData->isAdmin()): ?>
                        <a href="#"
                           class="btn btn-outline-danger btn-sm float-right ml-2"
                           data-toggle="popover"
                           data-trigger="focus"
                           data-content="Are you sure you want to delete this book? <div class='text-center'><a  href='delete-book.php?id=<?= $contentData->getBook()->getId() ?>'>Delete!</a></div>">
                            Delete
                        </a>
                        <a class="btn btn-outline-info btn-sm float-right ml-5" href="edit-book.php?id=<?= $contentData->getBook()->getId() ?>">Edit</a>
                    <?php endif; ?>
                    <?php if ($contentData->isInCurrentUserCollection()): ?>
                        <a class="btn btn-outline-danger btn-sm float-right" href="remove-from-favorites.php?id=<?= $contentData->getBook()->getId() ?>">Remove from My Books</a>
                    <?php else: ?>
                        <a class="btn btn-outline-info btn-sm float-right" href="add-to-favorites.php?id=<?= $contentData->getBook()->getId() ?>">Add to My Books</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

