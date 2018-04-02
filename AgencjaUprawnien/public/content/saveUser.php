<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-25
 * Time: 18:29
 */

namespace content;

use library\PigFramework\model\Config;
use resource\action\Base;
use resource\model\webServiceKW\KWConnector;
use resource\orm\templates\{
    User
};

class saveUser extends Base
{
    public function onAction()
    {
        $choseToken = $this->getParam('choseToken');

        if (empty($choseToken)) {
            $this->redirect();
        }

        $pesel = $this->getPost('pesel');

        if (empty($pesel)) {
            $this->redirect();
        }

        $user = User::getInstance()->findOne(['pesel = ?' => $pesel]);

        if ($user->empty()) {
            $this->redirect();
        }

        if (empty($user->token)) {
            $userToken = $this->getPost('userToken');
            $tokenId = $this->getPost('tokenId');

            $user->tokenId = $tokenId;
            $user->token = $userToken;
            $user->used = true;

            $user->save();
        }

        $KWConnector = KWConnector::getInstance();
        $response = $KWConnector->changeToken($user->token, $choseToken);

        $this->redirect(Config::getInstance()->getConfig('KomisjaWyborczaElectionsURL'), ['status' => $response->status, 'message' => $response->message]);
    }
}