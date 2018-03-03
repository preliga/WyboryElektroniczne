<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-03-03
 * Time: 11:57
 */

namespace resource\model\webService\components;

class UserWS
{
    public $userToken;
    public $choseToken;

    public function __construct($userToken, $choseToken)
    {
        $this->userToken  = $userToken;
        $this->choseToken = $choseToken;
    }
}