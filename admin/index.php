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
                                <a href="/admin/artwork.php?id=<?= htmlspecialchars($artwork['id']) ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#00000"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                </a>
                                <a href="/admin/delete.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#00000"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
<?php include dirname(__DIR__) . '/admin/inc/footer.php' ?>