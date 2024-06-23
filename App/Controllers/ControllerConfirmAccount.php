<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelUser;

class ControllerConfirmAccount extends BaseController {
    public function action() {
        $arrURN = mb_split('/', $_SERVER['PATH_INFO']);
        $uniqID = count($arrURN) == 3 ? $arrURN[2] : null;

        if($uniqID) {
            $user = new ModelUser();
            $result = $user->acceptAccount($uniqID);
            $this->view->generate("view_confirm_account.php", ['user' => $this->currentUser, 'isConfirm' => $result], null);
        } else {
            $this->view->generate("view_confirm_account.php", ['user' => $this->currentUser], null);
        }
    }
}