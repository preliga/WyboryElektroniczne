<?php

use resource\action\Base;
use library\PigFramework\model\Config;

class index extends Base
{

    public function onAction()
    {
        if (!$this->hasParam('choseToken')) {
            $this->redirect(Config::getInstance()->getConfig('KomisjaWyborczaElectionsURL'), ['status' => 'error', 'message' => 'Brak głosu']);
        }

        $choseToken = $this->getParam('choseToken');
        $this->view->choseToken = $choseToken;
    }

}
