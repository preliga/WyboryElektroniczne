<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-03-07
 * Time: 20:01
 */

namespace content\admin;

use resource\action\Admin;
use resource\orm\templates\Settings;

class voting extends Admin
{
    public function onAction()
    {
//        $settings = Settings::getInstance()->getSettings();
//        $this->view->settings = $settings;
    }
}