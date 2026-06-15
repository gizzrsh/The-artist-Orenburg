<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Витрина</title>
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/css/normalize.css">
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/header.php' ?>
    <main class="main">
        <section class="categories">
            <div class="categories__inner container">
                <button class="categories__order">Заказть изготовление</button>
                <h1 class="categories__title title">Витрина работ</h1>
                <div class="categories__cards">
                    <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/showcase/relief" class="categories__card">
                        <img class="categories__bg" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/img/showcase/relief.jpg" alt="Ботанический барельеф" aria-label="Категория Ботанический Барельеф">
                        <h2 class="categories__name">Ботанический барельеф</h2>
                    </a>
                    <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/showcase/paiting" class="categories__card">
                        <img class="categories__bg" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/img/showcase/painting.jpg" alt="Живопись" aria-label="Категория Живопись">
                        <h2 class="categories__name">Живопись</h2>
                    </a>
                    <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/showcase/interior" class="categories__card">
                        <img class="categories__bg" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/img/showcase/interior.jpg" alt="Интерьерные картины" aria-label="Категория Интерьерные Картины">
                        <h2 class="categories__name">Интерьерные картины</h2>
                    </a>
                    <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/showcase/mirrors" class="categories__card">
                        <img class="categories__bg" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/img/showcase/mirrors.jpg" alt="Зеркала" aria-label="Категория Зеркала">
                        <h2 class="categories__name">Зеркала</h2>
                    </a>
                </div>
            </div>
        </section>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/footer.php' ?>
</body>
</html>