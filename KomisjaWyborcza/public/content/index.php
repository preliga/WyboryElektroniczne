<?php

use resource\action\Base;

class index extends Base
{
    public function onAction()
    {
        $this->redirect('/elections');
    }
}
