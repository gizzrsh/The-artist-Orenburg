<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/inc/functions.php';
require $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$sql = ('SELECT * FROM artworks WHERE category_id = :category_id');
$stmt = $pdo->prepare($sql);
$stmt->execute(['category_id' => $category_id]);
$artworks = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/normalize.css">
</head>
<body>
    <?php incFile('/inc/header.php') ?>
    <main class="main">
        <section class="gallery">
            <div class="gallery__inner container">
                <h1 class="gallery__title title">
                    <?= $title ?>
                </h1>
                <!-- Здесь будет карточки с товарами выгруженные из Базы данных по определенным категориями -->
                 <div class="gallery__cards">
                    <?php foreach ($artworks as $artwork): ?>
                        <div class="gallery__card">
                            <img src="/<?= htmlspecialchars($artwork['image']) ?>" alt="" class="gallery__card-image" width="auto" height="300">
                            <h2 class="gallery__card-title">
                                <?= htmlspecialchars($artwork['title']) ?>
                            </h2>
                            <p class="gallery__card-desc">
                                <?= htmlspecialchars($artwork['description']) ?>
                            </p>
                            <button class="gallery__card-btn">Узнать стоимость</button>
                        </div>
                    <?php endforeach; ?>
                 </div>
            </div>
        </section>
    </main>
    <?php incFile('/inc/footer.php') ?>
</body>
</html>