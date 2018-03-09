<?php

use resource\action\Base;
use resource\orm\templates\Settings;

class index extends Base
{
    public function onAction()
    {
        $this->view->votingEnable = Settings::getInstance()->getSettings('votingEnable');
    }
}
