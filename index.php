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
                <div style="position:relative;overflow:hidden; width: 100%;">
                    <iframe 
                        src="https://yandex.ru/map-widget/v1/?mode=search&ol=biz&oid=22075455217&ll=55.109298%2C51.772357&z=18.57&utm_source=maps&show=card" 
                        width="100%" 
                        height="450" 
                        frameborder="0" 
                        allowfullscreen="true"
                        style="display: block;"
                        title="Yandex Map">
                    </iframe>
                </div>  
            </div>
        </section>
    </main>
    <?php include './inc/footer.php'; ?>
</body>
</html>