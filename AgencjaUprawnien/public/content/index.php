<?php

namespace content;

use library\PigFramework\model\Config;
use resource\action\Base;
use resource\orm\templates\TokenList;

class index extends Base
{
    public function onAction()
    {
        if (!$this->hasParam('choseToken')) {
            $this->redirect(Config::getInstance()->getConfig('KomisjaWyborczaElectionsURL'), ['status' => 'error', 'message' => 'Błąd autoryzacji']);
        }

        $token = TokenList::getInstance()->getNextToken();
        $token->used = 1;
        $token->save();
        $this->view->token = $token;

        $choseToken = $this->getParam('choseToken');
        $this->view->choseToken = $choseToken;
    }

}
