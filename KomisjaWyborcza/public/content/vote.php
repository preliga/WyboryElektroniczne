<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-25
 * Time: 23:28
 */

namespace content;

use library\PigFramework\model\Config;
use resource\action\Base;
use resource\model\Crypter;
use resource\orm\templates\{
    CandidateChoseMapping
};

class vote extends Base
{
    public function onAction()
    {
        $candidateId = $this->getPost('candidateId');

        if (is_null($candidateId)) {
            $this->redirect(Config::getInstance()->getConfig('homeURL'), [], false, "Nie wybrano kandydata.");
        }

        $crypter = new Crypter(
            file_get_contents(Config::getInstance()->getConfig('publicKeyPath'))
        );

        $candidateChoseMapping = CandidateChoseMapping::getInstance()->createRecord();
        $candidateChoseMapping->candidateId = $crypter->encrypt($candidateId);
        $candidateChoseMapping->save(['candidate'], [], false);

        $this->redirect(Config::getInstance()->getConfig('AgencjaUprawnienURL/authorization'), ['choseToken' => $candidateChoseMapping->tokenMapping]);
    }
}