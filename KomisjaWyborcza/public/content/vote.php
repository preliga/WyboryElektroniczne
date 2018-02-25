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
        $candidateId = $this->getPost('candidateId');

        if (empty($candidateId)) {
            $this->redirect(Config::getInstance()->getConfig('homeURL'), [], false, "Nie wybrano kandydata.");
        }

        $vote = VoteTemplate::getInstance()->createRecord();

        $vote->candidateId = $candidateId != 0 ? $candidateId : null;
        $vote->token = "XXXXXX";

        $vote->save(['candidate']);

        $this->redirect(Config::getInstance()->getConfig('homeURL'),[],true,"Oddano głos na kandydata: {$vote->name} {$vote->secondName} {$vote->lastName}");
    }
}