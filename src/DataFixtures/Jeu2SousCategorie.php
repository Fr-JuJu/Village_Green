<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;
use App\Entity\SousCategorie;

class Jeu2SousCategorie extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        

        $manager->flush();
    }
}
