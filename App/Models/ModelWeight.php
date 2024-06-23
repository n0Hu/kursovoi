<?php

namespace App\Models;

use App\Core\BaseModel;

class ModelWeight extends BaseModel {
    public $model = 'weight_user';

    function create($data) {
        foreach ($data as &$value) {
            $value = htmlspecialchars($value);
        }

        $id = $this->sendSQLGetID("INSERT INTO weight_user (user_id, weight, date) VALUE (:user_id, :weight, :date)", [
            'user_id' => (int) $_SESSION['id'],
            'weight' => $data['weight'],
            'date' => $data['date']
        ]);

        return $id;
    }

    function getStatsWeight($user_id, $year = null) {
        $year = $year == null ? date('Y') : $year;

        return $this->sendSQLGetData("
            SELECT
                MIN(weight_user.weight) AS total,
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
            LEFT JOIN weight_user
                ON
                    MONTH(STR_TO_DATE(weight_user.date, '%Y-%m-%d')) = months.month_num
                    AND YEAR(STR_TO_DATE(weight_user.date, '%Y-%m-%d')) = :year
                AND weight_user.user_id = :user_id
                GROUP BY months.month_name
                ORDER BY months.month_num;
        ", [
            'user_id' => $user_id,
            'year' => $year
        ]);
    }
}