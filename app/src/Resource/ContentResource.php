<?php
/**
 * Created by IntelliJ IDEA.
 * User: bruno
 * Date: 25/02/18
 * Time: 21:13
 */

namespace App\Resource;


use App\Entity\BannerImageVideo;
use App\Entity\Content;
use App\Entity\ImageVideo;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Slim\Http\Request;
use Slim\Http\Response;

class ContentResource extends AbstractResource {

    public static $REPOSITORY = 'App\Entity\Content';

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

        $imgVideo = explode("/",$request->getUri()->getPath())[3];

        if($request->getParam('id')){
            //TODO remove duplicate code
            $queryBuilder = $this->entityManager->createQueryBuilder();
            $queryBuilder->select(array('c'))
                ->from(ContentResource::$REPOSITORY, 'c')
                ->where('c.id = :id')->setParameter('id',$request->getParam('id'));

            $query = $queryBuilder->getQuery();

            $data->contentEdit = is_array($query->getArrayResult()) ? $query->getArrayResult()[0] : $query->getArrayResult();
        }
        elseif(isset($imgVideo)){
            $queryBuilder = $this->entityManager->createQueryBuilder();
            $queryBuilder->select(array('c','img'))
                ->from(ContentResource::$REPOSITORY, 'c')
                ->innerJoin('c.imageVideo','img')
                ->where('c.imageVideo = :id')->setParameter('id',$imgVideo);

            $query = $queryBuilder->getQuery();

            $data->contentEdit = $query->getArrayResult();
        }

        return $data;

    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws OptimisticLockException
     */
    function put(Request $request, $args) {

        $objContent = $this->entityManager->getRepository(ContentResource::$REPOSITORY)->findOneBy(array('id' => $request->getParam('txtContentEdit')));

        if($request->getParam("txtDescription")!=null){
            $objContent->setDescription($request->getParam("txtDescription"));
        }

        if($request->getParam("txtTitle")!=null){
            $objContent->setTitle($request->getParam("txtTitle"));
        }

        if($request->getParam("txtCaption")!=null){
            $objContent->setCaption($request->getParam("txtCaption"));
        }

        if($request->getParam("txtUrl")!=null){
            $objContent->setUrl($request->getParam("txtUrl"));
        }

        $this->entityManager->merge($objContent);
        $this->entityManager->flush();

    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws OptimisticLockException
     * @throws \Exception
     */
    function post(Request $request, $args) {

        $objImageVideo = new ImageVideo();
        $objImageVideo->setName($request->getParam("txtName"));
        $objImageVideo->setDescription($request->getParam("txtDescription"));
        $objImageVideo->setType(explode("/",$request->getUri()->getPath())[2]);
        $objImageVideo->setEnabled((bool)$request->getParam('chkStatus') ? 1 : 0);
        $objImageVideo->setUrl(count(explode("v=",$request->getParam("txtUrl")))>1 ? explode("v=",$request->getParam("txtUrl"))[1] : $request->getParam("txtUrl") );

        if(intval($request->getParam('txtGallery')) != 0){
            $objGallery = $this->entityManager->getRepository(GalleryResource::$REPOSITORY)->findOneBy(array('id' => $request->getParam('txtGallery')));
            $objImageVideo->setGallery($objGallery);
        }else{
            throw new \Exception("Galeria não informada");
        }

        $this->entityManager->persist($objImageVideo);
        $this->entityManager->flush();

        //$this->upload($request);

        return $this->get($request,$args);

    }

    /**
     * @param Request $request
     * @param $args
     * @return mixed
     * @throws OptimisticLockException
     */
    function delete(Request $request, $args) {
        $obj = $this->entityManager->getRepository(ContentResource::$REPOSITORY)->findOneBy(array('id' => $request->getParam('id')));
        $this->entityManager->remove($obj);
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

    /**
     * @param $gallery
     * @param $filename
     * @param $token
     * @param $ext
     */
    public function createThumbnail($gallery, $filename, $token, $ext){

        // Set a maximum height and width
        $width = 200;
        $height = 200;

        // Get new dimensions
        list($width_orig, $height_orig) = getimagesize($filename);

        $ratio_orig = $width_orig/$height_orig;

        if ($width/$height > $ratio_orig) {
            $width = $height*$ratio_orig;
        } else {
            $height = $width/$ratio_orig;
        }

        // Resample
        $image_p = imagecreatetruecolor($width, $height);
        $image = null;

        if(preg_match('/[.](jpg)$/', $filename)) {
            $image = imagecreatefromjpeg($filename);
        } else if (preg_match('/[.](gif)$/', $filename)) {
            $image = imagecreatefromgif($filename);
        } else if (preg_match('/[.](png)$/', $filename)) {
            $image = imagecreatefrompng($filename);
        }


        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

        // Output
        $imageThumb = sprintf('%s/thumb_%s.%s',$gallery,$token,$ext);
        imagejpeg($image_p, $imageThumb, 100);

    }
}