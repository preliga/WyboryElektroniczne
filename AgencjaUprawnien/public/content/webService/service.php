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

    $obj = new stdClass();

    if (!$elector->empty()) {

        $elector->isActive = 0;
        $elector->save(['token_list']);

        $obj->status = 'success';
        $obj->message = 'Głos wyborcy został uniważniony';
    } else {
        $obj->status = 'error';
        $obj->message = 'Brak Wyborcy o podanym numerze PESEL';
    }

    return $obj;
}

function getValidTokens()
{
    $users =  User::getInstance()->find(['used = ?' => 1, 'isActive = ?' => 1]);

    $tokens = [];

    foreach ($users as $user) {
        $tokens[] = $user->token;
    }

    return $tokens;
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
        $this->server->addFunction('getValidTokens');
    }

    public function render()
    {
        $this->server->handle();
    }
}