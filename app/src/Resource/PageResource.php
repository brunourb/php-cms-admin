<?php
/**
 * Created by IntelliJ IDEA.
 * User: bruno
 * Date: 25/02/18
 * Time: 18:49
 */

namespace App\Resource;


use App\Entity\Page;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr\Join;
use Slim\Http\Request;
use Slim\Http\Response;

class PageResource extends AbstractResource{


    public static $REPOSITORY = 'App\Entity\Page';

    /**
     * PageResource constructor.
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
            $queryBuilder->select("p.id,p.name,p.name_clean, p.menu, p.enabled,")
                ->from(PageResource::$REPOSITORY, 'p')
                ->join(MenuResource::$REPOSITORY,'m', Join::WITH,'p.menu = m.id')
                ->where('m.id = :id')->setParameter('id',$request->getParam('id'));

            $query = $queryBuilder->getQuery();

            $data->pageEdit = $query->getArrayResult();
        }

        $data->menus = $this->entityManager->getRepository(MenuResource::$REPOSITORY)->findAll();
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
        $objPage = new Page();
        $objPage->setId($request->getParam("txtPageEdit"));
        $objPage->setName($request->getParam('txtName'));
        $objPage->setNameClean($request->getParam('txtNameClean'));
        $objPage->setDescription($request->getParam('txtDescricao'));
        $objPage->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);

        if($request->getParam('txtMenu')){
            $menuEdit = $this->entityManager->getRepository($this->REPOSITORY)->findOneBy(array('id'=>$request->getParam('txtMenu')));
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
        $objPage = new Page();
        $objPage->setName($request->getParam('txtName'));
        $objPage->setNameClean($request->getParam('txtNameClean'));
        $objPage->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);
        if(intval($request->getParam('txtMenu')) != 0){
            $menu = $this->entityManager->getRepository(MenuResource::$REPOSITORY)->findOneBy(array('id' => $request->getParam('txtMenu')));
            $objPage->setMenu($menu);
        }

        $this->entityManager->persist($objPage);
        $this->entityManager->flush();

        return $this->get($request,$args);
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