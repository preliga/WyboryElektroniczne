<?php

use library\PigFramework\model\Config;
use resource\action\Base;

class index extends Base {

    public function onAction() {
        $this->view->agancjaUprawnienURL = Config::getInstance()->getConfig( 'AgencjaUprawnienURL' );
    }
}
