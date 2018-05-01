<?php
/**
 * Created by IntelliJ IDEA.
 * User: bruno
 * Date: 25/02/18
 * Time: 21:13
 */

namespace App\Resource;


use App\Entity\BannerImageVideo;
use App\Entity\ImageVideo;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Slim\Http\Request;
use Slim\Http\Response;

class ImageVideoResource extends AbstractResource {

    public static $REPOSITORY = 'App\Entity\ImageVideo';

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
     * @throws OptimisticLockException
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
            $queryBuilder->select('iv')
                ->from(ImageVideoResource::$REPOSITORY, 'iv')
                ->where('iv.id = :id')->setParameter('id',$request->getParam('id'));

            $query = $queryBuilder->getQuery();

            $data->imgVideoEdit = is_array($query->getArrayResult()) ? $query->getArrayResult()[0] : $query->getArrayResult();
        }

        $galleries = $this->entityManager->getRepository(GalleryResource::$REPOSITORY)->findAll();
        $data->galleries = $galleries;

        return $data;

    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws OptimisticLockException
     */
    function put(Request $request, $args) {

        $objImageVideo = new ImageVideo();
        $objImageVideo->setId($request->getParam("txtImageVideoEdit"));
        $objImageVideo->setName($request->getParam("txtName"));
        $objImageVideo->setDescription($request->getParam("txtDescription"));
        $objImageVideo->setNameGenerate($request->getParam("txtNameGenerate"));
        $objImageVideo->setType($request->getParam("txtType"));
        $objImageVideo->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);
        $objImageVideo->setUrl($request->getParam("txtUrl"));

        $this->entityManager->merge($objImageVideo);
        $this->entityManager->flush();

    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws OptimisticLockException
     */
    function post(Request $request, $args) {

        $objImageVideo = new ImageVideo();
        $objImageVideo->setName($request->getParam("txtName"));
        $objImageVideo->setDescription($request->getParam("txtDescription"));
        $objImageVideo->setNameGenerate($request->getParam("txtNameGenerate"));
        $objImageVideo->setType($request->getParam("txtType"));
        $objImageVideo->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);
        $objImageVideo->setUrl($request->getParam("txtUrl"));

        $this->entityManager->persist($objImageVideo);
        $this->entityManager->flush();

        return $this->get($request,$args);

    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws OptimisticLockException
     */
    function delete(Request $request, $args) {
        $objImgVideo = $this->entityManager->getRepository(ImageVideoResource::$REPOSITORY)->findBy(array('id' => $request->getParam('id')));
        $this->entityManager->remove($objImgVideo);
        $this->entityManager->flush();

    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws OptimisticLockException
     */
    function path(Request $request, $args) {
        $this->put($request,$args);
    }
}