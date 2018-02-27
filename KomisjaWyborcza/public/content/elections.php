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
        $sessionToken = $this->getParam('sessionToken');

        $vote = \resource\orm\templates\Vote::getInstance()->findOne(['sessionToken = ?' => $sessionToken, 'NOW() < DATE_ADD(setSessionDateTime, INTERVAL 5 MINUTE)']);

        if ($vote->empty()) {
            $this->redirect(\library\PigFramework\model\Config::getInstance()->getConfig('AgencjaUprawnienURL'));
        }

        $this->view->sessionToken = $sessionToken;

        $candidates = Candidate::getInstance()->find();

        $this->view->candidates = $candidates;
    }

}
