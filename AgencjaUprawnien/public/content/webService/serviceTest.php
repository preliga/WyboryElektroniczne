<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-27
 * Time: 22:12
 */

use resource\action\Base;
use resource\orm\templates\User;

function revokingElector($pesel)
{
    $elector = User::getInstance()->findOne(['pesel = ?' => $pesel]);

    $obj = new stdClass();

    if (!$elector->empty()) {

        $elector->isActive = 0;
        $elector->save(['token_list']);

        $obj->status = 'success';
        $obj->message = 'Głos wyborcy został uniważniony';
    } else {
        $obj->status = 'error';
        $obj->message = 'Brak Wyborcy o podanym numerze PESEL';
    }

    return $obj;
}


class serviceTest extends Base
{
    public function onAction()
    {
        revokingElector('4');
    }
}