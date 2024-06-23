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
        <div id="column-form" class="column is-full-mobile is-half-desktop">
            <h1 class="title">Добавить запись употребления еды</h1>

            <form action="/food/create" method="post">
                <div class="field">
                    <div class="select">
                        <select name="nutrition" required>
                            <option selected value="">Выберите еду*</option>
                            <option value="Завтрак">Завтрак</option>
                            <option value="Обед">Обед</option>
                            <option value="Ужин">Ужин</option>
                            <option value="Перекус">Перекус</option>

                        </select>
                    </div>
                </div>

                <div class="field">
                    <p class="control">
                        <input name="calories" class="input" type="number" placeholder="Киллокалории*" required>
                    </p>
                </div>

                <div class="field">
                    <p class="control">
                        <input name="proteins" class="input" type="number" placeholder="Протеины">
                    </p>
                </div>

                <div class="field">
                    <p class="control">
                        <input name="fats" class="input" type="number" placeholder="Жиры">
                    </p>
                </div>

                <div class="field">
                    <p class="control">
                        <input name="carbohydrates" class="input" type="number" placeholder="Углеводы">
                    </p>
                </div>

                <div class="field">
                    <p class="control">
                        <input name="date" class="input" type="date" placeholder="Дата*" required>
                    </p>
                </div>

                <button class="button is-primary">Сохранить</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        if($('.notification').length) {
            $('#column-form').css('margin-top', '100px');
        }
    })
</script>