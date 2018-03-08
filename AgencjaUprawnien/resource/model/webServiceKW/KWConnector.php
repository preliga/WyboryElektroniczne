<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-03-08
 * Time: 19:48
 */

namespace resource\model\webServiceKW;

use library\PigFramework\model\Config;
use resource\model\webServiceKW\components\UserWS;

class KWConnector
{
    /**
     * @var KWConnector
     */
    protected static $instance;

    public $client;

    protected function __construct()
    {
        $this->client = new \SoapClient(Config::getInstance()->getConfig('KomisjaWyborczaWSDL'), [
            'trace'      => 1,
            'cache_wsdl' => WSDL_CACHE_NONE
        ]);
    }

    public static function getInstance(): KWConnector
    {
        if(empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function changeToken($userToken, $choseToken)
    {
        return $this->client->changeToken(new UserWS($userToken, $choseToken));
    }
}