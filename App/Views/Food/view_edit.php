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

            <form action="/food/edit" method="post">
                <input type="hidden" name="id" value="<?=$arrData['record']['id']?>">

                <div class="field">
                    <div class="select">
                        <select name="nutrition" required>
                            <option value="">Выберите еду*</option>
                            <option <?php if($arrData['record']['nutrition'] == 'Завтрак'): ?> selected <?php endif;?> value="Завтрак">Завтрак</option>
                            <option <?php if($arrData['record']['nutrition'] == 'Обед'): ?> selected <?php endif;?> value="Обед">Обед</option>
                            <option <?php if($arrData['record']['nutrition'] == 'Ужин'): ?> selected <?php endif;?> value="Ужин">Ужин</option>
                            <option <?php if($arrData['record']['nutrition'] == 'Перекус'): ?> selected <?php endif;?> value="Перекус">Перекус</option>

                        </select>
                    </div>
                </div>

                <div class="field">
                    <p class="control">
                        <input name="calories" class="input" type="number" placeholder="Киллокалории*" required value="<?=$arrData['record']['calories']?>">
                    </p>
                </div>

                <div class="field">
                    <p class="control">
                        <input name="proteins" class="input" type="number" placeholder="Протеины" value="<?=$arrData['record']['proteins']?>">
                    </p>
                </div>

                <div class="field">
                    <p class="control">
                        <input name="fats" class="input" type="number" placeholder="Жиры" value="<?=$arrData['record']['fats']?>">
                    </p>
                </div>

                <div class="field">
                    <p class="control">
                        <input name="carbohydrates" class="input" type="number" placeholder="Углеводы" value="<?=$arrData['record']['carbohydrates']?>">
                    </p>
                </div>

                <div class="field">
                    <p class="control">
                        <input name="date" class="input" type="date" placeholder="Дата*" required value="<?=$arrData['record']['date']?>">
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