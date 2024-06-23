<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelUser;

class ControllerProfile extends BaseController {
    public function action() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view->generate("view_profile.php", ['user' => $this->currentUser]);
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new ModelUser();
            $result = $user->update($this->currentUser['id'], $_REQUEST);
            if(isset($result['errors'])) {
                $this->view->generate("view_profile.php", ['user' => $this->currentUser, 'errors' => $result['errors']]);
            } else {
                header('Location: /profile');
            }
        }
    }
}