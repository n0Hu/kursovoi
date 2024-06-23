<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelWeight;

class ControllerWeight extends BaseController {
    function action() {
        $modelWeight = new ModelWeight();
        $records = $modelWeight->getAllWithUserID($this->currentUser['id']);
        $this->view->generate("Weight/view_all.php", ['user' => $this->currentUser, 'records' => $records]);
    }

    function actionCreate() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view->generate("Weight/view_create.php", ['user' => $this->currentUser]);
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelWeight = new ModelWeight();
            $modelWeight->create($_REQUEST);
            header('Location: /weight');
        }
    }

    function actionDelete() {
        if($_REQUEST['id']) {
            $modelWeight = new ModelWeight();
            $modelWeight->delete($_REQUEST['id']);
            header('Location: /weight');
        }
    }
}