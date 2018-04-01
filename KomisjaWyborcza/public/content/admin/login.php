<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-03-06
 * Time: 18:52
 */

namespace content\admin;

use resource\action\Base;
use resource\orm\templates\Admin;

class login extends Base
{
    public function permissionBase()
    {
        $admin = Admin::getInstance()->getAdminBySession();

        if (!empty($admin) && !$admin->empty()) {
            $this->redirect('/admin/index', []);
        }
    }

    public function onAction()
    {
        if ($this->getPost()) {
            if ($this->hasPost('login') && $this->hasPost('password')) {
                $result = Admin::getInstance()->login($this->getPost('login'), $this->getPost('password'));

                if ($result) {
                    $this->redirect($this->url);
                } else {
                    $this->statement->pushStatement('error', 'Błędny login lub hasło');
                }

            } else {
                $this->statement->pushStatement('error', 'Sesja wygasła');
            }
        }
    }
}
