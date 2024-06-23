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
            <h1 class="title">Добавить тренажер</h1>

            <form action="/trainers/create" method="post">
                <div class="field">
                    <div class="select">
                        <select name="type_activity_id" required>
                            <option selected value="">Тип активности*</option>
                            <?php FOREACH($arrData['type_activities'] as $item): ?>
                                <option value="<?=$item['id']?>"><?=$item['name']?></option>
                            <?php ENDFOREACH; ?>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <p class="control">
                        <input name="name" class="input" type="text" placeholder="Наименование*" required>
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