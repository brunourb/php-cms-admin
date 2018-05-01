<?php
/**
 * Created by IntelliJ IDEA.
 * User: bruno
 * Date: 25/02/18
 * Time: 18:50
 */

namespace App\Resource;


use App\Entity\Gallery;
use App\Entity\PageDetails;
use Doctrine\ORM\EntityManager;
use Slim\Http\Request;
use Slim\Http\Response;

class GalleryResource extends AbstractResource {

    public static $REPOSITORY = 'App\Entity\Gallery';

    /**
     * PageDetailsResource constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed|string
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function service(Request $request, Response $response, $args) {
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

        $data = new \stdClass();

        if($request->getParam('id')!=null){
            $queryBuilder = $this->entityManager->createQueryBuilder();
            $queryBuilder->select('g')
                ->from(GalleryResource::$REPOSITORY, 'p')
                ->where('g.id = :id')->setParameter('id',$request->getParam('id'));

            $query = $queryBuilder->getQuery();

            $data->galleryEdit = is_array($query->getArrayResult()) ? $query->getArrayResult()[0] : $query->getArrayResult();
        }

        $galleries = $this->entityManager->getRepository(GalleryResource::$REPOSITORY)->findAll();
        $data->galleries = $galleries;

        return $data;

    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function put(Request $request, $args) {

        $objGallery = new Gallery();
        $objGallery->setId($request->getParam("txtGalleryEdit"));
        $objGallery->setDescription($request->getParams("txtDescription"));
        $objGallery->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);

        $this->entityManager->merge($objGallery);
        $this->entityManager->flush();

    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function post(Request $request, $args) {
        $objGallery = new Gallery();
        $objGallery->setDescription($request->getParam("txtDescription"));
        $objGallery->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);

        $this->entityManager->persist($objGallery);
        $this->entityManager->flush();

        return $this->get($request,$args);
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function delete(Request $request, $args) {
        $objPage = $this->entityManager->getRepository(GalleryResource::$REPOSITORY)->findOneBy(array('id' => $request->getParam('id')));
        $this->entityManager->remove($objPage);
        $this->entityManager->flush();
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