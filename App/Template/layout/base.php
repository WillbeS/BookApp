<?php /** @var string $templateName */ ?>
<?php /** @var \App\Data\Template\AppData $appData */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Online Book Database</title>

    <link rel="stylesheet"
          href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
          crossorigin="anonymous" />
    <link href="web/css/bootstrap.min.css" rel="stylesheet" />
    <link href="web/css/styles.css" rel="stylesheet" />
</head>

<body>

<?php require_once 'App/Template/partials/_header.php'; ?>

<div class="container main">

    <div class="row justify-content-md-center mt-3">
        <div class="col-md-9">
            <?php foreach ($appData->getSession()->getMessages() as $message): ?>
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <?= nl2br($message) ?>
                </div>
            <?php endforeach; ?>

            <?php foreach ($appData->getSession()->getErrors() as $error): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <?= nl2br($error) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php require_once $templateName; ?>

</div>

<script src="web/js/jquery.min.js"></script>
<script src="web/js/popper.min.js"></script>
<script src="web/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        let popoverBtn = $("[data-toggle=popover]");
        popoverBtn.click(function (event) {
            event.preventDefault();
        });
        popoverBtn
            .popover(
                {
                    placement: 'top',
                    html:true,
                    title: '<button type="button" class="close">&times;</button>'
                }
            );
    });
</script>
</body>
</html>