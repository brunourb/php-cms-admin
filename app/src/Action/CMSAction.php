<?php
namespace App\Action;

use App\Resource\GenericResource;
use function Couchbase\defaultDecoder;
use Doctrine\ORM\EntityManager;
use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

final class CMSAction extends DefaultAction
{
    private $view;
    private $logger;
    private $genericResource;

    /**
     * CMSAction constructor.
     * @param Twig $view
     * @param LoggerInterface $logger
     * @param EntityManager $entityManager
     */
    public function __construct(Twig $view, LoggerInterface $logger,EntityManager $entityManager) {
        $this->view = $view;
        $this->logger = $logger;
        $this->genericResource = new GenericResource($entityManager);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $args) {
        $this->logger->info("Home page action dispatched");
        $this->view->render($response, 'home.twig');
        return $response;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function page(Request $request, Response $response, $args) {
        $this->logger->info("Page action dispatched");

        $page = $request->getUri()->getPath() == '/painel' ? explode("/", $request->getUri()->getPath())[1] : explode("/", $request->getUri()->getPath())[2];

        $data = $this->resource($page,$request,$response,$args);

        if($request->getParam('id') && !$request->isPost()){
            return $response->withStatus(200)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode($data));
        }else{

            $this->view->render($response, $page.'.twig', array("partials" => $page,"data" =>$data));

            return $response;
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed|string
     */
    public function resource($page, Request $request, Response $response, $args){
        return $this->genericResource->resourse($page,$request,$response,$args);
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
                    $data->moveTo("/tmp/$token.".pathinfo($data->getClientFilename(), PATHINFO_EXTENSION));
                }
            } catch (\Exception $e) {
                array_push($errors, 'Failed to upload '. $data->getClientFilename());
            }
        }
        return $response->withJson(['errors' => $errors], 200, JSON_PRETTY_PRINT);



        return $response;
    }
}
