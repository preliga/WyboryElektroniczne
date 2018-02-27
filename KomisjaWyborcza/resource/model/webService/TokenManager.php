<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-27
 * Time: 22:36
 */

namespace resource\model\webService;

use resource\orm\templates\Vote;

class TokenManager
{
    public function changeToken($token)
    {
        $user = Vote::getInstance()->findOne(['token = ?' => $token]);

        if ($user->empty()) {
            $user        = Vote::getInstance()->createRecord();
            $user->token = $token;
        }

        $user->sessionToken = $this->generateToken();
        $user->save([], ['vote'], false);

        return $user->sessionToken;
    }

    private function generateToken()
    {
        return sha1(uniqid());
    }
}