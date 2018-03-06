<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-03-06
 * Time: 19:16
 */

namespace resource\orm\templates;


use library\PigFramework\model\Session;
use library\PigOrm\Record;
use resource\orm\baseTemplate;

class Admin extends baseTemplate
{
    protected function createSelect(array $variable = []): \Zend_Db_Select
    {
        $select = $this->db->select()
                           ->from(['a' => 'admin'], [])
                           ->join(['g' => 'group'], 'g.id = a.groupId');

        return $select;
    }

    protected function createTreeDependency(): array
    {
        // kolumny łączone joinem muszą mieć takie same nazwy wtedy są scalane i updatowane automatycznie
        return
            [
                'keys' => [
                    'adminId' => 'a.id', // z aliasem !!!
                ],
                'tables' => [
                    'admin' => [
                        'alias' => 'a',
                        'keys' => [   /// ustalić tylko jeden klucz
                            'adminId' => 'id',
                        ],
                        'columns' => [
                            'adminId' => 'id',
                            'groupId',
                            'login',
                            'password',
                            'sessionId',
                            'sessionCreate',
                        ],
                        'defaultValues' => [
                        ]
                    ],
                    'group' => [
                        'alias' => 'g',
                        'keys' => [   /// ustalić tylko jeden klucz
                            'groupId' => 'id',
                        ],
                        'columns' => [
                            'groupId' => 'id',
                            'name',
                        ],
                        'defaultValues' => [
                        ]
                    ],
                ]
            ];
    }

    public function login($login, $password) : bool
    {
        $admin = $this->findOne(['login = ?' => $login]);

        $result = password_verify($password, $admin->password);

        if ($result) {
            $sessionId = session_create_id();

            $admin->sessionId = $sessionId;
            $admin->sessionCreate = date('Y-m-d H:i:s');
            $admin->save();

            Session::set('sessionId', $sessionId);
        }

        return $result;
    }

    public function logout()
    {
        $admin = $this->getAdminBySession();

        if (!empty($admin) && !$admin->empty()) {
            $admin->sessionId = null;
            $admin->sessionCreate = null;
            $admin->save();

            Session::set('sessionId', null);
        }
    }

    public function getAdminBySession()
    {
        if (empty(Session::get('sessionId'))) {
            return null;
        }

        $admin = $this->findOne(['sessionId = ?' => Session::get('sessionId'), 'NOW() < DATE_ADD(sessionCreate, INTERVAL 5 MINUTE)']);

        return $admin;
    }
}