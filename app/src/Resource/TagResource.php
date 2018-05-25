<?php
/**
 * Created by IntelliJ IDEA.
 * User: bruno
 * Date: 25/02/18
 * Time: 18:54
 */

namespace App\Resource;


use App\Entity\Tag;
use App\Entity\TagValues;
use Doctrine\ORM\EntityManager;
use Slim\Http\Request;
use Slim\Http\Response;

class TagResource extends AbstractResource {


    public static $TAG_REPOSITORY = 'App\Entity\Tag';
    public static $TAG_VALUE_REPOSITORY = 'App\Entity\TagValues';

    /**
     * TagResource constructor.
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
            $queryBuilder->select('t')
                ->from(TagResource::$REPOSITORY, 't')
                ->join('t.page','p')
                ->where('t.id = :id')->setParameter('id',$request->getParam('id'));

            $query = $queryBuilder->getQuery();

            $data->tagEdit = is_array($query->getArrayResult()) ? $query->getArrayResult()[0] : $query->getArrayResult();
        }

        $pages = $this->entityManager->getRepository(PageResource::$REPOSITORY)->findAll();
        $data->pages = $pages;
        return $data;
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function put(Request $request, $args) {
        $objTag = new Tag();
        $objTag->setId($request->getParam("txtTagEdit"));
        $objTag->setTag($request->getParam("txtTag"));
        $objTag->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);
        $objPage =  $this->entityManager->getRepository(PageResource::$REPOSITORY)->findOneBy(array('id' => $request->getParam('txtPage')));
        $objTag->setPage($objPage);

        $this->entityManager->merge($objTag);
        $this->entityManager->flush();


        $objTagValues =  $this->entityManager->getRepository(TagResource::$TAG_VALUE_REPOSITORY)->findOneBy(array('tag' => $request->getParam("txtTagEdit")));
        $objTagValues->setTag($objTag);
        $objTagValues->setValue($request->getParam("txtTagValues"));

        $this->entityManager->merge($objTagValues);
        $this->entityManager->flush();
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function post(Request $request, $args) {
        $objTag = new Tag();
        $objTag->setTag($request->getParam("txtTag"));
        $objTag->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);
        $objPage =  $this->entityManager->getRepository(PageResource::$REPOSITORY)->findOneBy(array('id' => $request->getParam('txtPage')));
        $objTag->setPage($objPage);

        $this->entityManager->merge($objTag);
        $this->entityManager->flush();

        $objTagValues =  new TagValues();
        $objTagValues->setTag($objTag);
        $objTagValues->setValue($request->getParam("txtTagValues"));

        $this->entityManager->merge($objTagValues);
        $this->entityManager->flush();
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function delete(Request $request, $args) {

        $objTag = $this->entityManager->getRepository(TagResource::$REPOSITORY)->findOneBy(array('id' => $request->getParam('id')));
        $objTagValues =  $this->entityManager->getRepository(TagResource::$TAG_VALUE_REPOSITORY)->findOneBy(array('tag' => $objTag->getId()));

        $this->entityManager->remove($objTagValues);
        $this->entityManager->remove($objTag);
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