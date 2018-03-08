<?php
/**
 * Created by IntelliJ IDEA.
 * User: bruno
 * Date: 25/02/18
 * Time: 18:49
 */

namespace App\Resource;


use App\Entity\Menu;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr\Join;
use Slim\Http\Request;
use Slim\Http\Response;

class MenuResource extends AbstractResource{

    protected $REPOSITORY = 'App\Entity\Menu';

    /**
     * MenuResource constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

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
            $queryBuilder->select("m.id,m.description,m.enabled, IDENTITY(m.menu) as parent")
                ->from($this->REPOSITORY, 'm')
                ->join($this->REPOSITORY,'m1', Join::WITH,'m.id = m1.id')
                ->where('m.id = :id')->setParameter('id',$request->getParam('id'));




            //$queryBuilder->select('m')->from($this->REPOSITORY,'m')->where('m.id = :id')->setParameter('id',$request->getParam('id'));
            //$menuEdit = $this->entityManager->getRepository($this->REPOSITORY)->findOneBy(array('id'=>$request->getParam('id')));

            $query = $queryBuilder->getQuery();

            $data->menuEdit = $query->getArrayResult();

            //$data->menuEdit = $menuEdit->toArray();
        }
        $menus = $this->entityManager->getRepository($this->REPOSITORY)->findAll();
        $data->menus = $menus;
        return $data;
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function put(Request $request, $args) {
        $objMenu = new Menu();
        $objMenu->setId($request->getParam("txtMenuEdit"));
        $objMenu->setDescription($request->getParam('txtDescricao'));
        $objMenu->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);

        if($request->getParam('txtMenu')){
            $menuEdit = $this->entityManager->getRepository($this->REPOSITORY)->findOneBy(array('id'=>$request->getParam('txtMenu')));
            $objMenu->setMenu($menuEdit);
        }

        $this->entityManager->merge($objMenu);
        $this->entityManager->flush();
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function post(Request $request, $args) {
        $objMenu = new Menu();
        $objMenu->setDescription($request->getParam('txtDescricao'));
        $objMenu->setEnabled($request->getParam('chkStatus') == 'A' ? true : false );
        if(intval($request->getParam('txtMenu')) != 0){
            $parent = $this->entityManager->getRepository($this->REPOSITORY)->findOneBy(array('id' => $request->getParam('txtMenu')));
            $objMenu->setMenu($parent);
        }

        $this->entityManager->persist($objMenu);
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
        $objMenu = $this->entityManager->getRepository($this->REPOSITORY)->findOneBy(array('id' => $request->getParam('id')));
        $this->entityManager->remove($objMenu);
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