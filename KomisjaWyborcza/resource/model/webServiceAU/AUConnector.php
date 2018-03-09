<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-03-08
 * Time: 19:48
 */

namespace resource\model\webServiceAU;

use library\PigFramework\model\Config;

class AUConnector
{
    /**
     * @var AUConnector
     */
    protected static $instance;

    public $client;

    protected function __construct()
    {
        $this->client = new \SoapClient(Config::getInstance()->getConfig('AgencjaWyborczaWSDL'), [
            'trace'      => 1,
            'cache_wsdl' => WSDL_CACHE_NONE
        ]);

    }

    public static function getInstance(): AUConnector
    {
        if(empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function revokingElector($pesel)
    {
        return $this->client->revokingElector($pesel);
    }

    public function getValidTokens()
    {
        $tokens = $this->client->getValidTokens();

        if (!empty($tokens)) {
            return $tokens->string;
        } else {
            return null;
        }
    }
}