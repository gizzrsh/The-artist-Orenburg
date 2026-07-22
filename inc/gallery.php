<?php 
require dirname(__DIR__) . '/config/database.php';

$pageTitle = $title;

$pdo = new Database();
$sql = ('SELECT id, title, description, image FROM artworks WHERE category_id = :category_id AND is_published = 1');
$artworks = $pdo->prepare($sql, ['category_id' => $category_id]);
?>

<?php include dirname(__DIR__) . '/inc/header.php' ?>
<main class="main">
    <section class="gallery">
        <div class="gallery__inner container">
            <h1 class="gallery__title title">
                <?= htmlspecialchars($title) ?>
            </h1>
                <div class="gallery__cards">
                <?php foreach ($artworks as $artwork): ?>
                    <div class="gallery__card">
                        <img src="/<?= htmlspecialchars($artwork['image']) ?>" alt="<?= htmlspecialchars($artwork['title']) ?>" class="gallery__card-image" width="300" height="300" loading="lazy">
                        <h2 class="gallery__card-title">
                            <?= htmlspecialchars($artwork['title']) ?>
                        </h2>
                        <p class="gallery__card-desc">
                            <?= htmlspecialchars($artwork['description']) ?>
                        </p>
                        <?php if (empty($_SESSION['cart'][$artwork['id']])): ?>
                        <form class="gallery__card-form" action="<?php dirname(__DIR__) ?>/cart/add.php" method="post">
                            <input type="hidden" name="artwork_id" value="<?= htmlspecialchars((int)$artwork['id']) ?>">
                            <button type="submit" class="gallery__card-btn">Добавить в корзину</button>
                        </form>
                        <?php else: ?>
                        <div class="gallery__card-action">
                            <span>Товаров в корзине: <?= $_SESSION['cart'][$artwork['id']]['count'] ?></span>
                            <a href="<?php dirname(__DIR__) ?>/cart">Перейти в корзину</a>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                </div>
        </div>
    </section>
</main>
<?php include dirname(__DIR__) . '/inc/footer.php' ?>
