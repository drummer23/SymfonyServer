<?php
namespace App\Controller;
use App\Service\ExampleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Psr\Log\LoggerInterface;
class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky", name="lucky")
     */
    public function index(LoggerInterface $logger, Request $request)
    {
        $page = $request->query->get('page', 1);
        $logger->info("page is " . $page);
        return $this->render('lucky/index.html.twig', [
            'controller_name' => 'LuckyController',
        ]);
    }


    /**
     * @Route("/lucky/session", name="session")
     */
    public function session(LoggerInterface $logger, SessionInterface $session)
    {
        $counter = $session->get('counter');
        $counter++;
        $session->set('counter', $counter);
        return new Response('Reload Counter is '.$counter);
    }


    /**
     * @Route("/lucky/number", name="number")
     */
    public function number(LoggerInterface $logger)
    {
        $logger->info('we are logging');
        $number = random_int(0,100);
        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);
    }

}