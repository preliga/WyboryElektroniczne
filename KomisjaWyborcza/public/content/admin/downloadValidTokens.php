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
use resource\orm\templates\Settings;

/**
 * Class downloadValidTokens
 *
 * @package content\admin
 * @Route("/admin/downloadValidTokens")
 */
class downloadValidTokens extends Admin
{
    public function onAction()
    {
        if (Settings::getInstance()->getSettings('votingEnable') == 1) {
            $this->redirect('/admin/voting', [], true, 'Wybory muszą być wyłączone');
        }

        $tokens = AUConnector::getInstance()->getValidTokens();

        $this->registry->db
            ->update('vote', ['isActive' => 1], ['token IN (?)' => $tokens]);

        $this->registry->db
            ->update('vote', ['isActive' => 0], ['token NOT IN (?)' => $tokens]);

        Settings::getInstance()->setSettings('importTokenList', true);

        $this->redirect('/admin/voting', [], true, 'Zaktualizowano bazę aktywnych głosów');
    }
}