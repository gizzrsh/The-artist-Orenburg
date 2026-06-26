<?php $pageTitle = 'Личный кабинет';

require dirname(__DIR__) . '/config/database.php';
require dirname(__DIR__) . '/inc/functions.php';

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    redirect('/auth');
}

$pdo = new Database;
$stmt = $pdo->prepare(
    'SELECT slug FROM roles WHERE id = :id', 
    ['id' => $_SESSION['role_id']]);
$role = $stmt->fetch();
?>
<?php include dirname(__DIR__) . '/inc/header.php' ?>
<main class="main">
    <section class="dashboard">
        <div class="dashboard__inner container">
            <?php if ($role['slug'] == 'admin'): ?>
                <a href="/admin">Админ панель</a>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php include dirname(__DIR__) . '/inc/footer.php' ?>