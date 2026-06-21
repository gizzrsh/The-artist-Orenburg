<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/header.php' ?>
    <main class="main">
        <section class="auth">
            <div class="auth__inner container">
                <div class="auth__tabs">
                    <button id="auth-tab" class="auth__tab" data-tab="login">Вход</button>
                    <button id="register-tab" class="auth__tab" data-tab="register">Регистрация</button>
                </div>
                <div class="form-panel" id="login" data-panel="login">
                    <form action="/auth/handler/authHandler.php" method="POST">
                        <div class="form-group">
                            <label for="login-email">Email</label>
                            <input type="email" id="login-email" name="email" required autocomplete="email" placeholder="example@mail.ru">
                        </div>
                        <div class="form-group">
                            <label for="login-password">Пароль</label>
                            <input type="password" id="login-password" name="password" required autocomplete="current-password" placeholder="••••••••">
                        </div>
                        <button type="submit" class="btn-submit">Войти</button>
                    </form>
                    <div class="form-footer">
                        <a href="/reset-password">Забыли пароль?</a>
                    </div>
                </div>
                <div class="form-panel" id="register" data-panel="register">
                    <form action="/auth/handler/registerHandler.php" method="POST">
                        <div class="form-group">
                            <label for="register-name">Имя</label>
                            <input
                                type="text" id="register-name" name="name" required autocomplete="name" placeholder="Иван Иванов">
                        </div>
                        <div class="form-group">
                            <label for="register-email">Email</label>
                            <input type="email" id="register-email" name="email" required autocomplete="email" placeholder="example@mail.ru">
                        </div>
                        <div class="form-group">
                            <label for="register-password">Пароль</label>
                            <input type="password" id="register-password" name="password" required autocomplete="new-password" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label for="register-password-confirm">Подтвердите пароль</label>
                            <input type="password" id="register-password-confirm" name="password_confirm" required autocomplete="new-password" placeholder="••••••••">
                        </div>
                        <button type="submit" class="btn-submit">
                            Зарегистрироваться
                        </button>
                    </form>
                    <div class="form-footer">
                        <a href="/auth">Уже есть аккаунт? Войти</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/footer.php' ?>