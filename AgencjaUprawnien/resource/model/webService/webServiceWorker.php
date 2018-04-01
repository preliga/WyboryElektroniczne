<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-04-01
 * Time: 16:59
 */

namespace resource\model\webService;


use resource\orm\templates\CandidateChoseMapping;
use resource\orm\templates\User;
use resource\orm\templates\Vote;

class webServiceWorker
{
    function revokingElector($pesel)
    {
        return ['revokingElectorResult' => 'test'];


        $elector = User::getInstance()->findOne(['pesel = ?' => $pesel]);

        $obj = new \stdClass();

        if (!$elector->empty()) {

            $elector->isActive = 0;
            $elector->save(['token_list']);

            $obj->status = 'success';
            $obj->message = 'Głos wyborcy został uniważniony';
        } else {
            $obj->status = 'error';
            $obj->message = 'Brak Wyborcy o podanym numerze PESEL';
        }

        return ['revokingElectorResult' => json_encode($obj)];
    }

    function getValidTokens()
    {
        $users =  User::getInstance()->find(['used = ?' => 1, 'isActive = ?' => 1]);

        $tokens = [];

        foreach ($users as $user) {
            $tokens[] = $user->token;
        }

        return ['getValidTokensResult' => json_encode($tokens)];
    }
}