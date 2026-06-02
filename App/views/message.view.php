<?php

use Framework\Session;
?>

<style>
    .flash-container {
        margin-bottom: 24px;
    }

    .flash-message {
        background: rgba(15, 23, 42, 0.82);
        border: 1px solid rgba(255, 255, 255, 0.06);
        padding: 16px 20px;
        border-radius: 14px;
        font-weight: 600;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        margin-bottom: 12px;
    }

    .flash-success {
        color: #4ade80;
        background: rgba(34, 197, 94, 0.15);
    }

    .flash-error {
        color: #f87171;
        background: rgba(239, 68, 68, 0.15);
    }
</style>

<div class="flash-container">

    <?php $successMessage = Session::getFlashMessage('success_message'); ?>
    <?php if ($successMessage !== null) : ?>
        <div class="flash-message flash-success"><?= htmlspecialchars($successMessage) ?></div>
    <?php endif; ?>

    <?php $errorMessage = Session::getFlashMessage('error_message'); ?>
    <?php if ($errorMessage !== null) : ?>
        <div class="flash-message flash-error"><?= htmlspecialchars($errorMessage) ?></div>
    <?php endif; ?>

</div>