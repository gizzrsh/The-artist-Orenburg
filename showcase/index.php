<?php $pageTitle = 'Витрина'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/header.php' ?>
<main class="main">
    <section class="categories">
        <div class="categories__inner container">
            <button class="categories__order">Заказать изготовление</button>
            <h1 class="categories__title title">Витрина работ</h1>
            <div class="categories__cards">
                <a href="/showcase/relief" class="categories__card">
                    <img class="categories__bg" src="/assets/img/showcase/relief.jpg" alt="Ботанический барельеф">
                    <h2 class="categories__name">Ботанический барельеф</h2>
                </a>
                <a href="/showcase/paiting" class="categories__card">
                    <img class="categories__bg" src="/assets/img/showcase/painting.jpg" alt="Живопись">
                    <h2 class="categories__name">Живопись</h2>
                </a>
                <a href="/showcase/interior" class="categories__card">
                    <img class="categories__bg" src="/assets/img/showcase/interior.jpg" alt="Интерьерные картины">
                    <h2 class="categories__name">Интерьерные картины</h2>
                </a>
                <a href="/showcase/mirrors" class="categories__card">
                    <img class="categories__bg" src="/assets/img/showcase/mirrors.jpg" alt="Зеркала">
                    <h2 class="categories__name">Зеркала</h2>
                </a>
            </div>
        </div>
    </section>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/footer.php' ?>
