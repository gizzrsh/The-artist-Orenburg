<?php $pageTitle = 'Корзина'; 

include dirname(__DIR__) . '/config/init.php';
include dirname(__DIR__) . '/config/csrf_token.php';
include dirname(__DIR__) . '/inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CsrfTokenCheck();
}

if (!empty($_SESSION['cart'])) {

    $ids = array_keys($_SESSION['cart']);

}

if (empty($ids)) {

    $_SESSION['errors'] = 'Корзина пустая';

    $artworks = [];

} else {
    $placeholders = implode(',', array_fill(0 ,count($ids), '?'));

    $stmt = Database::getConnection()->prepare("SELECT * FROM artworks WHERE id IN ($placeholders) AND is_published = 1");

    $stmt->execute($ids);

    $artworks = $stmt->fetchAll();
}

$total = 0;

if (!empty($artworks)) {

    foreach ($artworks as $artwork) {

        $total += $artwork['price'] * $_SESSION['cart'][$artwork['id']]['count'];

    }
    
}

if (isset($_POST['decrease'])) {
    
    $id = (int)$_POST['decrease'];

    if ($_SESSION['cart'][$id]['count'] === 1) {
        
        unset($_SESSION['cart'][$id]);
    
    } else {

        $_SESSION['cart'][$id]['count'] -= 1;
    
    }

    redirect($_SERVER['HTTP_REFERER'] ?? '/');

} elseif (isset($_POST['increase'])) {

    $id = (int)$_POST['increase'];

    $artwork = $artworkRepo->findById($id);

    if ($_SESSION['cart'][$id]['count'] < $artwork['quantity']) {

        $_SESSION['cart'][$id]['count'] += 1;

    }

    redirect($_SERVER['HTTP_REFERER'] ?? '/');

} elseif (isset($_POST['remove'])) {

    $id = (int)$_POST['remove'];

    unset($_SESSION['cart'][$id]);

    redirect($_SERVER['HTTP_REFERER'] ?? '/');

}

?>

<?php include dirname(__DIR__) . '/inc/header.php' ?>
<main class="main">
    <section class="cart">
        <div class="container">
            <h1 class="cart__title">
                Моя корзина
            </h1>
            <ul class="cart__list">
                <?php if (isset($ids)): ?>
                    <?php foreach ($artworks as $artwork): ?>
                    <li class="cart__item">
                        <img src="/<?= htmlspecialchars($artwork['image']) ?>" alt="Товар 1" class="cart__item-image">
                        <h2 class="cart__item-title"><?= htmlspecialchars($artwork['title']) ?></h2>
                        <form class="count" action="" method="post">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?>">
                            <button class="count__decrease" type="submit" name="decrease" value="<?= $artwork['id'] ?>" aria-label="Уменьшить количество"></button>
                            <div class="count__value"><?= $_SESSION['cart'][$artwork['id']]['count'] ?></div>
                            <button class="count__increase" type="submit" name="increase" value="<?= $artwork['id'] ?>" aria-label="Увеличить количество"></button>
                        </form>
                        <form action="" method="post">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?>">
                            <button class="cart__item-remove" type="submit" name="remove" value="<?= $artwork['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#00000"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                            </button>
                        </form>
                        <div class="cart__item-price">$<?= htmlspecialchars($artwork['price'] * $_SESSION['cart'][$artwork['id']]['count']) ?></div>
                    </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?= htmlspecialchars($_SESSION['errors']) ?>
                <?php endif; ?>
            </ul>
            <?php if (!empty($artworks)): ?>
                <div class="cart__summary">
                    <div class="cart__total">
                        <span>Итого:</span>
                        <strong><?= number_format($total, 0, '', ' ') ?> ₽</strong>
                    </div>
                    <a href="/checkout" class="btn cart__checkout-btn">Оформить заказ</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php include dirname(__DIR__) . '/inc/footer.php'; ?>