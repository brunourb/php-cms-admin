<?php
namespace App\Action;

use App\Resource\PageResource;
use Doctrine\ORM\EntityManager;
use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

final class HomeAction
{
    private $view;
    private $logger;
    private $pageResource;

    /**
     * HomeAction constructor.
     * @param Twig $view
     * @param LoggerInterface $logger
     * @param EntityManager $entityManager
     */
    public function __construct(Twig $view, LoggerInterface $logger, EntityManager $entityManager) {
        $this->view = $view;
        $this->logger = $logger;
        $this->pageResource = new PageResource($entityManager);
    }

    public function __invoke(Request $request, Response $response, $args)
    {
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

        $data = $this->pageResource->get($request, $args);
        $this->view->render($response, $data->template, array('data' => $data->response));

        return $response;
    }

}
