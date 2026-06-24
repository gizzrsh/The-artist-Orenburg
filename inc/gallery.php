<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$pageTitle = $title;

$pdo = new Database();
$sql = ('SELECT title, description, image FROM artworks WHERE category_id = :category_id and is_published = 1');
$artworks = $pdo->prepare($sql, ['category_id' => $category_id]);
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/header.php' ?>
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
                        <button class="gallery__card-btn">Узнать цену</button>
                    </div>
                <?php endforeach; ?>
                </div>
        </div>
    </section>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/footer.php' ?>
