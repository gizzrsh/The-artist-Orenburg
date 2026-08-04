<?php
$pageTitle = 'Заказ оформлен';

include dirname(__DIR__) . '/config/init.php';
include dirname(__DIR__) . '/inc/functions.php';

if (empty($_SESSION['success'])) {
    redirect('/');
}

$successMessage = $_SESSION['success'];
unset($_SESSION['success']);
?>
<?php include dirname(__DIR__) . '/inc/header.php' ?>
<main class="main">
    <section class="checkout-success">
        <div class="checkout-success__inner container">
            <div class="checkout-success__icon">
                <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48" viewBox="0 -960 960 960">
                    <path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/>
                </svg>
            </div>
            <h1 class="checkout-success__title title">Заявка принята</h1>
            <p class="checkout-success__text">
                <?= htmlspecialchars($successMessage) ?>
            </p>
            <div class="checkout-success__actions">
                <a href="/" class="btn">На главную</a>
                <a href="/showcase/" class="btn btn--accent">Посмотреть работы</a>
            </div>
        </div>
    </section>
</main>
<?php include dirname(__DIR__) . '/inc/footer.php' ?>