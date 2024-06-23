<?php

namespace App\Models;

use App\Core\BaseModel;

class ModelVisit extends BaseModel {
    public $model = 'history_visit_gym';

    function create($data) {
        $id = $this->sendSQLGetID("INSERT INTO history_visit_gym (user_id, date) VALUE (:user_id, :date)", [
            'user_id' => (int) $_SESSION['id'],
            'date' => date('Y-m-d')
        ]);

        return $id;
    }

    function getCountVisitCurrentMounth() {
        $count = $this->sendSQLGetData("
            SELECT COUNT(*) AS total_records
            FROM history_visit_gym
            WHERE 
                MONTH(STR_TO_DATE(date, '%Y-%m-%d')) = MONTH(CURDATE())
                AND YEAR(STR_TO_DATE(date, '%Y-%m-%d')) = YEAR(CURDATE())
                AND user_id = :user_id
        ", ['user_id' => $_SESSION['id']]);

        return $count[0]['total_records'] > 0 ? $count[0]['total_records'] : 'Нет данных';
    }

    function getStatsCountVisit($user_id, $year = null) {
        $year = $year == null ? date('Y') : $year;

        return $this->sendSQLGetData("
            SELECT 
                COUNT(hvg.date) AS total,
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
            LEFT JOIN history_visit_gym hvg 
                ON 
                    MONTH(STR_TO_DATE(hvg.date, '%Y-%m-%d')) = months.month_num 
                    AND YEAR(STR_TO_DATE(hvg.date, '%Y-%m-%d')) = :year
                    AND hvg.user_id = :user_id
            GROUP BY months.month_name
            ORDER BY months.month_num;
        ", [
            'user_id' => $user_id,
            'year' => $year
        ]);
    }
}