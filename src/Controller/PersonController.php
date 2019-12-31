<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Person;
use Psr\Log\LoggerInterface;

class PersonController extends AbstractController
{
    /**
     * @Route("/person", name="person")
     */
    public function index(LoggerInterface $logger)
    {
        $logger->info('fetching objects...');

        $persons = $this->getDoctrine()
        ->getRepository(Person::class)
        ->findAll();

        if (!$persons) {
          throw $this->createNotFoundException(
            'No persons found'
          );
        }

        $names = array();


        /* @var $person Person */
        foreach ($persons as $person) {
            $names[] = $person->getName();

            // code...
        }

        return $this->render('person/index.html.twig', [
            'controller_name' => 'PersonController',
            'persons' => implode('-', $names)
        ]);
    }
}
