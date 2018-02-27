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

        if($request->getParam("id")!=null){
            $menuEdit = $this->entityManager->getRepository($this->REPOSITORY)->findOneBy(array('id'=>$request->getParam('id')));
            $data->menuEdit = $menuEdit;
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
        $objMenu->setDescription($request->getParam('txtDescricao'));
        $objMenu->setEnabled(true);
        $objMenu->setMenu($request->getParam('chkStatus'));

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
        $objMenu->setDataCreated(new \DateTime());
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
        $objMenu = $this->entityManager->getRepository($this->REPOSITORY)->findOneBy(array('id' => $request->getParam('txtMenu')));
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