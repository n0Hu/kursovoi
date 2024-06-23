<?php

namespace App\Models;

use App\Core\BaseModel;

class ModelActivities extends BaseModel {
    public $model = 'history_activity_gym';

    function create($data) {
        foreach ($data as &$value) {
            $value = htmlspecialchars($value);
        }

        return $this->sendSQLGetID("
            INSERT INTO history_activity_gym (user_id, type_activity_id, trainer_id, calories, date) 
            VALUE (
                :user_id,
                :type_activity_id,
                :trainer_id,
                :calories,
                :date
            )
        ", [
            'user_id' => (int) $_SESSION['id'],
            'type_activity_id' => $data['type_activity_id'],
            'trainer_id' => $data['trainer_id'],
            'calories' => $data['calories'],
            'date' => $data['date']
        ]);
    }

    function getAll() {
        return $this->sendSQLGetData("
            SELECT
                history_activity_gym.id,
                history_activity_gym.user_id,
                history_activity_gym.type_activity_id,
                type_activities.name AS type_activity_name,
                history_activity_gym.trainer_id,
                trainers.name AS trainer_name,
                history_activity_gym.calories,
                history_activity_gym.date
            FROM history_activity_gym
            INNER JOIN type_activities
                ON type_activities.id = history_activity_gym.type_activity_id
            INNER JOIN trainers
                ON trainers.id = history_activity_gym.trainer_id
        ");
    }

    function getAllWithUserID($user_id) {
        return $this->sendSQLGetData("
            SELECT
                history_activity_gym.id,
                history_activity_gym.user_id,
                history_activity_gym.type_activity_id,
                type_activities.name AS type_activity_name,
                history_activity_gym.trainer_id,
                trainers.name AS trainer_name,
                history_activity_gym.calories,
                history_activity_gym.date
            FROM history_activity_gym
            INNER JOIN type_activities
                ON type_activities.id = history_activity_gym.type_activity_id
            INNER JOIN trainers
                ON trainers.id = history_activity_gym.trainer_id
            WHERE history_activity_gym.user_id = :user_id
        ", ['user_id' => $user_id]);
    }

    function getStatsDownCalories($user_id, $year = null) {
        $year = $year == null ? date('Y') : $year;

        return $this->sendSQLGetData("
            SELECT
                SUM(history_activity_gym.calories) AS total,
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
            LEFT JOIN history_activity_gym
                ON
                    MONTH(STR_TO_DATE(history_activity_gym.date, '%Y-%m-%d')) = months.month_num
                    AND YEAR(STR_TO_DATE(history_activity_gym.date, '%Y-%m-%d')) = :year
                    AND history_activity_gym.user_id = :user_id
            GROUP BY months.month_name
            ORDER BY months.month_num;
        ", [
            'user_id' => $user_id,
            'year' => $year
        ]);
    }
}