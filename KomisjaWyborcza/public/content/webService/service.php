<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-27
 * Time: 22:12
 */

namespace content\webService;

use library\PigFramework\model\Config;
use resource\action\Base;

class service extends Base
{
    public function onAction()
    {
        if ($this->hasParam('wsdl')) {
            $wsdl = new \Zend_Soap_AutoDiscover(); // It generates the WSDL

            $wsdl->setOperationBodyStyle(array(
                'use' => 'literal'
            ));

            $wsdl->setBindingStyle(array(
                'style' => 'document'
            ));

            $wsdl->setClass('resource\model\webService\wsdlDocumentation');

            $wsdl->handle();
            exit();
        } else {
            $server = new \Zend_Soap_Server(Config::getInstance()->getConfig('KomisjaWyborczaWSDL'));
            $server->setClass('resource\model\webService\webServiceWorker');
            $server->handle();
            exit();
        }
    }
}