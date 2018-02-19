<?php
namespace App\Action;

use App\Resource\PageResource;
use Doctrine\ORM\EntityManager;
use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

final class CMSAction extends DefaultAction
{
    private $view;
    private $logger;
    private $pageResource;

    public function __construct(Twig $view, LoggerInterface $logger,EntityManager $entityManager) {
        $this->view = $view;
        $this->logger = $logger;
        $this->pageResource = new PageResource($entityManager);
    }

    public function __invoke(Request $request, Response $response, $args) {
        $this->logger->info("Home page action dispatched");
        $this->view->render($response, 'home.twig');
        return $response;
    }

    public function page(Request $request, Response $response, $args) {
        $this->logger->info("Page action dispatched");
        $page = $request->getUri()->getPath() == '/painel' ? explode("/", $request->getUri()->getPath())[1] : explode("/", $request->getUri()->getPath())[2];
        $this->view->render($response, $page.'.twig', array("partials" => $page));
        return $response;
    }

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
