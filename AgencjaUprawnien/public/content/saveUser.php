<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-25
 * Time: 18:29
 */

use library\PigFramework\model\Config;
use resource\action\Base;
use resource\orm\templates\{
    User, TokenList
};

class saveUser extends Base
{
    public function onAction()
    {
        $pesel = $this->getPost('pesel');

        if (empty($pesel)) {
            $this->redirect(Config::getInstance()->getConfig('homeURL'), [], false, "Brak numeru PESEL.");
        }

        $user = User::getInstance()->findOne(['pesel = ?' => $pesel]);

        if ($user->empty()) {
            $this->redirect(Config::getInstance()->getConfig('homeURL'), [], false, "Brak osoby o podanym numerze PESEL");
        }

        if (empty($user->token)) {
            $token = TokenList::getInstance()->getNextToken();

            if ($token->empty()) {
                $this->redirect(Config::getInstance()->getConfig('homeURL'), [], false, "Brak wolnego tokenu do zapisu");
            }

            $user->tokenId = $token->tokenId;
            $user->save(['token_list'], ['user']);

            $token->used = 1;
            $token->save();
        }

        $client       = new SoapClient(Config::getInstance()->getConfig('KomisjaWyborczaWSDL'), [
            'trace'      => 1,
            'cache_wsdl' => WSDL_CACHE_NONE
        ]);
        $sessionToken = $client->changeToken($user->token);

        $this->redirect(Config::getInstance()->getConfig('KomisjaWyborczaElectionsURL'), ['sessionToken' => $sessionToken]);
    }
}