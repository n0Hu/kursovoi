<?php

namespace App\Models;

use App\Core\BaseModel;

class ModelFood extends BaseModel {
    public $model = 'calories_user';

    function create($data) {
        foreach ($data as &$value) {
            $value = htmlspecialchars($value);
        }

        return $this->sendSQLGetID("
            INSERT INTO calories_user (user_id, nutrition, calories, proteins, fats, carbohydrates, date) 
            VALUE (
                :user_id,
                :nutrition,
                :calories,
                :proteins,
                :fats,
                :carbohydrates,
                :date
            )
        ", [
            'user_id' => (int) $_SESSION['id'],
            'nutrition' => $data['nutrition'],
            'calories' => $data['calories'],
            'proteins' => strlen($data['proteins']) > 0 ? $data['proteins'] : null,
            'fats' => strlen($data['fats']) > 0 ? $data['fats'] : null,
            'carbohydrates' => strlen($data['carbohydrates']) > 0 ? $data['carbohydrates'] : null,
            'date' => $data['date']
        ]);
    }

    function getStatsUpCalories($user_id, $year = null) {
        $year = $year == null ? date('Y') : $year;

        return $this->sendSQLGetData("
            SELECT
                SUM(calories_user.calories) AS total,
                months.month_name AS month
            FROM
            (
                SELECT 1 AS month_num, 'Январь' AS month_name
                UNION SELECT 2, 'Февраль'
                UNION SELECT 3, 'Март'
                UNION SELECT 4, 'Апрель'
                UNION SELECT 5, 'Май'
                UNION SELECT 6, 'Июнь'
                UNION SELECT 7, 'Июль'
                UNION SELECT 8, 'Август'
                UNION SELECT 9, 'Сентябрь'
                UNION SELECT 10, 'Октябрь'
                UNION SELECT 11, 'Ноябрь'
                UNION SELECT 12, 'Декабрь'
            ) AS months
            LEFT JOIN calories_user
                ON
                    MONTH(STR_TO_DATE(calories_user.date, '%Y-%m-%d')) = months.month_num
                    AND YEAR(STR_TO_DATE(calories_user.date, '%Y-%m-%d')) = :year
                    AND calories_user.user_id = :user_id
            GROUP BY months.month_name
            ORDER BY months.month_num;
        ", [
            'user_id' => $user_id,
            'year' => $year
        ]);
    }
}