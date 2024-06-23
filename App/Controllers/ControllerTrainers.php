<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelTrains;
use App\Models\ModelTypeActivities;

class ControllerTrainers extends BaseController {
    function action() {
        $modelTrains = new ModelTrains();
        $records = $modelTrains->getAll();
        $this->view->generate("Trainers/view_all.php", ['user' => $this->currentUser, 'records' => $records]);
    }

    function actionCreate() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $modelTypeActivities = new ModelTypeActivities();
            $typeActivities = $modelTypeActivities->getAll();
            $this->view->generate("Trainers/view_create.php", ['user' => $this->currentUser, 'type_activities' => $typeActivities]);
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelTrains = new ModelTrains();
            if(!$modelTrains->create($_REQUEST)) {
                $this->view->generate("Trainers/view_create.php", ['user' => $this->currentUser, 'errors' => ['Такая запись уже создана']]);
            } else {
                header('Location: /trainers');
            }
        }
    }

    function actionEdit() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $modelTypeActivities = new ModelTypeActivities();
            $typeActivities = $modelTypeActivities->getAll();

            $modelTrains = new ModelTrains();
            $record = $modelTrains->getByID($_REQUEST['id']);
            if(!empty($record)) {
                $this->view->generate("Trainers/view_edit.php", ['user' => $this->currentUser, 'record' => $record[0], 'type_activities' => $typeActivities]);
            } else {
                header('Location: /trainers');
            }
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelTrains = new ModelTrains();
            $modelTrains->update($_REQUEST['id'], $_REQUEST);
            header('Location: /trainers');
        }
    }

    function actionDelete() {
        if($_REQUEST['id']) {
            $modelTrains = new ModelTrains();
            $modelTrains->delete($_REQUEST['id']);
            header('Location: /trainers');
        }
    }

    function actionGetByTypeActive() {
        $modelTrains = new ModelTrains($_REQUEST['type_activity']);
        echo json_encode($modelTrains->getByTypeActive($_REQUEST['type_activity']));
    }
}