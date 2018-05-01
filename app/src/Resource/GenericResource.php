<?php

namespace App\Resource;


use Doctrine\ORM\EntityManager;
use Slim\Http\Request;
use Slim\Http\Response;

class GenericResource extends AbstractResource {


    public $entityManager;

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
    public function resourse($page, Request $request, Response $response, $args){
        try{
            switch ($page){
                case 'menu':

                    $menuResource = new MenuResource($this->getEntityManager());
                    return $menuResource->service($request,$response,$args);

                    break;

                case 'page':

                    $pageResource = new PageResource($this->getEntityManager());
                    return $pageResource->service($request,$response,$args);

                    break;

                case'galllery':

                    $details = new PageDetailsResource($this->getEntityManager());
                    return $details->service($request,$response,$args);

                    break;

                case 'page-details':

                    $details = new PageDetailsResource($this->getEntityManager());
                    return $details->service($request,$response,$args);

                    break;

                case 'gallery':

                    $gallery = new GalleryResource($this->getEntityManager());
                    return $gallery->service($request,$response,$args);

                    break;

                case 'img-video':

                    $imgVideo = new ImageVideoResource($this->getEntityManager());
                    return $imgVideo->service($request,$response,$args);

                    break;

                case 'tag':

                    $tagResource = new TagResource($this->getEntityManager());
                    return $tagResource->service($request,$response,$args);

                    break;

                case 'tag-values':


                    break;

                case 'banner':

                    $bannerResource = new BannerResource($this->getEntityManager());
                    return $bannerResource->service($request,$response,$args);

                    break;

                case 'tariff':

                    $tariffResource = new TariffResource($this->getEntityManager());
                    return $tariffResource->service($request,$response,$args);

                    break;

                case 'hotel':

                    $hotelResource = new HotelResource($this->getEntityManager());
                    return $hotelResource->service($request,$response,$args);

                    break;

                case 'room':

                    $roomResource = new RoomResource($this->getEntityManager());
                    return $roomResource->service($request,$response,$args);

                    break;

                case 'room-values':

                    break;

                case 'upload':

                    break;

                default:

                    break;
            }
        }catch (\Exception $e){
            return $response->withStatus(500, utf8_decode($e->getMessage()));
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

    public function service(Request $request, Response $response, $args) {
        // TODO: Implement service() method.
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
    }
}