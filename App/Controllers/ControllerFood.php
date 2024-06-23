<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelFood;

class ControllerFood extends BaseController {
    function action() {
        $modelFood = new ModelFood();
        $records = $modelFood->getAllWithUserID($this->currentUser['id']);
        $this->view->generate("Food/view_all.php", ['user' => $this->currentUser, 'records' => $records]);
    }

    function actionCreate() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view->generate("Food/view_create.php", ['user' => $this->currentUser]);
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelFood = new ModelFood();
            $modelFood->create($_REQUEST);
            header('Location: /food');
        }
    }

    function actionEdit() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $modelFood = new ModelFood();
            $record = $modelFood->getByID($_REQUEST['id']);
            if(!empty($record)) {
                $this->view->generate("Food/view_edit.php", ['user' => $this->currentUser, 'record' => $record[0]]);
            } else {
                header('Location: /food');
            }
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelFood = new ModelFood();
            $modelFood->update($_REQUEST['id'], $_REQUEST);
            header('Location: /food');
        }
    }

    function actionDelete() {
        if($_REQUEST['id']) {
            $modelFood = new ModelFood();
            $modelFood->delete($_REQUEST['id']);
            header('Location: /food');
        }
    }
}