<div class="container">
    <div class="columns is-multiline is-mobile">
        <div class="column is-full-mobile is-full-desktop">
            <h1 class="title">Справочник: Тип активности</h1>

            <div class="buttons">
                <a href="/type-activities/create" class="button is-primary">Создать запись</a>
            </div>

            <div class="table__wrapper">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Наименование</th>
                        <th>редактировать</th>
                        <th>Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($arrData['records'] as $item): ?>
                        <tr>
                            <td><?=$item['name']?></td>
                            <td align="center">
                                <a href="/type-activities/edit?id=<?=$item['id']?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td align="center">
                                <a href="/type-activities/delete?id=<?=$item['id']?>">
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