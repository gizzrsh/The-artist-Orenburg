<?php $pageTitle = 'Личный кабинет';

require dirname(__DIR__) . '/inc/functions.php';
require dirname(__DIR__) . '/config/database.php';
include dirname(__DIR__) . '/config/mail.php';
include dirname(__DIR__) . '/config/init.php';

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    redirect('/auth');
}

$pdo = new Database;
$email = $pdo->prepare('SELECT email_verified FROM users WHERE id = :id', ['id' => $_SESSION['user_id']])->fetch();
$stmt = $pdo->prepare(
    'SELECT slug FROM roles WHERE id = :id', 
    ['id' => $_SESSION['role_id']]);
$role = $stmt->fetch();
?>

<?php include dirname(__DIR__) . '/inc/header.php' ?>
<main class="main">
    <section class="dashboard">
        <div class="dashboard__inner">
            <?php if ($email['email_verified'] !== 1): ?>
                <div class="dashboard__email-verified">
                    <a class="dashboard__link" href="/dashboard/verify-email.php">Необходимо подтвердить почту</a>
                </div>
            <?php endif; ?>
        
            <?php if (!empty($_SESSION['success'])): ?>
                <span class="form-success"><?= htmlspecialchars($_SESSION['success']) ?></span>
                <?php unset($_SESSION['success']) ?>
            <?php endif; ?>
        
            <?php if ($role['slug'] == 'admin'): ?>
                <a href="/admin">Админ панель</a>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php include dirname(__DIR__) . '/inc/footer.php' ?>