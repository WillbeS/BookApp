<?php /** @var \App\Data\BookDTO[] $contentData */ ?>
<?php /** @var \App\Data\Template\AppData $appData */ ?>

<h1 class="mb-3">Books App</h1>
<div class="row">
    <?php foreach ($contentData as $book): ?>
        <div class="col-sm-3">
            <div class="card mr-3 mb-3 p-3">
                <h3 class="h5"><?= $book->getName() ?></h3>
                <div class="card-body">
                    <img class="img-fluid" src="<?= $book->getImage() ?>" />
                </div>
                <?php if ($appData->isAdmin()): ?>
                    <div class="card-footer =">
                        <a href="#"
                           class="btn btn-outline-danger btn-sm float-right ml-2"
                           data-toggle="popover"
                           data-trigger="focus"
                           data-content="Are you sure you want to delete this book? <div class='text-center'><a  href='delete-book.php?id=<?= $book->getId() ?>'>Delete!</a></div>">
                            Delete
                        </a>
                        <a class="btn btn-outline-info btn-sm float-right" href="edit-book.php?id=<?= $book->getId() ?>">Edit</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

