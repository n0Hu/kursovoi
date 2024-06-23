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
                            <form action="/register" method="post">
                                <div class="field">
                                    <p class="control has-icons-left has-icons-right">
                                        <input name="email" class="input" type="email" placeholder="Почта*" required />
                                        <span class="icon is-small is-left">
                                            <i class="fa-solid fa-envelope"></i>
                                        </span>
                                        <span id="checkedEmail" class="icon is-small is-right">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    </p>
                                    <p id="error-email" class="help is-danger">Email зарегистрирован</p>
                                </div>

                                <div class="field">
                                    <p class="control has-icons-left has-icons-right">
                                        <input name="nickname" class="input" type="text" placeholder="Логин*" required />
                                        <span class="icon is-small is-left">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                        <span id="checkedNickname" class="icon is-small is-right">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    </p>
                                    <p id="error-nickname" class="help is-danger">Логин зарегистрирован</p>
                                </div>

                                <div class="field">
                                    <p class="control has-icons-left">
                                        <input name="password" class="input" type="password" minlength="8" placeholder="Пароль*" required />
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </p>
                                </div>

                                <div class="field">
                                    <input name="surname" class="input" type="text" placeholder="Фамилия*" required>
                                </div>

                                <div class="field">
                                    <input name="name" class="input" type="text" placeholder="Имя*" required>
                                </div>

                                <div class="field">
                                    <input name="middle_name" class="input" type="text" placeholder="Отчество">
                                </div>

                                <div class="fields-half">
                                    <div class="field">
                                        <input name="age" class="input" type="number" max="120" placeholder="Полных лет">
                                    </div>

                                    <div class="field">
                                        <div class="select">
                                            <select name="gender" required>
                                                <option selected value="">Пол*</option>
                                                <option value="0">Женский</option>
                                                <option value="1">Мужской</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-btn">
                                    <button type="submit" class="button is-primary">Зарегистрироваться</button>
                                    <a class="button is-text" href="/login">Или войти в систему</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#checkedEmail').hide()
        $('#checkedNickname').hide()
        $('#error-email').hide()
        $('#error-nickname').hide()

        $('[name=email]').change(function (ev) {
            const value = $(ev.currentTarget).val()
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if(!emailRegex.test(value)) {
                $('#error-email').text('Email не корректный').show()
                $('[name=email]').addClass('is-danger')
                return;
            } else {
                $('#error-email').hide()
                $('[name=email]').removeClass('is-danger')

                $.ajax({
                    url: '/haveEmail' + '?email=' + value,
                    type: 'get',
                    success: (res) => {
                        if(res === '1') {
                            $('#error-email').text('Email зарегистрирован').show()
                            $('[name=email]').removeClass('is-success')
                            $('[name=email]').addClass('is-danger')
                        } else {
                            $('#error-email').hide()
                            $('[name=email]').removeClass('is-danger')
                            $('[name=email]').addClass('is-success')
                        }

                        disableButton()
                    },
                    error: (xhr, textStatus, error) => {
                        alert(xhr.responseText);
                    }
                })
            }
        })

        $('[name=nickname]').change(function (ev) {
            const value = $(ev.currentTarget).val()

            $.ajax({
                url: '/haveNickname' + '?nickname=' + value,
                type: 'get',
                success: (res) => {
                    if(res === '1') {
                        $('#error-nickname').text('Логин зарегистрирован').show()
                        $('[name=nickname]').removeClass('is-success')
                        $('[name=nickname]').addClass('is-danger')
                    } else {
                        $('#error-nickname').hide()
                        $('[name=nickname]').removeClass('is-danger')
                        $('[name=nickname]').addClass('is-success')
                    }

                    disableButton()
                },
                error: (xhr, textStatus, error) => {
                    alert(xhr.responseText);
                }
            })
        })

        $('form').submit(function(event) {
            if($('input.is-danger').length > 0) {
                return event.preventDefault();
            }
        });

        function disableButton() {
            if($('input.is-danger').length > 0) {
                $('[type=submit]').attr('disabled', 1)
            } else {
                $('[type=submit]').removeAttr('disabled')
            }
        }
    })
</script>

<style>
    .button {
        width: 100%;
    }

    .custom-btn {
        display: flex;
        flex-direction: column;
    }

    .custom-btn > .button {
        margin-top: 10px;
    }
</style>