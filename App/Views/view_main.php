<div class="container">
    <div class="columns is-mobile">
        <div class="column is-full">
            <h1 class="title">Ваш прогресс</h1>
        </div>
    </div>

    <div class="columns">
        <!-- Прогресс веса в разрезе месяцев выбранного года -->
        <div class="column is-half-desktop">
            <h2 class="subtitle">Статистика по весу</h2>
            <div class="column is-half">
                <div class="field">
                    <div class="select">
                        <select name="year_weight">
                            <?php
                            $currentYear = date("Y");
                            for ($i = $currentYear - 10; $i <= $currentYear + 20; $i++) {
                                $selected = ($i == $currentYear) ? 'selected' : ''; // Помечаем текущий год как выбранный
                                echo "<option value='$i' $selected>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <canvas id="weightUser" style="max-width: inherit; margin: 5px;"></canvas>
        </div>

        <!-- Кол-во посещений в разрезе месяцев выбранного года -->
        <div class="column is-full-mobile is-half-desktop">
            <h2 class="subtitle">Статистика по кол-во посещений</h2>
            <div class="column is-half">
                <div class="field">
                    <div class="select">
                        <select name="year_visit">
                            <?php
                                $currentYear = date("Y");
                                for ($i = $currentYear - 10; $i <= $currentYear + 20; $i++) {
                                    $selected = ($i == $currentYear) ? 'selected' : ''; // Помечаем текущий год как выбранный
                                    echo "<option value='$i' $selected>$i</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <canvas id="visitUser" style="max-width: inherit; margin: 5px;"></canvas>
        </div>
    </div>

    <div class="columns">
        <!-- Кол-во соженных киллокалорий в разрезе месяцев выбранного года -->
        <div class="column is-full-mobile is-half-desktop">
            <h2 class="subtitle">Статистика по потраченным килокалориям</h2>
            <div class="column is-half">
                <div class="field">
                    <div class="select">
                        <select name="year_down_calories">
                            <?php
                            $currentYear = date("Y");
                            for ($i = $currentYear - 10; $i <= $currentYear + 20; $i++) {
                                $selected = ($i == $currentYear) ? 'selected' : ''; // Помечаем текущий год как выбранный
                                echo "<option value='$i' $selected>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <canvas id="downCalories" style="max-width: inherit; margin: 5px;"></canvas>
        </div>

        <!-- Кол-во набранных киллокалорий в разрезе месяцев выбранного года -->
        <div class="column is-full-mobile is-half-desktop">
            <h2 class="subtitle">Статистика по набранным килокалориям</h2>
            <div class="column is-half">
                <div class="field">
                    <div class="select">
                        <select name="year_up_calories">
                            <?php
                            $currentYear = date("Y");
                            for ($i = $currentYear - 10; $i <= $currentYear + 20; $i++) {
                                $selected = ($i == $currentYear) ? 'selected' : ''; // Помечаем текущий год как выбранный
                                echo "<option value='$i' $selected>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <canvas id="upCalories" style="max-width: inherit; margin: 5px;"></canvas>
        </div>
    </div>

    <div class="columns">
        <!-- Разница сожженых и набранных киллокалорий в разрезе месяцев выбранного года -->
        <div class="column is-full">
            <h2 class="subtitle">Статистика по набранным и расходуемым килокалориям</h2>
            <div class="column is-full">
                <div class="field">
                    <div class="select">
                        <select name="year_difference_calories">
                            <?php
                            $currentYear = date("Y");
                            for ($i = $currentYear - 10; $i <= $currentYear + 20; $i++) {
                                $selected = ($i == $currentYear) ? 'selected' : ''; // Помечаем текущий год как выбранный
                                echo "<option value='$i' $selected>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <canvas id="differenceCalories" style="max-width: inherit; margin: 5px;"></canvas>
        </div>
    </div>
</div>

<script>
    $(document).ready(async function () {
        function getOptions(name) {
            return {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: name,
                    }
                }
            };
        }

        function getDataStatWeight(year) {
            return new Promise(resolve => {
                $.ajax({
                    url: '/stats/getWeight' + '?year=' + year,
                    type: 'get',
                    success: (res) => {
                        res = JSON.parse(res)
                        // Отрисовываем график
                        const data = {
                            labels: res.map(el => el.month),
                            datasets: [{
                                label: 'Кол-во веса',
                                data: res.map(el => el.total),
                                borderWidth: 1
                            }]
                        }

                        resolve(data)
                    },
                    error: (xhr, textStatus, error) => {
                        alert(xhr.responseText)
                    }
                })
            })
        }

        function getDataStatsVisit(year) {
            return new Promise(resolve => {
                $.ajax({
                    url: '/stats/getCountVisit' + '?year=' + year,
                    type: 'get',
                    success: (res) => {
                        res = JSON.parse(res)
                        // Отрисовываем график
                        const data = {
                            labels: res.map(el => el.month),
                            datasets: [{
                                label: 'Кол-во посещений',
                                data: res.map(el => el.total),
                                borderWidth: 1
                            }]
                        }

                        resolve(data)
                    },
                    error: (xhr, textStatus, error) => {
                        alert(xhr.responseText)
                    }
                })
            })
        }

        function getDataStatsDownCalories(year) {
            return new Promise(resolve => {
                $.ajax({
                    url: '/stats/getDownCalories' + '?year=' + year,
                    type: 'get',
                    success: (res) => {
                        res = JSON.parse(res)
                        // Отрисовываем график
                        const data = {
                            labels: res.map(el => el.month),
                            datasets: [{
                                label: 'Кол-во киллокалорий',
                                data: res.map(el => el.total),
                                borderWidth: 1
                            }]
                        }

                        resolve(data)
                    },
                    error: (xhr, textStatus, error) => {
                        alert(xhr.responseText)
                    }
                })
            })
        }

        function getDataStatsUpCalories(year) {
            return new Promise(resolve => {
                $.ajax({
                    url: '/stats/getUpCalories' + '?year=' + year,
                    type: 'get',
                    success: (res) => {
                        res = JSON.parse(res)
                        // Отрисовываем график
                        const data = {
                            labels: res.map(el => el.month),
                            datasets: [{
                                label: 'Кол-во киллокалорий',
                                data: res.map(el => el.total),
                                borderWidth: 1
                            }]
                        }

                        resolve(data)
                    },
                    error: (xhr, textStatus, error) => {
                        alert(xhr.responseText)
                    }
                })
            })
        }

        function getDataStatsDifferenceCalories(year) {
            return new Promise(resolve => {
                $.ajax({
                    url: '/stats/getDifferenceCalories' + '?year=' + year,
                    type: 'get',
                    success: (res) => {
                        res = JSON.parse(res)
                        const data = {
                            labels: res['down'].map(el => el.month),
                            datasets: [
                                {
                                    label: 'Кол-во потраченных киллокалорий',
                                    data: res['down'].map(el => el.total),
                                    borderWidth: 1
                                },
                                {
                                    label: 'Кол-во набранных киллокалорий',
                                    data: res['up'].map(el => el.total),
                                    borderWidth: 1
                                },
                            ]
                        }

                        resolve(data)
                    },
                    error: (xhr, textStatus, error) => {
                        alert(xhr.responseText)
                    }
                })
            })
        }

        // Инцилизируем графики
        const yearWeightValue = $('[name=year_weight]').val()
        const yearVisitValue = $('[name=year_visit]').val()
        const yearDownCaloriesValue = $('[name=year_down_calories]').val()
        const yearUpCaloriesValue = $('[name=year_up_calories]').val()
        const yearDifferenceCaloriesValue = $('[name=year_difference_calories]').val()

        const ctxWeight = document.getElementById('weightUser').getContext('2d')
        const ctxVisit = document.getElementById('visitUser').getContext('2d')
        const ctxDownCalories = document.getElementById('downCalories').getContext('2d')
        const ctxUpCalories = document.getElementById('upCalories').getContext('2d')
        const ctxDifferenceCalories = document.getElementById('differenceCalories').getContext('2d')

        // Кол-во веса
        let chartWeight = new Chart(ctxWeight, {
            type: 'bar',
            data: await getDataStatWeight(yearWeightValue),
            options: getOptions('Вес')
        });

        $('[name=year_weight]').change(async ev => {
            const value = $(ev.currentTarget).val()
            chartWeight.destroy()
            chartWeight = new Chart(ctxWeight, {
                type: 'bar',
                data: await getDataStatWeight(value),
                options: getOptions('Вес')
            })
        })

        // Кол-во посещений
        let chartVisit = new Chart(ctxVisit, {
            type: 'bar',
            data: await getDataStatsVisit(yearVisitValue),
            options: getOptions('Кол-во посещений')
        })

        $('[name=year_visit]').change(async ev => {
            const value = $(ev.currentTarget).val()
            chartVisit.destroy()
            chartVisit = new Chart(ctxVisit, {
                type: 'bar',
                data: await getDataStatsVisit(value),
                options: getOptions('Кол-во посещений')
            })
        })

        // Кол-во соженных киллокалорий
        let chartDownCalories = new Chart(ctxDownCalories, {
            type: 'line',
            data: await getDataStatsDownCalories(yearDownCaloriesValue),
            options: getOptions('Кол-во потраченных киллокалорий')
        })

        $('[name=year_down_calories]').change(async ev => {
            const value = $(ev.currentTarget).val()
            chartDownCalories.destroy()
            chartDownCalories = new Chart(ctxDownCalories, {
                type: 'line',
                data: await getDataStatsDownCalories(value),
                options: getOptions('Кол-во потраченных киллокалорий')
            })
        })

        // Кол-во набранных киллокалорий
        let chartUpCalories = new Chart(ctxUpCalories, {
            type: 'line',
            data: await getDataStatsUpCalories(yearUpCaloriesValue),
            options: getOptions('Кол-во набранных киллокалорий')
        })

        $('[name=year_up_calories]').change(async ev => {
            const value = $(ev.currentTarget).val()
            chartUpCalories.destroy()
            chartUpCalories = new Chart(ctxUpCalories, {
                type: 'line',
                data: await getDataStatsUpCalories(value),
                options: getOptions('Кол-во набранных киллокалорий')
            })
        })

        // Кол-во набранных и расходуемых киллокалорий
        let chartDifferenceCalories = new Chart(ctxDifferenceCalories, {
            type: 'line',
            data: await getDataStatsDifferenceCalories(yearDifferenceCaloriesValue),
            options: getOptions('Разница киллокалорий')
        })

        $('[name=year_difference_calories]').change(async ev => {
            const value = $(ev.currentTarget).val()
            chartDifferenceCalories.destroy()
            chartDifferenceCalories = new Chart(ctxDifferenceCalories, {
                type: 'line',
                data: await getDataStatsDifferenceCalories(value),
                options: getOptions('Разница киллокалорий')
            })
        })
    })
</script>

<style>
    .subtitle {
        margin: 0!important;
    }
</style>