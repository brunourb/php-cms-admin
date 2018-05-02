<?php
/**
 * Created by IntelliJ IDEA.
 * User: bruno
 * Date: 25/02/18
 * Time: 18:59
 */

namespace App\Resource;


use App\Entity\Tariff;
use DateTime;
use Doctrine\ORM\EntityManager;
use Slim\Http\Request;
use Slim\Http\Response;

class TariffResource extends AbstractResource{

    public static $REPOSITORY = 'App\Entity\Tariff';

    /**
     * TariffResource constructor.
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
            $data->tariffEdit = $this->entityManager->getRepository(TariffResource::$REPOSITORY)->findOneBy(array('id'=>$request->getParam('id')));
        }

        $tariffs = $this->entityManager->getRepository(TariffResource::$REPOSITORY)->findAll();
        $data->tariffs = $tariffs;

        return $data;

    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function put(Request $request, $args) {
        $objTariff = new Tariff();
        $objTariff->setId($request->getParam("txtTariffEdit"));
        $objTariff->setDescription($request->getParam("txtDescription"));
        $objTariff->setDateInit($request->getParam("txtDateInit"));
        $objTariff->setDateEnd($request->getParam("txtDateEnd"));
        $objTariff->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);

        $this->entityManager->merge($objTariff);
        $this->entityManager->flush();
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function post(Request $request, $args) {
        $objTariff = new Tariff();
        $objTariff->setDescription($request->getParam("txtDescription"));
        $objTariff->setDateInit(new DateTime(date('Y-d-m',strtotime($request->getParam('from')))));
        $objTariff->setDateEnd(new DateTime(date('Y-d-m',strtotime($request->getParam('to')))));
        $objTariff->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);

        $this->entityManager->persist($objTariff);
        $this->entityManager->flush();
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function delete(Request $request, $args) {
        $objTariff = $this->entityManager->getRepository(TariffResource::$REPOSITORY)->findOneBy(array('id' => $request->getParam('id')));
        $this->entityManager->remove($objTariff);
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