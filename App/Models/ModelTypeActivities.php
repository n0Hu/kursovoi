<?php

namespace App\Models;

use App\Core\BaseModel;

class ModelTypeActivities extends BaseModel {
    public $model = 'type_activities';

    function create($data) {
        foreach ($data as &$value) {
            $value = htmlspecialchars($value);
        }

        return $this->sendSQLGetID("INSERT INTO type_activities (name) VALUE (:name)", ['name' => $data['name']]);
    }
}