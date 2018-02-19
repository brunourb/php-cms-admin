<?php
namespace App\Action;

use App\Util\Access;
use Slim\Http\Request;

class DefaultAction {

    public function getPage(Request $request){
        return $request->getUri()->getPath() == '/painel' ? explode("/", $request->getUri()->getPath())[1] : explode("/", $request->getUri()->getPath())[2];
    }

    public function isAuthorized(Request $request){
        if($request->getHeader('Authorization')!=null && count($request->getHeader('Authorization')[0])){
            $autorization = $request->getHeader('Authorization')[0];
            return $autorization == Access::$AUTHORIZATION;
        }
        else{
            return false;
        }
    }

}