<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-25
 * Time: 18:30
 */

namespace resource\orm\templates;

use library\PigOrm\Collection;
use resource\orm\baseTemplate;

class Vote extends baseTemplate
{
    protected function createSelect(array $variable = []): \Zend_Db_Select
    {
        $select = $this->db->select()
            ->from(['v' => 'vote'], [])
            ->joinLeft(['c' => 'candidate'], 'c.id = v.candidateId', []);

        return $select;
    }

    public function beforeSaveCollection(Collection $collection, array $notTables = null, array $onlyTables = null)
    {
        foreach ($collection as $record) {
            $record->setSessionDateTime = date('Y-m-d H:i:s');
        }
    }

    protected function createTreeDependency(): array
    {
        // kolumny łączone joinem muszą mieć takie same nazwy wtedy są scalane i updatowane automatycznie
        return
        [
            'keys' => [
                'voteId' => 'v.id', // z aliasem !!!
            ],
            'tables' => [
                'vote' => [
                    'alias' => 'v',
                    'keys' => [   /// ustalić tylko jeden klucz
                        'voteId' => 'id',
                    ],
                    'columns' => [
                        'voteId' => 'id',
                        'token',
                        'candidateId',
                        'sessionToken',
                        'setSessionDateTime',
                    ],
                    'defaultValues' => [
                    ]
                ],
                'candidate' => [
                    'alias' => 'c',
                    'keys' => [
                        'candidateId' => 'id',
                    ],
                    'columns' => [
                        'candidateId' => 'id',
                        'name',
                        'secondName',
                        'lastName',
                        'electionCommittee',
                        'photo',
                    ],
                    'defaultValues' => [
                    ]
                ]
            ]
        ];
    }
}