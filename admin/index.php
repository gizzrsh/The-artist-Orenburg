<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/inc/functions.php';
require $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$sql = ('SELECT id, category_id, title, image, is_published FROM artworks');
$stmt = $pdo->query($sql);
$artworks = $stmt->fetchAll();
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/header.php' ?>
<main class="main">
    <section class="table">
        <div class="table__inner container">
            <table class="table__crud" style="width: 100%;">
                <thead>
                    <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Active</th>
                    <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($artworks as $artwork): ?>
                        <tr> 
                            <td><?= htmlspecialchars($artwork['title']) ?></td>
                            <td><?= htmlspecialchars($artwork['category_id']) ?></td>
                            <td><?= ($artwork['is_published'] === 1) ? "in stock" : "not available" ?></td>
                            <td><?= ($artwork['is_published'] === 1) ? "active" : "not active" ?></td>
                            <td>
                                <a href="/admin/edit.php">🖌️</a>
                                <a href="/admin/delete.php">🗑️</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/footer.php' ?>