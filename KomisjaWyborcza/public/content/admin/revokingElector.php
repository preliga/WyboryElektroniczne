<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-03-06
 * Time: 20:24
 */

use resource\action\Admin;
use resource\model\webServiceAU\AUConnector;

class revokingElector extends Admin
{
    public function onAction()
    {
        if ($this->hasPost('pesel')) {
            $AUConnector = AUConnector::getInstance();

            $response = $AUConnector->revokingElector($this->getPost('pesel'));

            $this->statement->pushStatement($response->status, $response->message);
        }
    }
}