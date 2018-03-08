<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-25
 * Time: 22:21
 */

use resource\action\Base;
use resource\orm\templates\{
    Candidate
};

class elections extends Base
{
    public function onAction()
    {
        if ($this->hasParam('status') && $this->hasParam('message')) {
            $this->statement->pushStatement($this->getParam('status'), $this->getParam('message'));
        }

        $candidates = Candidate::getInstance()->find();

        $this->view->candidates = $candidates;
    }
}
