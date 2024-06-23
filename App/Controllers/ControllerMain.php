<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelActivities;
use App\Models\ModelFood;
use App\Models\ModelVisit;
use App\Models\ModelWeight;

class ControllerMain extends BaseController {
    public function action() {
        $this->view->generate("view_main.php", ['user' => $this->currentUser]);
    }

    public function actionGetStatsCountVisit() {
        $year = isset($_REQUEST['year']) && is_int((int) $_REQUEST['year']) && $_REQUEST['year'] != 'null' ? htmlspecialchars($_REQUEST['year']) : null;
        $modelVisit = new ModelVisit();
        echo json_encode($modelVisit->getStatsCountVisit($this->currentUser['id'], $year));
    }

    public function actionGetStatsWeight() {
        $year = isset($_REQUEST['year']) && is_int((int) $_REQUEST['year']) && $_REQUEST['year'] != 'null' ? htmlspecialchars($_REQUEST['year']) : null;
        $modelWeight = new ModelWeight();
        echo json_encode($modelWeight->getStatsWeight($this->currentUser['id'], $year));
    }

    public function actionGetStatsDownCalories() {
        $year = isset($_REQUEST['year']) && is_int((int) $_REQUEST['year']) && $_REQUEST['year'] != 'null' ? htmlspecialchars($_REQUEST['year']) : null;
        $modelActivities = new ModelActivities();
        echo json_encode($modelActivities->getStatsDownCalories($this->currentUser['id'], $year));
    }

    public function actionGetStatsUpCalories() {
        $year = isset($_REQUEST['year']) && is_int((int) $_REQUEST['year']) && $_REQUEST['year'] != 'null' ? htmlspecialchars($_REQUEST['year']) : null;
        $modelFood = new ModelFood();
        echo json_encode($modelFood->getStatsUpCalories($this->currentUser['id'], $year));
    }

    public function actionGetStatsDifferenceCalories() {
        $year = isset($_REQUEST['year']) && is_int((int) $_REQUEST['year']) && $_REQUEST['year'] != 'null' ? htmlspecialchars($_REQUEST['year']) : null;

        $modelActivities = new ModelActivities();
        $downCalories = $modelActivities->getStatsDownCalories($this->currentUser['id'], $year);

        $modelFood = new ModelFood();
        $upCalories = $modelFood->getStatsUpCalories($this->currentUser['id'], $year);

        echo json_encode(['down' => $downCalories, 'up' => $upCalories]);
    }
}