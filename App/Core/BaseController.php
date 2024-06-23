<?php
namespace App\Core;

use App\Models\ModelUser;

/**
 * @property null $currentUser
 */
abstract class BaseController {
    protected $view;
    protected $currentUser = null;

    function __construct() {
        $this->view = new BaseView();
        $this->checkAuth();
    }

    protected function checkAuth() {
        if(isset($_SERVER['PATH_INFO']) && in_array(mb_split('/', $_SERVER['PATH_INFO'])[1], ['login', 'register', 'confirmAccount', 'haveNickname', 'haveEmail'])) return;

        if(empty($_SESSION['id'])) {
            header('Location: /login');
        } else {
            $User = new ModelUser();
            $currentUser = $User->getByID($_SESSION['id']);
            if(empty($currentUser)) {
                header('Location: /login');
                die();
            }

            $this->currentUser = $currentUser[0];
            if($this->currentUser['isConfirm'] == 0) header('Location: /confirmAccount');
        }
    }

    abstract function action();
}
?>