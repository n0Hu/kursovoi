<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelUser;

class ControllerRegister extends BaseController {
    public function action() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view->generate("view_register.php");
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new ModelUser();
            $result = $user->create($_REQUEST);
            if(isset($result['errors'])) {
                $this->view->generate("view_login.php", ['errors' => $result['errors']]);
            } else {
                header('Location: /confirmAccount');
            }
        }
    }

    public function haveEmail() {
        $user = new ModelUser();
        echo $user->isHaveEmail($_REQUEST['email']);
        die();
    }

    public function haveNickname() {
        $user = new ModelUser();
        echo $user->isHaveNickname($_REQUEST['nickname']);
    }
}