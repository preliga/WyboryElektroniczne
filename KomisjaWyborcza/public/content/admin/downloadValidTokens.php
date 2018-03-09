<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-03-08
 * Time: 23:18
 */

use \resource\action\Admin;
use \resource\model\webServiceAU\AUConnector;

class downloadValidTokens extends Admin
{
    public function onAction()
    {
        $x = AUConnector::getInstance()->getValidTokens();



        die(var_dump($x));
    }
}