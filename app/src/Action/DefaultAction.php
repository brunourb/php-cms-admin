<?php
namespace App\Action;

use App\Util\Access;
use Slim\Http\Request;

class DefaultAction {

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