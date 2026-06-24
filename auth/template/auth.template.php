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
                            <input type="text" id="register-name" name="name" required autocomplete="name" placeholder="Иван Иванов">
                            
                            <?php if (!empty($_SESSION['errors']['name'])): ?>
                                <span class="form-error"><?= htmlspecialchars($_SESSION['errors']['name']) ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="register-email">Email</label>
                            <input type="email" id="register-email" name="email" required autocomplete="email" placeholder="example@mail.ru">

                            <?php if (!empty($_SESSION['errors']['email'])): ?>
                                <span class="form-error"><?= htmlspecialchars($_SESSION['errors']['email']) ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="register-password">Пароль</label>
                            <div class="input-group">
                                <input type="password" id="register-password" name="password" required autocomplete="new-password" placeholder="••••••••">
                                <button type="button" id="togglePassword">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#00000"><path d="M607.5-372.5Q660-425 660-500t-52.5-127.5Q555-680 480-680t-127.5 52.5Q300-575 300-500t52.5 127.5Q405-320 480-320t127.5-52.5Zm-204-51Q372-455 372-500t31.5-76.5Q435-608 480-608t76.5 31.5Q588-545 588-500t-31.5 76.5Q525-392 480-392t-76.5-31.5ZM214-281.5Q94-363 40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200q-146 0-266-81.5ZM480-500Zm207.5 160.5Q782-399 832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280q113 0 207.5-59.5Z"/></svg>
                                </button>
                            </div>

                            <?php if (!empty($_SESSION['errors']['password'])): ?>
                                <span class="form-error"><?= htmlspecialchars($_SESSION['errors']['password']) ?></span>
                            <?php endif; ?>
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
<?php unset($_SESSION['errors']) ?>