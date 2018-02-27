<?php
/**
 * Created by PhpStorm.
 * User: preliga
 * Date: 2018-02-26
 * Time: 14:26
 */

use resource\action\Base;
use \resource\orm\templates\Vote;

class results extends Base
{
    public function onAction()
    {
        $this->addJS('/scripts/lib/Chart.bundle.min.js');
    }
}