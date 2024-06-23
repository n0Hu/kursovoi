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
            <h1 class="title">Редактирование записи в истории активности</h1>

            <form action="/activities/edit" method="post">
                <input name="id" type="hidden" value="<?=$arrData['record']['id']?>">
                <div class="field">
                    <div class="select">
                        <select name="type_activity_id" required>
                            <option selected value="">Тип активности*</option>
                            <?php FOREACH($arrData['type_activities'] as $item): ?>
                                <option <?php if($arrData['record']['type_activity_id'] == $item['id']): ?> selected <?php endif; ?> value="<?=$item['id']?>"><?=$item['name']?></option>
                            <?php ENDFOREACH; ?>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <div class="select">
                        <select name="trainer_id" required disabled>
                            <option selected value="">Тренажер*</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <p class="control">
                        <input name="calories" class="input" type="number" placeholder="Калории*" required value="<?=$arrData['record']['calories']?>">
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

        function getTrainers(type_activity_id) {
            return new Promise(resolve => {
                $.ajax({
                    url: '/trainers/getForTypeActivities' + '?type_activity=' + type_activity_id,
                    type: 'get',
                    success: (res) => {
                        res = JSON.parse(res)
                        console.dir(res)
                        res.map(el => {
                            $('[name=trainer_id]').append($(`<option value="${el.id}">${el.name}</option>`))
                        })
                        $('[name=trainer_id]').removeAttr('disabled')
                        resolve()
                    },
                    error: (xhr, textStatus, error) => {
                        alert(xhr.responseText);
                    }
                })
            })
        }

        $('[name=type_activity_id]').change(function (ev) {
            const value = $(ev.currentTarget).val()

            $('[name=trainer_id]').empty();
            $('[name=trainer_id]').append($('<option selected value="">Тренажер*</option>'))

            if(value) {
                getTrainers(value)
            } else {
                $('[name=trainer_id]').attr('disabled', 1)
            }
        })

        getTrainers(<?=$arrData['record']['type_activity_id']?>).then(res => {
            $('[name=trainer_id]').val(<?=$arrData['record']['trainer_id']?>).trigger('change')
        })
    })
</script>