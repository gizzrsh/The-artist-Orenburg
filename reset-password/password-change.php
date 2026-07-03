<?php 
$pageTitle = 'Новый пароль'; 
session_start(); 

include dirname(__DIR__) . '/inc/functions.php';
include dirname(__DIR__) . '/config/database.php';

$errors = [];

// if post true
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get token
    $token = $_GET['token'];
    // get password and password confirm
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // validate password
    if (!validatePassword($password)) {
        $errors['password'] = 'Пароль должен быть от 8 символов, содержать строчные и заглавные буквы, цифру и спецсимвол (!@#$%...)';
    } elseif ($password !== $password_confirm) {
        $errors['password'] = 'Пароли должны совпадать друг с другом.';
    }

    // display errors and redirect to the same page
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        redirect($_SERVER['REQUEST_URI']);
    }

    // query a database
    $pdo = new Database;
    $sql = 'UPDATE users
            SET password = :password, token = NULL, token_expired = NULL
            WHERE token = :token AND token_expired > NOW()';
    $stmt = $pdo->prepare($sql, [':password' => password_hash($password, PASSWORD_DEFAULT), ':token' => $token]);

    // check has changed count row a database or not
    if ($stmt->rowCount() >= 1) {
        // display success message
        $_SESSION['success'] = 'Пароль успешно обновлен.';
        redirect($_SERVER['REQUEST_URI']);
    } else {
        // display error message
        $_SESSION['errors']['token_expired'] = 'Срок действия токена истек.';
        redirect($_SERVER['REQUEST_URI']);
    } 
}
?> 
<?php include dirname(__DIR__) . '/inc/header.php' ?>
<main class="main">
    <section class="reset-form">
        <div class="reset-form__inner container">
            <div class="reset-form__tabs">
                <button id="auth-tab" class="reset-form__tab" data-tab="login">Новый пароль</button>
            </div>
            <div class="form-panel-reset">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" id="password" name="password" required placeholder="**********">
                    </div>
                    <div class="form-group">
                        <label for="password">Подтвердите пароль</label>
                        <input type="password" id="password_confirm" name="password_confirm" required placeholder="**********">
                    </div>
                    <?php if (!empty($_SESSION['success'])): ?>
                        <span class="form-success"><?= htmlspecialchars($_SESSION['success']) ?></span>
                    <?php endif; ?>
                    <?php if (!empty($_SESSION['errors']['password'])): ?>
                        <span class="form-error"><?= htmlspecialchars($_SESSION['errors']['password']) ?></span>
                    <?php elseif (!empty($_SESSION['errors']['token_expired'])): ?>
                        <span class="form-error"><?= htmlspecialchars($_SESSION['errors']['token_expired']) ?></span>
                    <?php endif; ?>
                    <button type="submit" class="btn-submit">Обновить пароль</button>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include dirname(__DIR__) . '/inc/footer.php' ?>
<?php unset($_SESSION['errors'], $_SESSION['success']); ?>