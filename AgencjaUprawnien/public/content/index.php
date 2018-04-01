<?php

namespace content;

use library\PigFramework\model\Config;
use resource\action\Base;

class index extends Base
{

    public function onAction()
    {
        if (!$this->hasParam('choseToken')) {
            $this->redirect(Config::getInstance()->getConfig('KomisjaWyborczaElectionsURL'), ['status' => 'error', 'message' => 'Błąd autoryzacji']);
        }

        $choseToken = $this->getParam('choseToken');
        $this->view->choseToken = $choseToken;
    }

}
