<div class="container">
    <div class="columns">
        <div class="column">
            <h1 class="title">История активности</h1>

            <div class="buttons">
                <a href="/activities/create" class="button is-primary">Создать запись</a>
            </div>

            <div class="table__wrapper">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Тип активности</th>
                        <th>Тренажер</th>
                        <th>Калории</th>
                        <th>Дата</th>
                        <th>Редактировать</th>
                        <th>Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($arrData['records'] as $item): ?>
                        <tr>
                            <td><?=$item['type_activity_name']?></td>
                            <td><?=$item['trainer_name']?></td>
                            <td><?=$item['calories']?></td>
                            <td><?=$item['date']?></td>

                            <td align="center">
                                <a href="/activities/edit?id=<?=$item['id']?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td align="center">
                                <a href="/activities/delete?id=<?=$item['id']?>">
                                    <i class="color-red fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>