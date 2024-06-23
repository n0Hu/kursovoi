<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelActivities;
use App\Models\ModelFood;
use App\Models\ModelTypeActivities;

class ControllerActivity extends BaseController {
    function action() {
        $modelActivities = new ModelActivities();
        $records = $modelActivities->getAllWithUserID($this->currentUser['id']);
        $this->view->generate("Activities/view_all.php", ['user' => $this->currentUser, 'records' => $records]);
    }

    function actionCreate() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $modelTypeActivities = new ModelTypeActivities();
            $typeActivities = $modelTypeActivities->getAll();

            $this->view->generate("Activities/view_create.php", ['user' => $this->currentUser, 'type_activities' => $typeActivities]);
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelActivities = new ModelActivities();
            $modelActivities->create($_REQUEST);
            header('Location: /activities');
        }
    }

    function actionEdit() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $modelTypeActivities = new ModelTypeActivities();
            $typeActivities = $modelTypeActivities->getAll();

            $modelActivities = new ModelActivities();
            $record = $modelActivities->getByID($_REQUEST['id']);
            if(!empty($record)) {
                $this->view->generate("Activities/view_edit.php", ['user' => $this->currentUser, 'record' => $record[0], 'type_activities' => $typeActivities]);
            } else {
                header('Location: /activities');
            }
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelActivities = new ModelActivities();
            $modelActivities->update($_REQUEST['id'], $_REQUEST);
            header('Location: /activities');
        }
    }

    function actionDelete() {
        if($_REQUEST['id']) {
            $modelActivities = new ModelActivities();
            $modelActivities->delete($_REQUEST['id']);
            header('Location: /activities');
        }
    }
}