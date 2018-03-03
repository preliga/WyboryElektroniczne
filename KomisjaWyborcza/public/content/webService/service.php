<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-27
 * Time: 22:12
 */

use library\PigFramework\model\Config;
use resource\action\Base;
use resource\model\webService\TokenManager;
use resource\model\webService\components\UserWS;

function changeToken($user)
{
    $user = new UserWS($user->userToken, $user->choseToken);

    $tokenManager = new TokenManager();

    return $tokenManager->changeToken($user);
}

class service extends Base
{
    protected $server;

    public function init()
    {
        parent::init();
        ini_set("soap.wsdl_cache_enabled", "0");
    }

    public function onAction()
    {
        $this->server = new SoapServer(Config::getInstance()->getConfig('pathWSDL'));
        $this->server->addFunction('changeToken');
    }

    public function render()
    {
        $this->server->handle();
    }
}