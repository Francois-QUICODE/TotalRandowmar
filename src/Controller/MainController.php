<?php

namespace App\Controller;

use App\Entity\Lord;
use App\Repository\LordRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function index()
    {
        return $this->render('main/index.html.twig', [
 
        ]);
    }

    /**
     * @route("/randomlord", name="random_lord")
     */
    public function randomLord(LordRepository $lordRepository)
    {
        $lord = $lordRepository->getRandomLord();

        return $this->render('main/randomLord.html.twig', [
            'lord' => $lord ,
        ]);
    }
}
