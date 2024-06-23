<?php

namespace App\Models;

use App\Core\BaseModel;

class ModelTrains extends BaseModel {
    public $model = 'trainers';

    function create($data) {
        foreach ($data as &$value) {
            $value = htmlspecialchars($value);
        }

        return $this->sendSQLGetID("INSERT INTO trainers (type_activity_id, name) VALUE (:type_activity_id, :name)", [
            'type_activity_id' => $data['type_activity_id'],
            'name' => $data['name']
        ]);
    }

    function getAll() {
        return $this->sendSQLGetData("
            SELECT
                trainers.id,
                trainers.type_activity_id,
                type_activities.name AS type_activity_name,
                trainers.name
            FROM trainers
            INNER JOIN type_activities
                ON type_activities.id = trainers.type_activity_id 
        ");
    }

    function getByTypeActive($type_active_id) {
        return $this->sendSQLGetData("
            SELECT id, name FROM trainers WHERE type_activity_id = :type_activity_id
        ", ['type_activity_id' => $type_active_id]);
    }
}