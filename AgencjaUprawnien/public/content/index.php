<?php

use resource\action\Base;

class index extends Base
{

    public function onAction()
    {
        $choseToken = $this->getParam('choseToken');
        $this->view->choseToken = $choseToken;
    }

}
