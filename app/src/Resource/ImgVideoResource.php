<?php
/**
 * Created by IntelliJ IDEA.
 * User: bruno
 * Date: 25/02/18
 * Time: 18:50
 */

namespace App\Resource;


use Slim\Http\Request;
use Slim\Http\Response;

class ImgVideoResource extends AbstractResource {


    /**
     * ImgVideoResource constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }


    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     */
    public function service(Request $request, Response $response, $args) {
        // TODO: Implement service() method.
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     */
    function get(Request $request, $args) {
        // TODO: Implement get() method.
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     */
    function put(Request $request, $args) {
        // TODO: Implement put() method.
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     */
    function post(Request $request, $args) {
        // TODO: Implement post() method.
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     */
    function delete(Request $request, $args) {
        // TODO: Implement delete() method.
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     */
    function path(Request $request, $args) {
        // TODO: Implement path() method.
    }
}