<?php

namespace App\Resource;


use Doctrine\ORM\EntityManager;
use Slim\Http\Request;
use Slim\Http\Response;

class GenericResource extends AbstractResource {


    protected $entityManager;

    protected $resource;

    /**
     * GenericResource constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Request $page
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed|string
     */
    public function service($page, Request $request, Response $response, $args){

        switch ($page){
            case 'menu':

                $menuResource = new MenuResource($this->entityManager);
                //$this->resource =
                break;

            case 'page':

                break;

            case 'page-details':

                break;

            case 'img-video':

                break;

            case 'tag':

                break;

            case 'tag-values':

                break;

            case 'banner':

                break;

            case 'tariff':

                break;

            case 'hotel':

                break;

            case 'room':

                break;

            case 'room-values':

                break;

            case 'upload':

                break;

            default:

                break;
        }



        switch ($request->getMethod()){

            case HTTP_POST:
                return $this->post($request,$args);
                break;

            case HTTP_GET:
                return $this->get($request,$args);
                break;

            case HTTP_PUT:
                return $this->put($request,$args);
                break;

            case HTTP_DELETE:
                return $this->delete($request,$args);
                break;

            case HTTP_PATCH:
                return $this->path($request,$args);
                break;

            default:
                return "erro";

                break;
        }

    }


    /**
     * @param Request $request
     * @param $args
     * @return mixed
     */
    function get(Request $request, $args) {
        // TODO: Implement put() method.
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