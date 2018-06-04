<?php
/**
 * Created by IntelliJ IDEA.
 * User: bruno
 * Date: 25/02/18
 * Time: 19:00
 */

namespace App\Resource;


use Doctrine\ORM\EntityManager;
use Slim\Http\Request;
use Slim\Http\Response;

class RoomResource extends AbstractResource{


    public static $ROOM_REPOSITORY = 'App\Entity\Room';
    public static $ROOM_VALUES_REPOSITORY = 'App\Entity\RoomValues';

    /**
     * RoomResource constructor.
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
            $queryBuilder->select(array('r','h'))
                ->from(RoomResource::$ROOM_REPOSITORY, 'r')
                ->join('r.hotel','h')
                ->where('r.id = :id')->setParameter('id',$request->getParam('id'));

            $query = $queryBuilder->getQuery();

            $data->roomEdit = is_array($query->getArrayResult()) ? $query->getArrayResult()[0] : $query->getArrayResult();
        }

        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->select(array('r','h'))
            ->from(RoomResource::$ROOM_REPOSITORY, 'r')
            ->join('r.hotel','h');

        $rooms = $queryBuilder->getQuery()->getArrayResult();
        $data->rooms = $rooms;

        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->select('t')
            ->from(TariffResource::$REPOSITORY,'t');
        $tariffs = $queryBuilder->getQuery()->getArrayResult();
        $data->tariffs = $tariffs;

        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->select('h')
            ->from(HotelResource::$REPOSITORY,'h');
        $hotels = $queryBuilder->getQuery()->getArrayResult();
        $data->hotels = $hotels;


        return $data;
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
}