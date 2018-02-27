<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-25
 * Time: 23:28
 */

use library\PigFramework\model\Config;
use resource\action\Base;
use resource\orm\templates\{
    Vote as VoteTemplate
};
class vote extends Base
{
    public function onAction()
    {
        $sessionToken = $this->getParam('sessionToken');

        $vote = \resource\orm\templates\Vote::getInstance()->findOne(['sessionToken = ?' => $sessionToken, 'NOW() < DATE_ADD(setSessionDateTime, INTERVAL 5 MINUTE)']);

        if ($vote->empty()) {
            $this->redirect(\library\PigFramework\model\Config::getInstance()->getConfig('AgencjaUprawnienURL'));
        }

        $candidateId = $this->getPost('candidateId');

        if (is_null($candidateId)) {
            $this->redirect(Config::getInstance()->getConfig('homeURL'), [], false, "Nie wybrano kandydata.");
        }

        $vote->candidateId = $candidateId;
        $vote->sessionToken = null;
        $vote->save(['candidate']);

        $this->redirect(Config::getInstance()->getConfig('homeURL'),[],true,"Oddano głos na kandydata: {$vote->name} {$vote->secondName} {$vote->lastName}");
    }
}