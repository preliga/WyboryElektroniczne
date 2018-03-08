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
    CandidateChoseMapping, Vote as VoteTemplate
};

class vote extends Base
{
    public function onAction()
    {
        $candidateId = $this->getPost('candidateId');

        if (is_null($candidateId)) {
            $this->redirect(Config::getInstance()->getConfig('homeURL'), [], false, "Nie wybrano kandydata.");
        }

        $candidateChoseMapping = CandidateChoseMapping::getInstance()->createRecord();
        $candidateChoseMapping->candidateId = $candidateId;
        $candidateChoseMapping->save(['candidate'], [], false);

        $this->redirect(Config::getInstance()->getConfig('AgencjaUprawnienURL/authorization'), ['choseToken' => $candidateChoseMapping->tokenMapping]);
    }
}