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
                            <form action="/login" method="post">
                                <div class="field">
                                    <p class="control has-icons-left">
                                        <input name="nickname" class="input" type="text" placeholder="Логин" />
                                        <span class="icon is-small is-left">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                    </p>
                                </div>

                                <div class="field">
                                    <p class="control has-icons-left">
                                        <input name="password" class="input" type="password" placeholder="Пароль" />
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </p>
                                </div>

                                <div class="custom-btn">
                                    <button class="button is-primary">Войти</button>
                                    <a class="button is-text" href="/register">Зарегистрироваться</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
    .custom-btn {
        display: flex;
        flex-direction: column;
    }

    .custom-btn > .button {
        margin-top: 10px;
    }
</style>