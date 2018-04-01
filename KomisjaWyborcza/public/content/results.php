<?php
/**
 * Created by PhpStorm.
 * User: preliga
 * Date: 2018-02-26
 * Time: 14:26
 */

namespace content;

use resource\action\Base;
use resource\orm\templates\Settings;

class results extends Base
{
    public function onAction()
    {
        $this->addJS('/scripts/lib/Chart.bundle.min.js');

        if (Settings::getInstance()->getSettings('votingEnable') == 1) {
            $this->redirect();
        }
    }
}