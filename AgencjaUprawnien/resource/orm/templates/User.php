<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-25
 * Time: 18:30
 */

namespace resource\orm\templates;

use resource\orm\baseTemplate;

class User extends baseTemplate
{
    protected function createSelect(array $variable = []): \Zend_Db_Select
    {
        $select = $this->db->select()
            ->from(['u' => 'user'], [])
            ->joinLeft(['t' => 'token_list'], 'u.tokenId = t.id', []);

        return $select;
    }

    protected function createTreeDependency(): array
    {
        // kolumny łączone joinem muszą mieć takie same nazwy wtedy są scalane i updatowane automatycznie
        return
            [
                'keys' => [
                    'userId' => 'u.id', // z aliasem !!!
                ],
                'tables' => [
                    'user' => [
                        'alias' => 'u',
                        'keys' => [   /// ustalić tylko jeden klucz
                            'userId' => 'id',
                        ],
                        'columns' => [
                            'userId' => 'id',
                            'name',
                            'secondName',
                            'lastName',
                            'birthDate',
                            'pesel',
                            'fatherName',
                            'motherName',
                            'tokenId',
                        ],
                        'defaultValues' => [
                            'tokenId' => null
                        ]
                    ],
                    'token_list' => [
                        'alias' => 't',
                        'keys' => [
                            'tokenId' => 'id',
                        ],
                        'columns' => [
                            'tokenId' => 'id',
                            'token',
                            'used',
                            'isActive',
                        ],
                        'defaultValues' => [
                            'used' => 0,
                            'isActive' => 1
                        ]
                    ]
                ]
            ];
    }
}