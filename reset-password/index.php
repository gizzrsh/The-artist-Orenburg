<?php session_start(); $pageTitle = 'Сброс пароля'; ?> 
<?php include dirname(__DIR__) . '/inc/header.php' ?>
<main class="main">
    <section class="reset-form">
        <div class="reset-form__inner container">
            <div class="reset-form__tabs">
                <button id="auth-tab" class="reset-form__tab" data-tab="login">Восстановление пароля</button>
            </div>
            <div class="form-panel-reset">
                <form action="/reset-password/reset-password.php" method="post">
                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <input type="email" id="email" name="email" required autocomplete="email" placeholder="example@mail.ru">

                        <?php if (!empty($_SESSION['errors']['user'])): ?>
                            <span class="form-error"><?= htmlspecialchars($_SESSION['errors']['user']) ?></span>
                            <span class="form-error"><?= htmlspecialchars($_SESSION['errors']['email']) ?></span>
                        <?php endif; ?>
                        <?php if (!empty($_SESSION['success'])): ?>
                            <span class="form-success"><?= htmlspecialchars($_SESSION['success']) ?></span>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn-submit">Сбросить пароль</button>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include dirname(__DIR__) . '/inc/footer.php' ?>
<?php unset($_SESSION['errors'], $_SESSION['success']); ?>