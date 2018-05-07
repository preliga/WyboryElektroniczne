<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-03-06
 * Time: 20:24
 */

namespace content\admin;

use resource\action\Admin;
use resource\model\webServiceAU\AUConnector;
use resource\orm\templates\Admin as AdminTemplate;

class revokingElector extends Admin
{
    public function onAction()
    {

        if ($this->hasPost()) {

            $adminOne = AdminTemplate::getInstance()->getAdmin($this->getPost('login_one'), $this->getPost('password_one'));
            $adminTwo = AdminTemplate::getInstance()->getAdmin($this->getPost('login_two'), $this->getPost('password_two'));
            $adminThree = AdminTemplate::getInstance()->getAdmin($this->getPost('login_three'), $this->getPost('password_three'));

            if (empty($adminOne) || empty($adminTwo) || empty($adminThree)) {
                $this->statement->pushStatement('error', "Błędne dane autoryzacyjne");
                return;
            }


            $AUConnector = AUConnector::getInstance();

            $response = $AUConnector->revokingElector($this->getPost('pesel'));
            $this->statement->pushStatement($response->status, $response->message);
        }
    }
}