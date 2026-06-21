<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Портфолио художницы из Оренбурга">
    <link rel="stylesheet" href="/assets/css/normalize.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title><?= $pageTitle ?? 'Анна Хитрая - Оренбургская художница' ?></title>
    <link rel="icon" href="/favicon.ico">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="apple-touch-icon" href="/assets/img/favicons/apple-touch-icon.png">
    <script src="/assets/js/script.js" defer></script>
</head>
<body>
    <header class="header">
        <div class="header__inner container">
            <a href="/" class="header__logo">Анна Хитрая</a>

            <button class="header__burger burger visible-mobile" aria-label="Открыть меню">
                <span class="burger__line"></span>
                <span class="burger__line"></span>
                <span class="burger__line"></span>
            </button>

            <nav class="header__menu">
                <ul class="header__menu-list">
                    <li class="header__menu-item">
                        <a href="/" class="header__menu-link">Главная</a>
                    </li>
                    <li class="header__menu-item">
                        <a href="/showcase/" class="header__menu-link">Посмотреть работы</a>
                    </li>
                    <li class="header__menu-item">
                        <span href="/education/" class="header__menu-link">Обучение</span>
                    </li>
                    <li class="header__menu-item">
                        <span href="/events/" class="header__menu-link">Мероприятия</span>
                    </li>
                </ul>
            </nav>
            <a href="/auth" class="header__login" aria-label="Войти в личный кабинет">
                <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32"><path d="M480.67-120v-66.67h292.66v-586.66H480.67V-840h292.66q27 0 46.84 19.83Q840-800.33 840-773.33v586.66q0 27-19.83 46.84Q800.33-120 773.33-120H480.67Zm-63.34-176.67-47-48 102-102H120v-66.66h351l-102-102 47-48 184 184-182.67 182.66Z"/></svg>
            </a>
            <a href="/cart" class="header__cart" aria-label="Корзина">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g><path d="M9 20a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2M3.495 2.631l.105.07 1.708 1.28a2 2 0 0 1 .653.848l.06.171h12.846a2 2 0 0 1 1.998 2.1l-.013.148-.457 3.655a5 5 0 0 1-4.32 4.34l-.226.023-7.313.61.26 1.124H17.5a1 1 0 0 1 .117 1.993L17.5 19H8.796a2 2 0 0 1-1.906-1.393l-.043-.157-2.74-11.87L2.4 4.3a1 1 0 0 1 .985-1.723zM18.867 7H6.487l1.595 6.906 7.6-.633a3 3 0 0 0 2.728-2.617z"></path></g></svg>
            </a>
        </div>
    </header>