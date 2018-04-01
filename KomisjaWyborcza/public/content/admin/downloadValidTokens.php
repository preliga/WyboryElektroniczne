<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-03-08
 * Time: 23:18
 */

namespace content\admin;

use resource\action\Admin;
use resource\model\webServiceAU\AUConnector;

class downloadValidTokens extends Admin
{
    public function onAction()
    {
        $tokens = AUConnector::getInstance()->getValidTokens();

        $this->registry->db
            ->update('vote', ['isActive' => 1], ['token IN (?)' => $tokens]);

        $this->registry->db
            ->update('vote', ['isActive' => 0], ['token NOT IN (?)' => $tokens]);

        $this->redirect('/admin/voting', [], true, 'Zaktualizowano bazę aktywnych głosów');
    }
}