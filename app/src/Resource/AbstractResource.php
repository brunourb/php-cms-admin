<?php

namespace App\Resource;


use Doctrine\ORM\EntityManager;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class AbstractResource {
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    public $entityManager = null;

    public function formatText($str){
        return iconv('UTF-8','ASCII//TRANSLIT',str_replace(' ', '', strtolower($str)));
    }


    abstract public function service(Request $request, Response $response, $args);

    /**
     * Get array copy of object
     *
     * @return array
     */
    public function getArrayCopy(){
        return get_object_vars($this);
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     */
    abstract function get(Request $request, $args);

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     */
    abstract function put(Request $request, $args);

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     */
    abstract function post(Request $request, $args);

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     */
    abstract function delete(Request $request, $args);

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     */
    abstract function path(Request $request, $args);
}