<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelUser;

class ControllerLogin extends BaseController {
    public function action() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view->generate("view_login.php");
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new ModelUser();
            $result = $user->checkAuth($_REQUEST);
            if(isset($result['errors'])) {
                $this->view->generate("view_login.php", ['errors' => $result['errors']]);
            }
        }
    }
}