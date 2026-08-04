<?php

require dirname(__DIR__) . '/config/init.php';
require dirname(__DIR__) . '/inc/functions.php';

if (!is_logged()) {
    redirect('/auth');
}

$stmt = Database::getConnection()->prepare('SELECT slug FROM roles WHERE id = :id');
$stmt->execute(['id' => $_SESSION['role_id']]);
$role = $stmt->fetch();
if (!$role || $role['slug'] !== 'admin') {
    redirect('/');
}

$artworks = $artworkRepo->findAll();
?>

<?php include dirname(__DIR__) . '/admin/inc/header.php' ?>
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
<?php include dirname(__DIR__) . '/admin/inc/footer.php' ?>