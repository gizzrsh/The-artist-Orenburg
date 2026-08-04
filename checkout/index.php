<?php
$pageTitle = 'Оформление заказа';

include dirname(__DIR__) . '/config/init.php';
include dirname(__DIR__) . '/config/csrf_token.php';
include dirname(__DIR__) . '/inc/functions.php';


if (empty($_SESSION['cart'])) {

    redirect('/cart');

}

$ids = array_keys($_SESSION['cart']);

$placeholders = implode(',', array_fill(0, count($ids), '?'));

$stmt = Database::getConnection()->prepare("SELECT * FROM artworks WHERE id IN ($placeholders) AND is_published = 1");

$stmt->execute($ids);

$artworks = $stmt->fetchAll();

$total = 0;

foreach ($artworks as $artwork) {

    $total += $artwork['price'] * $_SESSION['cart'][$artwork['id']]['count'];

}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    CsrfTokenCheck();

    if (is_logged()) {
        $user = $userRepo->findById($_SESSION['user_id']);
    }

}

?>
<?php include dirname(__DIR__) . '/inc/header.php' ?>
<main class="main">
    <section class="checkout">
        <div class="checkout__inner container">
            <h1 class="title">Оформление заказа</h1>

            <div class="checkout__layout">
                <form class="checkout__form" method="post" action="">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" id="name" name="name" required placeholder="Иван Иванов" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                        <?php if (!empty($errors['name'])): ?><span class="form-error"><?= htmlspecialchars($errors['name']) ?></span><?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="tel" id="phone" name="phone" required placeholder="+7 900 000-00-00" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                        <?php if (!empty($errors['phone'])): ?><span class="form-error"><?= htmlspecialchars($errors['phone']) ?></span><?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Email (необязательно)</label>
                        <input type="email" id="email" name="email" placeholder="example@mail.ru" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>Способ получения</label>
                        <div class="delivery-toggle" data-delivery-toggle>
                            <label class="delivery-toggle__option">
                                <input type="radio" name="delivery_type" value="pickup" <?= (($_POST['delivery_type'] ?? '') === 'pickup') ? 'checked' : '' ?>>
                                <span>Самовывоз</span>
                            </label>
                            <label class="delivery-toggle__option">
                                <input type="radio" name="delivery_type" value="delivery" <?= (($_POST['delivery_type'] ?? '') === 'delivery') ? 'checked' : '' ?>>
                                <span>Доставка</span>
                            </label>
                        </div>
                        <?php if (!empty($errors['delivery_type'])): ?><span class="form-error"><?= htmlspecialchars($errors['delivery_type']) ?></span><?php endif; ?>
                    </div>

                    <div class="form-group checkout__address" data-address-field <?= (($_POST['delivery_type'] ?? '') !== 'delivery') ? 'hidden' : '' ?>>
                        <label for="address">Адрес доставки</label>
                        <input type="text" id="address" name="address" placeholder="г. Оренбург, ул. ..." value="<?= htmlspecialchars($_POST['address'] ?? '') ?>">
                        <?php if (!empty($errors['address'])): ?><span class="form-error"><?= htmlspecialchars($errors['address']) ?></span><?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="comment">Комментарий к заказу (необязательно)</label>
                        <input type="text" id="comment" name="comment" placeholder="Пожелания к заказу" value="<?= htmlspecialchars($_POST['comment'] ?? '') ?>">
                    </div>

                    <button type="submit" class="btn-submit">Отправить заявку</button>
                </form>

                <aside class="checkout__summary">
                    <h2 class="checkout__summary-title">Ваш заказ</h2>
                    <ul class="checkout__summary-list">
                        <?php foreach ($artworks as $artwork): ?>
                            <?php $qty = $_SESSION['cart'][$artwork['id']]['count']; ?>
                            <li class="checkout__summary-item">
                                <img src="/<?= htmlspecialchars($artwork['image']) ?>" alt="<?= htmlspecialchars($artwork['title']) ?>" class="checkout__summary-image">
                                <div class="checkout__summary-info">
                                    <span class="checkout__summary-name"><?= htmlspecialchars($artwork['title']) ?></span>
                                    <span class="checkout__summary-qty">× <?= $qty ?></span>
                                </div>
                                <span class="checkout__summary-price"><?= number_format($artwork['price'] * $qty, 0, '', ' ') ?> $</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="checkout__summary-total">
                        <span>Итого</span>
                        <strong><?= number_format($total, 0, '', ' ') ?> ₽</strong>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>
<?php include dirname(__DIR__) . '/inc/footer.php' ?>