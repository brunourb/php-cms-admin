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
            $queryBuilder = $this->entityManager->createQueryBuilder();
            $queryBuilder->select('t')
                ->from(TariffResource::$REPOSITORY,'t')
                ->where('t.id = :id')->setParameter('id',$request->getParam('id'));

            $query = $queryBuilder->getQuery();
            $data->tariffEdit = is_array($query->getArrayResult()) ? $query->getArrayResult()[0] : $query->getArrayResult();
        }


        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->select('t')->from(TariffResource::$REPOSITORY,'t');
        $query = $queryBuilder->getQuery();
        $tariffs = $query->getArrayResult();
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
        $objTariff->setDateInit(DateTime::createFromFormat('Y-m-d',$this->convert2Date($request->getParam("from"))));
        $objTariff->setDateEnd(DateTime::createFromFormat('Y-m-d',$this->convert2Date($request->getParam("to"))));
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
        $objTariff->setDateInit(DateTime::createFromFormat('Y-m-d',$this->convert2Date($request->getParam("from"))));
        $objTariff->setDateEnd(DateTime::createFromFormat('Y-m-d',$this->convert2Date($request->getParam("to"))));
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

    private function convert2Date($date){
        $data = explode("/",$date);
        return sprintf('%s-%s-%s',$data[2],$data[1],$data[0]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response|static
     */
    public function upload(Request $request, Response $response) {

        $errors = [];

        $files = $request->getUploadedFiles();

        foreach ($files as $data) {
            try {
                if (empty($data->file)) {
                    throw new Exception('Expected a newfile');
                }

                if ($data->getError() === UPLOAD_ERR_OK) {
                    $uploadFileName = $data->getClientFilename();
                    $token = md5(uniqid(rand(), true));

                    $idGaleria = explode("/",$request->getParam("pathName"))[3];
                    $diretorioUpload = $_SERVER['DOCUMENT_ROOT']."/website/assets/img/img-gallery/$idGaleria";
                    $diretorioUploadThumb = $diretorioUpload.'/thumb';

                    if(!is_dir($diretorioUpload)){
                        mkdir($diretorioUpload,0775);
                        mkdir($diretorioUploadThumb,0775);
                    }

                    $arquivo = sprintf("%s/%s.%s",$diretorioUpload,$token,pathinfo($data->getClientFilename(), PATHINFO_EXTENSION));

                    $content = new Content();
                    $content->setNameGenerate(sprintf("%s.%s",$token,pathinfo($data->getClientFilename(), PATHINFO_EXTENSION)));
                    $content->setDescription($uploadFileName);

                    $imgVideo = $this->entityManager->getRepository(ImageVideoResource::$REPOSITORY)->findOneBy(array("id"=>$idGaleria));
                    $content->setImageVideo($imgVideo);

                    $this->entityManager->persist($content);
                    $this->entityManager->flush();

                    $data->moveTo($arquivo);
                    $this->createThumbnail($diretorioUploadThumb,$arquivo,$token,pathinfo($data->getClientFilename(), PATHINFO_EXTENSION));

                }
            } catch (\Exception $e) {
                array_push($errors, 'Failed to upload '. $data->getClientFilename());
                return $response->withJson(['errors' => $errors], 500, JSON_PRETTY_PRINT);
            }
        }

        return $response;
    }
}