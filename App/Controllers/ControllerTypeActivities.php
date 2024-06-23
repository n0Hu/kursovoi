<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelTypeActivities;

class ControllerTypeActivities extends BaseController {
    function action() {
        $modelTypeActivities = new ModelTypeActivities();
        $records = $modelTypeActivities->getAll();
        $this->view->generate("Type_activities/view_all.php", ['user' => $this->currentUser, 'records' => $records]);
    }

    function actionCreate() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view->generate("Type_activities/view_create.php", ['user' => $this->currentUser]);
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelTypeActivities = new ModelTypeActivities();
            if(!$modelTypeActivities->create($_REQUEST)) {
                $this->view->generate("Type_activities/view_create.php", ['user' => $this->currentUser, 'errors' => ['Такая запись уже создана']]);
            } else {
                header('Location: /type-activities');
            }
        }
    }

    function actionEdit() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $modelTypeActivities = new ModelTypeActivities();
            $record = $modelTypeActivities->getByID($_REQUEST['id']);
            if(!empty($record)) {
                $this->view->generate("Type_activities/view_edit.php", ['user' => $this->currentUser, 'record' => $record[0]]);
            } else {
                header('Location: /type-activities');
            }
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelTypeActivities = new ModelTypeActivities();
            $modelTypeActivities->update($_REQUEST['id'], $_REQUEST);
            header('Location: /type-activities');
        }
    }

    function actionDelete() {
        if($_REQUEST['id']) {
            $modelTypeActivities = new ModelTypeActivities();
            $modelTypeActivities->delete($_REQUEST['id']);
            header('Location: /type-activities');
        }
    }
}