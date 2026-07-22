<?php $pageTitle = 'Корзина'; 

include dirname(__DIR__) . '/config/init.php';
include dirname(__DIR__) . '/config/database.php';
include dirname(__DIR__) . '/inc/functions.php';

if (!empty($_SESSION['cart'])) {

    $ids = array_keys($_SESSION['cart']);

}

if (empty($ids)) {

    $_SESSION['errors'] = 'Корзина пустая';

    $artworks = [];

} else {
    $placeholders = implode(',', array_fill(0 ,count($ids), '?'));

    $pdo = new Database;

    $artworks = $pdo->prepare(
        "SELECT * FROM artworks WHERE id IN ($placeholders)",
    $ids)->fetchAll();
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

        $_SESSION['cart'][$id]['count'] += 1;

        redirect($_SERVER['HTTP_REFERER'] ?? '/');

    } elseif (isset($_POST['remove'])) {

        $id = (int)$_POST['remove'];

        unset($_SESSION['cart'][$id]);
    
        redirect($_SERVER['HTTP_REFERER'] ?? '/');

    }

// dd($_SESSION['cart']);

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
                            <button class="count__decrease" type="submit" name="decrease" value="<?= $artwork['id'] ?>" aria-label="Уменьшить количество"></button>
                            <div class="count__value"><?= $_SESSION['cart'][$artwork['id']]['count'] ?></div>
                            <button class="count__increase" type="submit" name="increase" value="<?= $artwork['id'] ?>" aria-label="Увеличить количество"></button>
                        </form>
                        <form action="" method="post">
                            <button class="cart__item-remove" type="submit" name="remove" value="<?= $artwork['id'] ?>">Мусорка</button>
                        </form>
                        <div class="cart__item-price">$<?= htmlspecialchars($artwork['price']) ?></div>
                    </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?= htmlspecialchars($_SESSION['errors']) ?>
                <?php endif; ?>
            </ul>
        </div>
    </section>
</main>
<?php include dirname(__DIR__) . '/inc/footer.php'; ?>