<div class="container">
    <?php if(!empty($arrData["errors"])): ?>
        <div class="notification is-danger">
            <button class="delete"></button>
            <?php foreach ($arrData["errors"] as $value): ?>
                <p><?= $value ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="columns is-gapless is-multiline is-mobile">
        <div class="column is-full-mobile is-half-desktop">
            <h1 class="title">Добавить вес</h1>

            <form action="/weight/create" method="post">
                <div class="field">
                    <p class="control">
                        <input name="weight" class="input" type="number" placeholder="Вес">
                    </p>
                </div>

                <div class="field">
                    <p class="control">
                        <input name="date" class="input" type="date" placeholder="Дата">
                    </p>
                </div>

                <button class="button is-primary">Сохранить</button>
            </form>
        </div>
    </div>
</div>