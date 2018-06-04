<?php
/**
 * Created by IntelliJ IDEA.
 * User: bruno
 * Date: 25/02/18
 * Time: 19:00
 */

namespace App\Resource;


use App\Entity\Hotel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr\Join;
use Slim\Http\Request;
use Slim\Http\Response;

class HotelResource extends AbstractResource{

    public static $REPOSITORY = 'App\Entity\Hotel';


    /**
     * HotelResource constructor.
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
            $queryBuilder->select(array('h'))
                ->from(HotelResource::$REPOSITORY, 'h')
                ->where('h.id = :id')->setParameter('id',$request->getParam('id'));

            $query = $queryBuilder->getQuery();

            $data->hotelEdit = is_array($query->getArrayResult()) ? $query->getArrayResult()[0] : $query->getArrayResult();
        }
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->select('h')
            ->from(HotelResource::$REPOSITORY, 'h');

        $hotels = $queryBuilder->getQuery()->getArrayResult();
        $data->hotels = $hotels;

        return $data;
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function put(Request $request, $args) {
        $objHotel = new Hotel();
        $objHotel->setId($request->getParam("txtHotelEdit"));
        $objHotel->setDescription($request->getParam("txtDescription"));
        $objHotel->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);

        $this->entityManager->merge($objHotel);
        $this->entityManager->flush();
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function post(Request $request, $args) {

        $objHotel = new Hotel();
        $objHotel->setDescription($request->getParam("txtDescription"));
        $objHotel->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);

        $this->entityManager->persist($objHotel);
        $this->entityManager->flush();
    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    function delete(Request $request, $args) {
        $objHotel = $this->entityManager->getRepository(HotelResource::$REPOSITORY)->findOneBy(array('id' => $request->getParam('id')));
        $this->entityManager->remove($objHotel);
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