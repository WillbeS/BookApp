<?php /** @var \App\Data\BookDTO[] $contentData */ ?>
<?php /** @var \App\Data\Template\AppData $appData */ ?>

<h1 class="mb-3">My Book Collection</h1>
<div class="row">
    <?php foreach ($contentData as $book): ?>
        <div class="col-sm-3">
            <div class="card mr-3 mb-3 p-3">
                <a href="book.php?id=<?= $book->getId() ?>" title="<?= $book->getName() ?>">
                    <h3 class="h5 text-center"><?= $book->getName() ?></h3>
                </a>
                <div class="card-body">
                    <a href="book.php?id=<?= $book->getId() ?>" title="<?= $book->getName() ?>">
                        <img class="img-fluid" src="<?= $book->getImage() ?>" />
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>