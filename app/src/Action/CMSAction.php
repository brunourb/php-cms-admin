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
        // TODO: Implement page() method.
    }
}
