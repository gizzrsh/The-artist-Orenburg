<?php include 'functions.php' ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/css/normalize.css">
</head>
<body>
    <?php incFile('/inc/header.php') ?>
    <main class="main">
        <section class="gallery">
            <div class="gallery__inner container">
                <h1 class="gallery__title">
                    <?= $title ?>
                </h1>
            </div>
        </section>
    </main>
    <?php incFile('/inc/footer.php') ?>
</body>
</html>