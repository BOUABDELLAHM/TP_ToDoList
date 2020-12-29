<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(): Response
    {
        // Test de l'utilisateur

        $dateToday = new DateTime('now');
        $dateNaissance = $dateToday->sub(new \DateInterval('P30Y'))->format('Y-m-d');
        $user = new User(
            'BOUABDELLAH',
            'Marwane',
            'manbou92@hotmail.fr',
            'azerty123',
            "$birthday"
        );

        $newDate = new DateTime();
        $choiceToday = new DateTime('2020-12-25 19:36:00');

        $diffDate = $newDate->diff($choiceToday);
        $difference = $diffDate->format('%H:%I');
        if ($difference > '02:30') {
            echo "Jour";
        }
        return $this->render('test/index.html.twig');
    }
}
