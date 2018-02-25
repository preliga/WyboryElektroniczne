<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-25
 * Time: 19:32
 */

namespace resource\orm\templates;

use library\PigOrm\Record;
use resource\orm\baseTemplate;

class TokenList extends baseTemplate
{
    protected function createSelect(array $variable = []): \Zend_Db_Select
    {
        $select = $this->db->select()
            ->from(['t' => 'token_list'], []);

        return $select;
    }

    protected function createTreeDependency(): array
    {
        // kolumny łączone joinem muszą mieć takie same nazwy wtedy są scalane i updatowane automatycznie
        return
        [
            'keys' => [
                'tokenId' => 'id', // z aliasem !!!
            ],
            'tables' => [
                'token_list' => [
                    'alias' => 't',
                    'keys' => [
                        'tokenId' => 'id',
                    ],
                    'columns' => [
                        'tokenId' => 'id',
                        'token',
                        'used',
                    ],
                    'defaultValues' => [
                        'used' => 0
                    ]
                ]
            ]
        ];
    }

    public function getNextToken() : Record
    {
        return $this->findOne(['used = 0']);
    }
}