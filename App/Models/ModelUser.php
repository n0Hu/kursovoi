<?php

namespace App\Models;

use App\Core\BaseModel;
use App\Core\MailBuilder;

class ModelUser extends BaseModel {
    public $model = 'users';

    public function create($data)
    {
        foreach ($data as &$value) {
            $value = htmlspecialchars($value);
        }

        $id = $this->sendSQLGetID("
            INSERT INTO users (email, nickname, password, surname, name, middle_name, age, gender)
            VALUE (
                :email,
                :nickname,
                :password,
                :surname,
                :name,
                :middle_name,
                :age,
                :gender
            )
        ", [
            'email' => $data['email'],
            'nickname' => $data['nickname'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
            'surname' => $data['surname'],
            'name' => $data['name'],
            'middle_name' =>  strlen($data['middle_name']) > 0 ? $data['middle_name'] : null,
            'age' => strlen($data['age']) > 0 ? $data['age'] : null,
            'gender' => $data['gender']
        ]);

        $_SESSION['id'] = $id;

        $urn = $this->createEmailLink($id);
        $mail = new MailBuilder();
        $mail->sendEmail($data['email'], $data['nickname'], "Confirm account", "For confirm account follow the link ".$_SERVER['HTTP_HOST'] . "/confirmAccount/" . $urn);
        mail($data['email'], "Confirm account", "For confirm account follow the link ".$_SERVER['HTTP_HOST'] . "/confirmAccount/" . $urn); // Специально для OpenServer

        return null;
    }

    public function update($id, $data) {
        foreach ($data as &$value) {
            $value = htmlspecialchars($value);
        }

        if($data['old-password'] && $data['password']) {
            $password = $this->sendSQLGetData("SELECT password FROM users WHERE id = :id", ['id' => $id]);
            $password = !empty($password) ? $password[0]['password'] : null;

            if(password_verify($data['old-password'], $password)) {
                $this->sendSQL("
                    UPDATE users 
                    SET
                        password = :password,
                        surname = :surname,
                        name = :name,
                        middle_name = :middle_name,
                        age = :age,
                        gender = :gender
                    WHERE id = :id
                ", [
                    'id' => $id,
                    'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                    'surname' => $data['surname'],
                    'name' => $data['name'],
                    'middle_name' => strlen($data['middle_name']) > 0 ? $data['middle_name'] : null,
                    'age' => strlen($data['age']) > 0 ? $data['age'] : null,
                    'gender' => $data['gender']
                ]);
            } else {
                return ['errors' => ['Пароль введен не верно']];
            }
        } else {
            $this->sendSQL("
                UPDATE users 
                SET
                    surname = :surname,
                    name = :name,
                    middle_name = :middle_name,
                    age = :age,
                    gender = :gender
                WHERE id = :id
            ", [
                'id' => $id,
                'surname' => $data['surname'],
                'name' => $data['name'],
                'middle_name' => strlen($data['middle_name']) > 0 ? $data['middle_name'] : null,
                'age' => strlen($data['age']) > 0 ? $data['age'] : null,
                'gender' => $data['gender']
            ]);
        }

        return [];
    }

    public function checkAuth($data) {
        $user = $this->sendSQLGetData("SELECT id, nickname, password, isConfirm FROM users WHERE nickname = :nickname", [ 'nickname' => htmlspecialchars($data['nickname']) ]);
        if(empty($user)) return ['errors' => ['Ошибка авторизации']];

        $user = $user[0];
        if(!password_verify(htmlspecialchars($data['password']), $user['password'])) return ['errors' => ['Ошибка авторизации']];
        if(!$user['isConfirm']) return ['errors' => ['Ваш аккаунт не подтвержден']];

        $_SESSION['id'] = $user['id'];
        header('Location: /');
        return true;
    }

    public function isHaveEmail($email) {
        $email = htmlspecialchars($email);
        return !empty($this->sendSQLGetData("SELECT 1 FROM users WHERE email = :email", ['email' => $email]));
    }

    public function isHaveNickname($nickname) {
        $nickname = htmlspecialchars($nickname);
        return !empty($this->sendSQLGetData("SELECT 1 FROM users WHERE nickname = :nickname", ['nickname' => $nickname]));
    }

    public function createEmailLink($id) {
        $urn = uniqid();
        $this->sendSQL("INSERT INTO temp_urn_for_accept_account(user_id, urn) VALUE(:user_id, :urn)", ['user_id' => $id, 'urn' => $urn]);

        return $urn;
    }

    public function acceptAccount($urn) {
        $recordTempURN = $this->sendSQLGetData("SELECT id, user_id, urn FROM temp_urn_for_accept_account WHERE urn = :urn", ['urn' => $urn]);
        if(!empty($recordTempURN)) {
            $this->sendSQL("UPDATE users SET isConfirm = 1 WHERE id = :user_id", ['user_id' => $recordTempURN[0]['user_id']]);
            $this->sendSQL("DELETE FROM temp_urn_for_accept_account WHERE id = :id", ['id' => $recordTempURN[0]['id']]);
            return true;
        } else {
            return false;
        }
    }
}