<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-27
 * Time: 22:12
 */

use library\PigFramework\model\Config;
use resource\action\Base;
use resource\model\webService\components\UserWS;
use resource\orm\templates\CandidateChoseMapping;
use resource\orm\templates\Vote;

function changeToken($user)
{
    $user = new UserWS($user->userToken, $user->choseToken);

    $candidate = CandidateChoseMapping::getInstance()->findOne(['tokenMapping = ?' => $user->choseToken, 'NOW() < DATE_ADD(createDate, INTERVAL 5 MINUTE)']);
    $obj = new stdClass();

    if ($candidate->empty()) {
        $obj->status = 'error';
        $obj->message = 'Brak Wyborcy';
        return $obj;
    }

    $vote = Vote::getInstance()->findOne(['token = ?' => $user->userToken]);

    if ($vote->empty()) {
        $vote = Vote::getInstance()->createRecord();
        $vote->token = $user->userToken;
    }

    $vote->candidateId = $candidate->candidateId;
    $vote->save(['candidate']);

    $candidate->delete(['candidate']);

    $obj->status = 'success';
    $obj->message = 'Oddano głos na kandydata';
    return $obj;
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