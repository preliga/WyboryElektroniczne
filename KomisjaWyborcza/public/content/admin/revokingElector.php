<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-03-06
 * Time: 20:24
 */

use resource\action\Admin;
use library\PigFramework\model\Config;

class revokingElector extends Admin
{
    public function onAction()
    {
        if ($this->hasPost('pesel')) {
            $client = new SoapClient(Config::getInstance()->getConfig('AgencjaWyborczaWSDL'), [
                'trace'      => 1,
                'cache_wsdl' => WSDL_CACHE_NONE
            ]);

            $response = $client->revokingElector($this->getPost('pesel'));

            if ($response) {
                $this->statement->pushStatement('success', 'Wyborca został uniważniony');
            } else {
                $this->statement->pushStatement('error', 'Brak wyborcy po podanym numerze PESEL');
            }
        }
    }
}