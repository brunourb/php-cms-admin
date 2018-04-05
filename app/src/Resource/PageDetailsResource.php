<?php
/**
 * Created by IntelliJ IDEA.
 * User: bruno
 * Date: 25/02/18
 * Time: 18:50
 */

namespace App\Resource;


use App\Entity\PageDetails;
use Doctrine\ORM\EntityManager;
use Slim\Http\Request;
use Slim\Http\Response;

class PageDetailsResource extends AbstractResource {

    public static $REPOSITORY = 'App\Entity\PageDetails';

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
            $queryBuilder->select('p.id, p.description, p.value, p.enabled, IDENTITY(p.page) as page')
                ->from(PageDetailsResource::$REPOSITORY, 'p')
                ->where('p.id = :id')->setParameter('id',$request->getParam('id'));

            $query = $queryBuilder->getQuery();

            $data->pageEdit = is_array($query->getArrayResult()) ? $query->getArrayResult()[0] : $query->getArrayResult();

            $queryBuilder = $this->entityManager->createQueryBuilder();
            $queryBuilder->select('p')
                ->from(PageResource::$REPOSITORY,'p')
                ->where('p.id = :page')->setParameter('page',$data->pageEdit['page']);
            $query  = $queryBuilder->getQuery();

            $data->pageEdit['page'] = is_array($query->getArrayResult()) ? $query->getArrayResult()[0] : $query->getArrayResult();


        }

        $data->pagesDetails = $this->entityManager->getRepository(PageDetailsResource::$REPOSITORY)->findAll();
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
        $objPage = new PageDetails();
        $objPage->setId($request->getParam("txtPageDetailEdit"));
        $objPage->setDescription($request->getParams("txtDescription"));
        $objPage->setValue($request->getParam("txtValue"));
        $objPage->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);

        if($request->getParam('txtPage')){
            $menuEdit = $this->entityManager->getRepository(PageResource::$REPOSITORY)->findOneBy(array('id'=>$request->getParam('txtPage')));
            $objPage->setMenu($menuEdit);
        }

        $this->entityManager->merge($objPage);
        $this->entityManager->flush();

    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function post(Request $request, $args) {
        $objPage = new PageDetails();
        $objPage->setDescription($request->getParam("txtDescription"));
        $objPage->setValue($request->getParam("txtValue"));
        $objPage->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);

        if(intval($request->getParam('txtPage')) != 0){
            $page = $this->entityManager->getRepository(PageResource::$REPOSITORY)->findOneBy(array('id' => $request->getParam('txtPage')));
            $objPage->setPage($page);
        }

        $this->entityManager->persist($objPage);
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
        $objPage = $this->entityManager->getRepository(PageDetailsResource::$REPOSITORY)->findOneBy(array('id' => $request->getParam('id')));
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