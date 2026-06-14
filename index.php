<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/normalize.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Анна Хитрая - Оренбургская художница</title>
    <link rel="icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="./img/favicons/apple.png">
    <link rel="manifest" href="site.webmanifest">
    <script src="./assets/js/script.js"></script>
</head>
<body>
    <?php include './inc/header.php' ?>
    <main class="main">
        <section class="hero">
            <div class="hero__inner container">
                <h1 class="hero__title title">Немного о себе</h1>
                <div class="hero__block">
                    <img class="hero__img" src="./assets/img/author.png" alt="Изображение Анны Хитрой" width="488" height="458">
                    <div class="hero__content">
                        <h2 class="hero__about">О художнике</h2>
                        <p class="hero__biography">
                            Анна Александровна Хитрая (род. в 1983 году) - оренбургская художница. В 2001 году окончила отделение графического дизайна Оренбургского художественного училища. Ольга создаёт интерьерные картины с использованием масляных или акриловых красок и гипсовые панно
                        </p>
                        <p class="hero__biography">
                            Анна - постоянная участница ярмарок, конкурсов и выставок. Её панно преобразили дома многих оренбуржцев. Каждый барельеф художницы уникален и неповторим как застывшее мгновение лета
                        </p>
                        <div class="hero__actions">
                            <a href="#" class="hero__action btn">Витрина</a>
                            <a href="#" class="hero__action btn">Мероприятия</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="map">
            <div class="map__inner container">
                <div style="position:relative;overflow:hidden;">
                    <a href="https://yandex.ru/maps/org/masterskaya_ya/22075455217/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Мастерская Я</a>
                    <a href="https://yandex.ru/maps/48/orenburg/category/art_workshop/184105850/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:14px;">Художественная мастерская в Оренбурге</a>
                    <iframe src="https://yandex.ru/map-widget/v1/?ll=55.108822%2C51.772390&mode=search&oid=22075455217&ol=biz&z=16.59&show=card" width="100%" height="400" frameborder="1" allowfullscreen="true" style="position:relative;">
                    </iframe>
                </div>
            </div>
        </section>
    </main>
    <?php include './inc/footer.php'; ?>
</body>
</html>