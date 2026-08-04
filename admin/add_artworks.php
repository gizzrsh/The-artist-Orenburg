<?php

require dirname(__DIR__, 1) . '/config/init.php';
require dirname(__DIR__, 1) . '/config/csrf_token.php';
require dirname(__DIR__, 1) . '/inc/functions.php';

if (!is_admin() || !is_logged()) {
    redirect('/');
}

?>

<?php include dirname(__DIR__) . '/admin/inc/header.php' ?>
<main class="main">
    <section class="admin-add">
        <div class="admin-add__inner container">
            <h1 class="admin-add__title">Добавить картину</h1>
            <form class="admin-form" action="/admin/handler/artworkHandler.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />

                <div class="admin-form__group">
                    <label class="admin-form__label" for="title">Название</label>
                    <input class="admin-form__input" type="text" id="title" name="title" placeholder="Например, «Ночной дозор»" required>
                </div>

                <div class="admin-form__row">
                    <div class="admin-form__group">
                        <label class="admin-form__label" for="category">Категория</label>
                        <select class="admin-form__select" id="category" name="category_id" >
                            <option value="">– Выберите –</option>
                            <option value="1">Картины</option>
                            <option value="2">Барельефы</option>
                            <option value="3">Зеркала</option>
                            <option value="4">Интерьер</option>
                        </select>
                    </div>
                    <div class="admin-form__group">
                        <label class="admin-form__label" for="price">Цена (₽)</label>
                        <input class="admin-form__input" type="number" id="price" name="price" step="0.01" placeholder="0.00">
                    </div>
                </div>

                <div class="admin-form__group">
                    <label class="admin-form__label" for="description">Описание</label>
                    <textarea class="admin-form__textarea" id="description" name="description" placeholder="Краткое описание картины..."></textarea>
                </div>

                <div class="admin-form__group">
                    <label class="admin-form__label">Изображение</label>
                    <div class="admin-form__file-wrapper">
                        <div class="admin-form__file-input">
                            <input type="file" name="image" accept="image/*">
                            <?php if (!empty($_SESSION['errors']['image'])): ?>
                                <span class="form-error"><?= htmlspecialchars($_SESSION['errors']['image']) ?></span>
                                <?php unset($_SESSION['errors']['image']) ?>
                            <?php endif; ?>
                        </div>
                        <div class="admin-form__file-preview">
                            <span class="placeholder">🖼</span>
                            <!-- или <img src="..." alt="preview"> при редактировании -->
                        </div>
                    </div>
                </div>

                <div class="admin-form__checkbox-group">
                    <input type="checkbox" id="published" name="is_published" value="1" checked>
                    <label for="published">Опубликовано (доступно на сайте)</label>
                </div>

                <div class="admin-form__actions">
                    <button class="btn btn--save" type="submit">Сохранить</button>
                    <a class="btn btn--cancel" href="/admin">Отмена</a>
                </div>

            </form>
        </div>
    </section>
</main>
<?php include dirname(__DIR__) . '/admin/inc/footer.php' ?>