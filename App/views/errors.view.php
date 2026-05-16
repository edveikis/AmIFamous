<?php if (isset($errors)) : ?>
    <div class="error-list">
        <?php foreach ($errors as $error) : ?>
            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>