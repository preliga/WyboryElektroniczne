<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-05-06
 * Time: 20:54
 */

namespace content\admin\voting;

use library\PigFramework\model\Config;
use resource\action\Admin;
use resource\model\Crypter;
use resource\orm\templates\{
    Settings, Vote
};

class decryptVotes extends Admin
{
    public function onAction()
    {
        if (Settings::getInstance()->getSettings('votingEnable') == 1) {
            $this->redirect('/admin/voting', [], true, 'Wybory muszą być wyłączone');
        }

        $crypter = new Crypter(
            file_get_contents(Config::getInstance()->getConfig('publicKeyPath')),
            file_get_contents(Config::getInstance()->getConfig('privateKeyPath'))
        );

        $votes = Vote::getInstance()->find(['isActive = 1', 'length(candidateId) = 172']);

        foreach ($votes as $vote) {
            $vote->candidateId = strtok($crypter->decrypt($vote->candidateId), '_');
            $vote->save();
        }

        Settings::getInstance()->setSettings('decryptVote', true);

        $this->redirect('/admin/voting', [], true, 'Odszyfrowano głosy');
    }
}