<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use App\Entity\Produit;

class Jeu1Categorie extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $c1 = new Categorie();
        $c1->setNomCategorie('Instrument de musique');
        $c1->setImageCategorie('instrument-musique.jpg');
        $c1->setDescriptionCategorie('Instruments de musique pour tous les niveaux et genres');
        $manager->persist($c1);


        $c2 = new Categorie();
        $c2->setNomCategorie('Accessoires de musique');
        $c2->setImageCategorie('accessoires-musique.jpg');
        $c2->setDescriptionCategorie('Accessoires indispensables pour les musiciens, des câbles aux pieds de micro');
        $manager->persist($c2);

        $sc1 = new SousCategorie();
        $sc1->setNomSouscategorie('Pianos et Claviers');
        $sc1->setImageSouscategorie('instrument-musique.jpg');
        $sc1->setDescriptionSouscategorie('Pianos numériques, claviers et synthétiseurs pour les musiciens');
        $sc1->setCategorie($c1);
        $manager->persist($sc1);

        $sc2 = new SousCategorie();
        $sc2->setNomSouscategorie('Accessoires Guitare');
        $sc2->setImageSouscategorie('accessoires-musique.jpg');
        $sc2->setDescriptionSouscategorie('Cordes, médiators, capos, et autres accessoires pour guitares');
        $sc2->setCategorie($c2);
        $manager->persist($sc2);

        $p1 = new Produit();
        $p1->setNomProduit('Synthétiseur Roland JUNO-DS61');
        $p1->setDescription('Synthétiseur Roland JUNO-DS61, 61 touches, avec effets et échantillons intégrés');
        $p1->setPrixHt(649.00);
        $p1->setImageProduit('images/synthetiseur_roland_juno.jpg');
        $p1->setReduction(10);
        $p1->setFournisseur('Roland');
        $p1->setStock(20);
        $p1->setTopProduit('non');
        $p1->setProduitTtc(778.80);
        $p1->setSousCategorie($sc1);
        $manager->persist($p1);

        $p2 = new Produit();
        $p2->setNomProduit('Cordes Guitare Elixir Nanoweb');
        $p2->setDescription('Lot de 3 jeux de cordes Elixir Nanoweb pour guitare acoustique');
        $p2->setPrixHt(29.99);
        $p2->setImageProduit('images/cordes_elixir.jpg');
        $p2->setReduction(10);
        $p2->setFournisseur('Elixir');
        $p2->setStock(100);
        $p2->setTopProduit('non');
        $p2->setProduitTtc(35.99);
        $p2->setSousCategorie($sc2);
        $manager->persist($p2);


        $manager->flush();
    }
}
