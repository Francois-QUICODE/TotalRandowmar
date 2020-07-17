<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Lord;
use App\Repository\LordRepository;
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
        $lord = $lordRepository->FindRandomLordByGame(4);



        if (isset($lord)) {
            return $this->render('main/randomLord.html.twig', [
                'lord' => $lord,
            ]);
        } else {
            return $this->render('main/randomLordNoLord.html.twig');

        }

    }
}
