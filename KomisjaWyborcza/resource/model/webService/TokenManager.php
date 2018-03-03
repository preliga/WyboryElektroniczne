<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-27
 * Time: 22:36
 */

namespace resource\model\webService;

use resource\model\webService\components\UserWS;
use resource\orm\templates\CandidateChoseMapping;
use resource\orm\templates\Vote;

class TokenManager
{
    public function changeToken(UserWS $user)
    {
        $candidate = CandidateChoseMapping::getInstance()->findOne(['tokenMapping = ?' => $user->choseToken, 'NOW() < DATE_ADD(createDate, INTERVAL 5 MINUTE)']);

        if ($candidate->empty()) {
            return "Brak kandydata";
        }
        
        $vote = Vote::getInstance()->createRecord();

        $vote->token = $user->userToken;
        $vote->candidateId = $candidate->candidateId;
        $vote->save(['candidate']);

        $candidate->delete(['candidate']);

        return "OK";
    }
}