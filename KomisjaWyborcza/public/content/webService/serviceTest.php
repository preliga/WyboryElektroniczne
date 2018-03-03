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

class serviceTest extends Base
{
    public function onAction()
    {

        $userToken = "afba5c1a94a5a1b4a9c83700c49e09b4dfbc82fa7c913b87b1e36d01bc7ed4fd";
        
        $choseToken = "297d9e7027a61c8f47a8671234c6e8b7976dba0b";

        $user = new UserWS($userToken, $choseToken);

        $tokenManager = new TokenManager();

        $tokenManager->changeToken($user);
    }
}