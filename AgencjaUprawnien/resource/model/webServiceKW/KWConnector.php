<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-03-08
 * Time: 19:48
 */

namespace resource\model\webServiceKW;

use library\PigFramework\model\Config;

class KWConnector
{
    /**
     * @var KWConnector
     */
    protected static $instance;

    public $client;

    protected function __construct()
    {
        $this->client = new \Zend_Soap_Client(Config::getInstance()->getConfig('KomisjaWyborczaWSDL'));
    }

    public static function getInstance(): KWConnector
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function changeToken($userToken, $choseToken)
    {
        $result = $this->client->changeToken(['userToken' => $userToken, 'choseToken' => $choseToken]);
        return json_decode($result->changeTokenResult);
    }
}