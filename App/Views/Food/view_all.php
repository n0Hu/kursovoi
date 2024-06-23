<div class="container">
    <div class="columns is-multiline is-mobile">
        <div class="column is-full-mobile is-full-desktop">
            <h1 class="title">Еда</h1>

            <div class="buttons">
                <a href="/food/create" class="button is-primary">Создать запись</a>
            </div>

            <div class="table__wrapper">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Питание</th>
                        <th>Калории</th>
                        <th>Протеин</th>
                        <th>Жиры</th>
                        <th>Углеводы</th>
                        <th>Дата</th>
                        <th>Редактировать</th>
                        <th>Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($arrData['records'] as $item): ?>
                        <tr>
                            <td><?=$item['nutrition']?></td>
                            <td><?=$item['calories']?></td>
                            <td><?=$item['proteins']?></td>
                            <td><?=$item['fats']?></td>
                            <td><?=$item['carbohydrates']?></td>
                            <td><?=$item['date']?></td>

                            <td align="center">
                                <a href="/food/edit?id=<?=$item['id']?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td align="center">
                                <a href="/food/delete?id=<?=$item['id']?>">
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