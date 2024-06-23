<div class="container">
    <div class="columns is-multiline is-mobile">
        <div class="column is-full-mobile is-full-desktop">
            <h1 class="title">История веса</h1>

            <div class="buttons">
                <a href="/weight/create" class="button is-primary">Записать вес</a>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>Вес</th>
                    <th>Дата</th>
                    <th>Удалить</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($arrData['records'] as $item): ?>
                    <tr>
                        <td><?=$item['weight']?> кг</td>
                        <td><?=$item['date']?></td>
                        <td align="center">
                            <a href="/weight/delete?id=<?=$item['id']?>">
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