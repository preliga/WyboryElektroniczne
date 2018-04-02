<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-25
 * Time: 22:21
 */

namespace content;

use resource\action\Base;
use resource\orm\templates\{
    Candidate
};

/**
 * Class elections
 *
 * @Route("/elections")
 */
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
