<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelVisit;

class ControllerVisit extends BaseController {
    function action() {
        $modelVisit = new ModelVisit();
        $records = $modelVisit->getAllWithUserID($this->currentUser['id']);
        $count = $modelVisit->getCountVisitCurrentMounth();
        $this->view->generate("view_visit.php", ['user' => $this->currentUser, 'records' => $records, 'count' => $count]);
    }

    function actionCreate() {
        $modelVisit = new ModelVisit();
        $modelVisit->create(null);
        header('Location: /visits');
    }

    function actionDelete() {
        if($_REQUEST['id']) {
            $modelWeight = new ModelVisit();
            $modelWeight->delete($_REQUEST['id']);
            header('Location: /visits');
        }
    }
}