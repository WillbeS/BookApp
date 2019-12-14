<?php /** @var string $templateName */ ?>
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

<!--    Flash messages-->
<!--    <div class="row justify-content-md-center mt-3">-->
<!--        <div class="col-md-9">-->
<!--        </div>-->
<!--    </div>-->

<!--    --><?php //$partialName = 'index.php' ?>
<!---->
<!---->

    <?php require_once $templateName; ?>

</div>

<script src="web/js/jquery.min.js"></script>
<script src="web/js/popper.min.js"></script>
<script src="web/js/bootstrap.min.js"></script>
</body>
</html>