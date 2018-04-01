<?php

/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 2018-02-27
 * Time: 22:12
 */

namespace content\webService;

use library\PigFramework\model\Config;
use resource\action\Base;

//use resource\orm\templates\CandidateChoseMapping;
//use resource\orm\templates\Vote;
//class My_Soap_LiteralDocumentProxy
//{
//    public function changeToken($user)
//    {
//        $candidate = CandidateChoseMapping::getInstance()->findOne(['tokenMapping = ?' => $user->choseToken, 'NOW() < DATE_ADD(createDate, INTERVAL 5 MINUTE)']);
//        $obj = new \stdClass();
//
//        if ($candidate->empty()) {
//            $obj->status = 'error';
//            $obj->message = 'Brak Wyborcy';
//            return ['changeTokenResult' => json_encode($obj)];
//        }
//
//        $vote = Vote::getInstance()->findOne(['token = ?' => $user->userToken]);
//
//        if ($vote->empty()) {
//            $vote = Vote::getInstance()->createRecord();
//            $vote->token = $user->userToken;
//        }
//
//        $vote->candidateId = $candidate->candidateId;
//        $vote->save(['candidate']);
//
//        $candidate->delete(['candidate']);
//
//        $obj->status = 'success';
//        $obj->message = 'Oddano głos na kandydata';
//
//        return ['changeTokenResult' => json_encode($obj)];
//    }
//}

class service extends Base
{
//    public function init()
//    {
//        parent::init();
//        ini_set("soap.wsdl_cache_enabled", "0");
//    }

    public function onAction()
    {
        if ($this->hasParam('wsdl')) {
            $wsdl = new \Zend_Soap_AutoDiscover(); // It generates the WSDL

            $wsdl->setOperationBodyStyle(array(
                'use' => 'literal'
            ));

            $wsdl->setBindingStyle(array(
                'style' => 'document'
            ));

            $wsdl->setClass('resource\model\webService\wsdlDocumentation');

            $wsdl->handle();
            exit();
        } else {
            $server = new \Zend_Soap_Server(Config::getInstance()->getConfig('KomisjaWyborczaWSDL'));
            $server->setClass('resource\model\webService\webServiceWorker');
//            $server->setClass('content\webService\My_Soap_LiteralDocumentProxy');
            $server->handle();
            exit();
        }
    }
}