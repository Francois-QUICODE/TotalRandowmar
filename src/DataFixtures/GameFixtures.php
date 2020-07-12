<?php

namespace App\DataFixtures;

use App\Entity\Dlc;
use App\Entity\Game;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GameFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $gameTww = new Game();
        $gameTww->setName('Tw-Warhammer Serie')->setDescription('La série de warhammer');
        $manager->persist($gameTww);
        
        $TwwDlc1 = new Dlc();
        $TwwDlc1->setGame($gameTww)->setName('Premier DLC')->setDescription('Le DLC 1 de Warhammer');
        $manager->persist($TwwDlc1);
        
        $TwwDlc2 = new Dlc();
        $TwwDlc2->setGame($gameTww)->setName('Second DLC')->setDescription('Le DLC 2 de Warhammer');
        $manager->persist($TwwDlc2);
        
        $gameTwtruc = new Game();
        $gameTwtruc->setName('Tw-truc Serie')->setDescription('La série de truc');
        $manager->persist($gameTwtruc);
        
        $TwtrucDlc1 = new Dlc();
        $TwtrucDlc1->setGame($gameTwtruc)->setName('Premier DLC')->setDescription('Le DLC 1 de Truc');
        $manager->persist($TwtrucDlc1);
        
        $TwtrucDlc2 = new Dlc();
        $TwtrucDlc2->setGame($gameTwtruc)->setName('Second DLC')->setDescription('Le DLC 2 de Truc');
        $manager->persist($TwtrucDlc2);
        
        
        
        
        
        
        
    }
}
