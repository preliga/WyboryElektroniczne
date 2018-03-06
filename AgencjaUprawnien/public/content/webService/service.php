<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-27
 * Time: 22:12
 */

use library\PigFramework\model\Config;
use resource\action\Base;
use resource\orm\templates\User;

function revokingElector($pesel)
{
    $elector = User::getInstance()->findOne(['pesel = ?' => $pesel]);

    if (!$elector->empty()) {

        $elector->isActive = 0;
        $elector->save();

        return true;
    }
    return false;
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
        $this->server->addFunction('revokingElector');
    }

    public function render()
    {
        $this->server->handle();
    }
}