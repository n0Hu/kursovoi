<div class="container">
    <div class="columns is-multiline is-mobile">
        <div class="column is-full-mobile is-full-desktop">
            <h1 class="title">История посещений</h1>

            <div class="buttons">
                <a href="/visits/create" class="button is-primary">Добавить посещение на сегодня</a>
            </div>

            <h6 class="subtitle is-6">Кол-во посещений в этом месяце: <?=$arrData['count']?></h6>

            <table class="table">
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Удалить</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($arrData['records'] as $item): ?>
                    <tr>
                        <td><?=$item['date']?></td>
                        <td align="center">
                            <a href="/visits/delete?id=<?=$item['id']?>">
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