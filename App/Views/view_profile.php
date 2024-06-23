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
        <section class="section centered">
            <div class="column is-full-mobile is-half-desktop">
                <div class="card">
                    <div class="card-content">
                        <div class="content">
                            <form action="/profile" method="post">

                                <div class="fields-half">
                                    <div class="field">
                                        <p class="control has-icons-left has-icons-right">
                                            <input name="email" class="input" type="email" placeholder="Почта*" disabled value="<?=$arrData['user']['email']?>"/>
                                            <span class="icon is-small is-left">
                                                <i class="fa-solid fa-envelope"></i>
                                            </span>
                                        </p>
                                    </div>

                                    <div class="field">
                                        <p class="control has-icons-left has-icons-right">
                                            <input name="nickname" class="input" type="text" placeholder="Логин*" disabled value="<?=$arrData['user']['nickname']?>"/>
                                            <span class="icon is-small is-left">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="field">
                                    <p class="control has-icons-left">
                                        <input name="old-password" class="input" type="password" minlength="8" placeholder="Старый пароль" />
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </p>
                                </div>

                                <div class="field">
                                    <p class="control has-icons-left">
                                        <input name="password" class="input" type="password" minlength="8" placeholder="Новый пароль" />
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </p>
                                </div>

                                <div class="field">
                                    <input name="surname" class="input" type="text" placeholder="Фамилия*" required value="<?=$arrData['user']['surname']?>">
                                </div>

                                <div class="field">
                                    <input name="name" class="input" type="text" placeholder="Имя*" required value="<?=$arrData['user']['name']?>">
                                </div>

                                <div class="field">
                                    <input name="middle_name" class="input" type="text" placeholder="Отчество" value="<?=$arrData['user']['middle_name']?>">
                                </div>

                                <div class="fields-half">
                                    <div class="field">
                                        <input name="age" class="input" type="number" max="120" placeholder="Полных лет" value="<?=$arrData['user']['age']?>">
                                    </div>

                                    <div class="field">
                                        <div class="select">
                                            <select name="gender" required>
                                                <option value="">Пол*</option>
                                                <option <?php IF($arrData['user']['gender'] == 0):?> selected <?php ENDIF;?> value="0">Женский</option>
                                                <option <?php IF($arrData['user']['gender'] == 1):?> selected <?php ENDIF;?> value="1">Мужской</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="button is-primary">Обновить данные</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
    .button {
        width: 100%;
    }

    .custom-btn > .button {
        margin-top: 10px;
    }
</style>