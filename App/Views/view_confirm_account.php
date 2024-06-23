<div class="container">
    <?php if(!empty($arrData["errors"])): ?>
        <div class="card card-error">
            <?php foreach ($arrData["errors"] as $value): ?>
                <p><?= $value ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php IF(isset($arrData['isConfirm'])): ?>
        <p>Ваш аккаунт подтвержден, перейдите на главную страницу.</p>
    <?php ELSE: ?>
        <p>После подтверждения аккаунта, вы сможете воспользоваться системойю</p>
    <?php ENDIF; ?>
</div>
